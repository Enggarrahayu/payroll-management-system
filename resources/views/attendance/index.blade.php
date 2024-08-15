@extends('layout')
@section('title', 'Position List')
@section('content')
@if(Auth::user()->role == 'employee')
<div class="col-sm-12 col-xl-12" style="margin-bottom: 10px;">
  <div class="bg-secondary rounded h-100 p-4">
    <a href="{{route('attendances.create')}}" class="btn btn-light m-2">
      <i class="fa fa-plus"></i> Add Attendance
    </a>
  </div>
</div>
@endif
<div class="text-center rounded p-4"  style="background-color:whitesmoke;">
  <div class="d-flex align-items-center justify-content-between mb-4">
    <h6 class="mb-0" style="color: slategray;">Position List</h6>
  </div>
  <div class="table-responsive">
    <table class="table text-start align-middle table-hover mb-0 my-table">
      <thead>
        <tr>
          <th>Log Type</th>
          <th>Date Time Log</th>
        </tr>
      </thead>
      <tbody>
        @foreach($attendances as $attendance)
        <tr>
          <td>{{$attendance->log_type}}</td>
          <td>{{$attendance->datetime_log}}</td>
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