@extends('layout')
@section('title', 'Position List')
@section('content')
<div class="col-sm-12 col-xl-12" style="margin-bottom: 10px;">
  <div class="bg-secondary rounded h-100 p-4">
    <a href="{{route('positions.create')}}" class="btn btn-light m-2">
      <i class="fa fa-plus"></i> Add New Position
    </a>
  </div>
</div>
<div class="text-center rounded p-4"  style="background-color:whitesmoke;">
  <div class="d-flex align-items-center justify-content-between mb-4">
    <h6 class="mb-0" style="color: slategray;">Position List</h6>
  </div>
  <div class="table-responsive">
    <table class="table text-start align-middle table-hover mb-0 my-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Base Salary</th>
          <th>Overtime Cost</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($positions as $position)
        <tr>
          <td>{{$position->name}}</td>
          <td>{{$position->base_salary}}</td>
          <td>{{$position->overtime_cost}}</td>
          <td>
            <a class="btn btn-success btn-sm" href="{{ route('positions.show', $position->id) }}">
              <i class="fa fa-eye"></i>
            </a>
            <a class="btn btn-warning btn-sm" href="{{ route('positions.edit', $position->id) }}">
              <i class="fa fa-edit"></i>
            </a>
            <form style="display: inline-block;" method="POST" onsubmit="return confirm('Apakah kamu yakin untuk menghapus data ini?')" action="{{route('positions.destroy', $position->id)}}">
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