@extends('layout')
@section('title', 'Edit New Position')
@section('content')
<div class="col-sm-12 col-xl-12">
  <div class="bg-secondary rounded h-100 p-4">
    <h6 class="mb-4"> Edit Position</h6>
    <form method="POST" action="{{route('positions.update', $position->id)}}">
      @csrf
      {{ method_field('PUT') }}
      {{ csrf_field() }}
      <div class="mb-3">
        <label for="name" class="form-label">Position Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{$position->name}}">
      </div>
      <div class="mb-3">
        <label for="baseSalary" class="form-label">Base Salary</label>
        <input type="number" class="form-control" id="baseSalary" name="base_salary" value="{{$position->base_salary}}">
      </div>
      <div class="mb-3">
        <label for="overtimeCost" class="form-label">Overtime Cost</label>
        <input type="number" class="form-control" id="overtimeCost" name="overtime_cost" value="{{$position->overtime_cost}}">
      </div>
      <button type="submit" class="btn btn-primary">Update Position</button>
    </form>
  </div>
</div>
@endsection