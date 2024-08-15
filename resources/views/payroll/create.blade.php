@extends('layout')
@section('title', 'Add New Payroll')
@section('content')
<div class="col-sm-12 col-xl-10">
  <div class="bg-secondary rounded h-100 p-4">
    <h6 class="mb-4"> Add New Payroll </h6>
    <h6>{{$employee_position->employee->name}} - {{$employee_position->position->name}}</h6> <br>
    <form method="POST" action="{{route('payrolls.store')}}">
      @csrf
      {{ method_field('POST') }}
      {{ csrf_field() }}
      <div class="row">
        <div class="mb-3 col-6">
          <label for="name" class="form-label">Month</label>
          <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="month">
            <option selected>Select Month</option>
            <option value="1">January</option>
            <option value="2">February</option>
            <option value="3">March</option>
            <option value="4">April</option>
            <option value="5">May</option>
            <option value="6">June</option>
            <option value="7">Jully</option>
            <option value="8">August</option>
            <option value="9">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
          </select>
          <input type="hidden" name="employee_position_id" value="{{$employee_position->id}}">
        </div>
        <div class="mb-3 col-6">
          <label for="year" class="form-label">Year</label>
          <input type="number" class="form-control" id="year" name="year">
        </div>
      </div>
      <div class="row">
        <div class="mb-3 col-6">
          <label for="absen" class="form-label">Absen</label>
          <input type="number" class="form-control" id="absen" name="absen" placeholder="check at employee attendances data">
        </div>
        <div class="mb-3 col-6">
          <label for="present" class="form-label">Present</label>
          <input type="number" class="form-control" id="present" name="present" placeholder="check at employee attendances data">
        </div>
      </div>
      <div class="row">
        <div class="mb-3 col-4">
          <label for="overtimeHours" class="form-label">Overtime Hours</label>
          <input type="number" class="form-control" id="overtimeHours" name="overtime_hours">
        </div>
        <div class="mb-3 col-4">
          <label for="bonusSalary" class="form-label">Bonus Salary</label>
          <input type="number" class="form-control" id="bonusSalary" name="bonus_salary">
        </div>
        <div class="mb-3 col-4">
          <label for="deduction" class="form-label">Deduction</label>
          <input type="number" class="form-control" id="deduction" name="deduction">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Save and Calculate Salary</button>
    </form>
  </div>
</div>
@endsection