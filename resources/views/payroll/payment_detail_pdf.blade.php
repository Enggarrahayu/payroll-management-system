<html>

<head>
  <title>Salary Slip</title>
  <style>
    th {
      text-align: left;
    }

    .right {
      text-align: right;
    }
  </style>
</head>
<h3 style="text-align: center;">Salary Slip {{$document_name}}</h3>
<br> <br>
<div style="border: 1px solid black; padding:20px">
  <table style="border: 0px; width: 100%;">
    <thead>
      <tr>
        <th><b>Employee Details</b></th>
        <th>Salary Slip: {{$document_name}}</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{$payroll->employeePosition->employee->name}}</td>
        <td>Issued Date: {{$payroll->payment_date}}</td>
      </tr>
      <tr>
        <td><i>{{$payroll->employeePosition->position->name}}</i></td>
        <td>Salary for: {{$payroll->year}}/{{$payroll->month}}</td>
      </tr>
      <tr>
        <td></td>
        <td>Absence: {{$payroll->absen}} days</td>
      </tr>
    </tbody>
  </table>
  <h4>Salary Details</h4>
  <table style="border: 0px; width: 100%;">
    <thead>
      <tr>
        <th><b>Description</b></th>
        <th class="right"><b>Total</b></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>BASE SALARY</td>
        <td class="right">{{'Rp ' . number_format($base_salary, 0, ',', '.')}}</td>
      </tr>
      <tr>
        <td>Bonus Salary</td>
        <td class="right">{{'Rp ' . number_format($bonus_salary, 0, ',', '.')}}</td>
      </tr>
      <tr>
        <td>Absence</td>
        <td class="right">{{'Rp ' . number_format($absen/20 * $base_salary, 0, ',', '.')}}</td>
      </tr>
      <tr>
        <td>Overtime</td>
        <td class="right">{{'Rp ' . number_format($overtime_hours*$overtime_cost, 0, ',', '.')}}</td>
      </tr>
      <tr>
        <td>Deduction</td>
        <td class="right">{{'Rp ' . number_format($payroll->deduction, 0, ',', '.')}}</td>
      </tr>
      <tr>
        <td><b>Total Salary</b></td>
        <td class="right"><b>{{'Rp ' . number_format($total_salary, 0, ',', '.')}}</b></td>
      </tr>
    </tbody>
  </table>
</div>

</html>