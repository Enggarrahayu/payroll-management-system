<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePosition extends Model
{
    protected $table = 'employee_position';
    use HasFactory;

    public function payrolls()
    {
        return $this->hasMany(Payroll::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
