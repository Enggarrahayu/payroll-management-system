@extends('layout')
@section('title', 'Employee List')
@section('content')
<div class="col-sm-12 col-xl-12" style="margin-bottom: 10px;">
  <div class="bg-secondary rounded h-100 p-4">
    <a href="{{route('employees.create')}}" class="btn btn-light m-2">
      <i class="fa fa-plus"></i> Add New Employee
    </a>
  </div>
</div>
<div class="text-center rounded p-4" style="background-color:whitesmoke;">
  <div class="d-flex align-items-center justify-content-between mb-4">
    <h6 class="mb-0" style="color: slategray;">Employee List</h6>
  </div>
  <div class="table-responsive">
    <table class="table text-start align-middle table-hover mb-0 my-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Position</th>
          <th>Phone Number</th>
          <th>Birth Date</th>
          <th>Address</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($employees as $employee)
        <tr>
          <td>{{$employee->name}}</td>
          <td>
            @foreach($employee->positions as $position)
            {{$position->name}} <br>
            @endforeach
          </td>
          <td>{{$employee->phone_number}}</td>
          <td>{{$employee->birth_date}}</td>
          <td>{{$employee->address}}</td>
          <td>
            <a class="btn btn-success btn-sm" href="{{ route('attendances.show', $employee->id) }}">
              <i class="fa fa-eye">View Attendances</i>
            </a>
            <a class="btn btn-warning btn-sm" href="{{ route('employees.edit', $employee->id) }}">
              <i class="fa fa-edit"></i>
            </a>
            <form style="display: inline-block;" method="POST" onsubmit="return confirm('Apakah kamu yakin untuk menghapus data ini?')" action="{{route('employees.destroy', $employee->id)}}">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <button type="submit" class="btn btn-danger btn-sm">
                <i class="fa fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
@push('scripts')
@if(session('success'))
<script>
  Swal.fire({
    icon: 'success',
    title: 'Success',
    text: "{{ session('success') }}",
  });
</script>
@endif

<script>
  $(document).ready(function() {
    $('.my-table').DataTable();
  });
</script>
@endpush