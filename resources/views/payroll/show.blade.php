@extends('layout')
@section('title', 'Payroll List')
@section('content')
<div class="text-center rounded p-4" style="background-color:whitesmoke;">
  <div class="d-flex align-items-center justify-content-between mb-4">
    <h6 class="mb-0" style="color: slategray;">Payroll List {{$first_payroll->employeePosition->employee->name}} - {{$first_payroll->employeePosition->position->name}} </h6>
  </div>
  <div class="table-responsive">
    <table class="table text-start align-middle table-hover mb-0 my-table">
      <thead>
        <tr>
          <th>Month</th>
          <th>Base <br> Salary</th>
          <th>Overtime<br>Hours</th>
          <th>Deduction</th>
          <th>Absen</th>
          <th>Bonus<br>Salary</th>
          <th>Total<br>Salary</th>
          <th>Status</th>
          <th>Payment<br>Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($payrolls as $payroll)
        <tr>
          @php
          $bonus_salary = $payroll->bonus_salary;
          $deduction = $payroll->deduction;
          $total_salary = $payroll->total_salary;
          $base_salary = $payroll->EmployeePosition->position->base_salary;
          $baseSalaryFormat = 'Rp ' . number_format($base_salary, 0, ',', '.');
          $totalSalaryFormat = 'Rp ' . number_format($total_salary, 0, ',', '.');
          $bonusSalaryFormat = 'Rp ' . number_format($bonus_salary, 0, ',', '.');
          $deductionFormat = 'Rp ' . number_format($deduction, 0, ',', '.');
          @endphp
          <td>{{$payroll->year}}-{{$payroll->month}}</td>
          <td>{{$baseSalaryFormat}}</td>
          <td>{{$payroll->overtime_hours}} hours</td>
          <td>{{$deductionFormat}}</td>
          <td>{{$payroll->absen}} days</td>
          <td>{{$bonusSalaryFormat}}</td>
          <td>{{$totalSalaryFormat}}</td>
          <td>{{$payroll->status}}</td>
          @if(isset($payroll->payment_date))
          <td>{{$payroll->payment_date}}</td>
          @else
          <td class="text-center">-</td>
          @endif
          <td>
            @if($payroll->status == 'pending' && Auth::user()->role == 'admin')
            <form style="display: inline-block;" method="POST" onsubmit="return confirm('Are you sure want to pay the salary?')" action="{{route('payrolls.pay_salary', $payroll->id)}}">
              {{ csrf_field() }}
              {{ method_field('POST') }}
              <button type="submit" class="btn btn-success btn-sm" href="">
                <i class="fa fa-money-bill"> Pay Salary</i>
              </button>
            </form>
            <br>
            <a class="btn btn-warning btn-sm" href="{{ route('payrolls.edit', $payroll->id) }}">
              <i class="fa fa-plus"></i>Edit Payroll
            </a>
            <form style="display: inline-block;" method="POST" onsubmit="return confirm('Apakah kamu yakin untuk menghapus data ini?')" action="{{route('payrolls.destroy', $payroll->id)}}">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <button type="submit" class="btn btn-danger btn-sm">
                <i class="fa fa-trash"></i>
              </button>
            </form>
            @endif
            @if($payroll->status == 'paid')
            <a class="btn btn-success btn-sm" href="{{route('payrolls.payment_detail_pdf', $payroll->id)}}">
              <i class="fa fa-eye"> Payment Detail</i>
            </a>
            @elseif($payroll->status == 'pending' && Auth::user()->role == 'employee')
            <b><p>Salary is being processed</p></b>
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
<script>
  $(document).ready(function() {
    $('.my-table').DataTable();
  });
</script>
@endpush