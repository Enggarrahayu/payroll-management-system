<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    public function employeePosition()
    {
        return $this->belongsTo(EmployeePosition::class);
    }

    public function calculateTotalSalary($absen, $base_salary, $overtime_hours, $overtime_cost, $bonus_salary, $deduction)
    {
        $total_absen = $absen/20 * $base_salary;
        $total_overtime = $overtime_hours * $overtime_cost;
        $total_salary = $base_salary + $total_overtime + $bonus_salary - $total_absen - $deduction;

        return $total_salary;
    }
}
