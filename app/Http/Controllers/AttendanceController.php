<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function create()
    {
        $currentDate = Carbon::now()->toDateString();
        return view('attendance.create', compact('currentDate'));
    }

    public function store(Request $request)
    {
        Attendance::create([
            'employee_id' => Auth::user()->employee_id,
            'log_type' => $request->log_type,
            'datetime_log' => Carbon::now(),
        ]);

        session()->flash('success', 'Attendance created successfully.');
        return redirect()->route('attendances.index');
    }

    public function index()
    {
        $attendances = Attendance::where('employee_id', Auth::user()->employee_id)->get();
        return view('attendance.index', compact('attendances'));
    }

    public function show($id)
    {
        $attendances = Attendance::where('employee_id', $id)->get();
        return view('attendance.index', compact('attendances'));
    }
}
