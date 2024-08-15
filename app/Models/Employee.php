<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Position;


class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => '-',
        ]);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    

    public function positions()
    {
        return $this->belongsToMany(Position::class, 'employee_position', 'employee_id', 'position_id');
    }
}
