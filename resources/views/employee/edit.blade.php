@extends('layout')
@section('title', 'Edit Employee')
@section('content')

<div class="col-sm-12 col-xl-12">
  <div class="bg-secondary rounded h-100 p-4">
    <h6 class="mb-4"> Edit Employee</h6>
    <form method="POST" action="{{route('employees.update', $employee->id)}}">
      @csrf
      {{ method_field('PUT') }}
      {{ csrf_field() }}
      <div class="mb-3">
        <label for="name" class="form-label">Employee Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{$employee->name}}">
      </div>
      <div class="mb-3">
        <label for="phoneNumber" class="form-label">Phone Number</label>
        <input type="number" class="form-control" id="phoneNumber" name="phone_number" value="{{$employee->phone_number}}">
      </div>
      <div class="mb-3">
        <label for="overtimeCost" class="form-label">Birth Date</label>
        <input type="text" class="form-control datepicker" data-provide="datepicker" id="birthDate" name="birth_date" value="{{$employee->birth_date}}">
      </div>
      <div class="mb-3">
        <label for="overtimeCost" class="form-label">Address</label>
        <textarea id="address" name="address" class="form-control">{{$employee->address}}</textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Employee Position</label>
        @foreach($positions as $position)
        <div class="form-check">
          <input class="form-check-input" name="positions[]" type="checkbox" value="{{$position->id}}" id="flexCheckDefault" {{ in_array($position->id, old('positions', $employee_positions->pluck('id')->toArray())) ? 'checked' : '' }}>
          <label class="form-check-label" for="flexCheckDefault">
            {{$position->name}}
          </label>
        </div>
        @endforeach
      </div>
      <div class="mb-3">
        <label for="user_id" class="form-label">Integrated with user:</label>
        <select name="user_id" class="form-select" id="floatingSelect">
          <option>Select user you'd like to integrated with</option>
          @foreach($users as $user)
          <option value="{{$user->id}}" {{ old('user_id', $employee->user_id) == $user->id ? 'selected' : '' }}>{{$user->name}} - {{$user->email}}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Update Employee</button>
    </form>
  </div>
</div>
@endsection

<script>
  $(document).ready(function() {
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd', // Set the desired date format
      autoclose: true, // Close the datepicker when a date is selected
    });
  });
</script>