@extends('layout')
@section('title', 'Employee Position List')
@section('content')
<div class="text-center rounded p-4" style="background-color:whitesmoke;">
  <div class="d-flex align-items-center justify-content-between mb-4">
    <h6 class="mb-0" style="color: slategray;">Employee Position List</h6>
  </div>
  <div class="table-responsive">
    <table class="table text-start align-middle table-hover mb-0 my-table">
      <thead>
        <tr>
          <th>Employee Name</th>
          <th>Position</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($employee_positions as $employee_position)
        <tr>
          <td>{{$employee_position->employee->name}}</td>
          <td>{{$employee_position->position->name}}</td>
          <td>
            @if(Auth::user()->role == 'admin')
            <a class="btn btn-warning btn-sm" href="{{ route('payrolls.add', $employee_position->id) }}">
              <i class="fa fa-plus"></i> Add Payroll
            </a>
            @endif
            @if ($employee_position->payrolls->count() > 0)
            <a class="btn btn-success btn-sm" href="{{ route('payrolls.show', $employee_position->id) }}">
              <i class="fa fa-eye">View Payrolls</i>
            </a>
            @elseif ($employee_position->payrolls->count() < 1 && Auth::user()->role == 'employee')
            <i>Payroll for this position has not been created</i>
            @endif

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