@extends('layout')
@section('title', 'Add New Employee')
@section('content')

<div class="col-sm-12 col-xl-12">
  <div class="bg-secondary rounded h-100 p-4">
    <h6 class="mb-4"> Add New Employee</h6>
    <form method="POST" action="{{route('employees.store')}}">
      @csrf
      {{ method_field('POST') }}
      {{ csrf_field() }}
      <div class="mb-3">
        <label for="name" class="form-label">Employee Name</label>
        <input type="text" class="form-control" id="name" name="name">
      </div>
      <div class="mb-3">
        <label for="phoneNumber" class="form-label">Phone Number</label>
        <input type="number" class="form-control" id="phoneNumber" name="phone_number">
      </div>
      <div class="mb-3">
        <label for="overtimeCost" class="form-label">Birth Date</label>
        <input type="text" class="form-control datepicker" data-provide="datepicker" id="birthDate" name="birth_date">
      </div>
      <div class="mb-3">
        <label for="overtimeCost" class="form-label">Address</label>
        <textarea id="address" name="address" class="form-control"></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Employee Position</label>
        @foreach($positions as $position)
        <div class="form-check">
          <input class="form-check-input" name="positions[]" type="checkbox" value="{{$position->id}}" id="flexCheckDefault">
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
          <option value="{{$user->id}}">{{$user->name}} - {{$user->email}}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Save Employee</button>
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