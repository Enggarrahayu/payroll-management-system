@extends('layout')
@section('title', 'Add New Payroll')
@section('content')
<div class="col-sm-12 col-xl-6">
  <div class="bg-secondary rounded h-100 p-4">
    <h6 class="mb-4"> Record Employee Attendance({{$currentDate}}) </h6>
    <h6>Add New Attendance</h6> <br>
    <form method="POST" action="{{route('attendances.store')}}">
      @csrf
      {{ method_field('POST') }}
      {{ csrf_field() }}
      <div class="row">
        <fieldset class="row mb-3">
          <legend class="col-form-label col-sm-2 pt-0">Log Type</legend>
          <div class="col-sm-10">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="log_type" id="gridRadios1" value="in" checked>
              <label class="form-check-label" for="gridRadios1">
                log IN
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="log_type" id="gridRadios2" value="out">
              <label class="form-check-label" for="gridRadios2">
                log OUT
              </label>
            </div>
          </div>
        </fieldset>
      </div>
      <button type="submit" class="btn btn-sm btn-primary">Record Attendance</button>
    </form>
  </div>
</div>
@endsection