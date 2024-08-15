@extends('layout')
@section('title', 'Welcome')
@section('content')
<div class="col-sm-12 col-xl-12" style="margin-bottom: 10px;">
  <div class="bg-secondary text-center rounded p-4">
    <h3>Welcome to Payroll Management System</h3>
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