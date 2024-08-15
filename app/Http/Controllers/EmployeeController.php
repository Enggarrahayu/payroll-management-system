<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $employees = Employee::with('positions')->get();
        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        $positions = Position::all();
        $users = User::where('role', 'employee')->get();
        return view('employee.create', compact('positions', 'users'));
    }

    public function store(Request $request)
    {
        $formattedBirthDate = Carbon::createFromFormat('m/d/Y', $request->birth_date)->format('Y-m-d');
        $employee =  Employee::create([
            'name' => $request->name,
            'birth_date' => $formattedBirthDate,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'user_id' => $request->user_id
        ]);

        $positionIds = $request->input('positions', []); // Assuming positions input is an array of position IDs
        $employee->positions()->attach($positionIds);

        $user = User::find($request->user_id);
        $user->employee_id = $employee->id;
        $user->save();

        session()->flash('success', 'Employee Data created successfully.');
        return redirect()->route('employees.index');
    }

    public function edit($id)
    {
        $employee = Employee::find($id);
        $positions = Position::all();
        $users = User::where('role', 'employee')->get();
        $employee_positions = $employee->positions;

        return view('employee.edit', compact('employee', 'employee_positions', 'positions', 'users'));
    }

    public function update(Request $request, $id)
    {
        $format = 'Y-m-d';
        $dateTime = DateTime::createFromFormat($format, $request->birth_date);
        $isCorrectFormat = ($dateTime !== false && $dateTime->format($format) === $request->birth_date);
        if ($isCorrectFormat) {
            $formattedBirthDate = $request->birth_date;
        } else {
            $formattedBirthDate = Carbon::createFromFormat('m/d/Y', $request->birth_date)->format('Y-m-d');
        }

        $employee = Employee::find($id);
        $employee->name = $request->name;
        $employee->address = $request->address;
        $employee->birth_date = $formattedBirthDate;
        $employee->phone_number = $request->phone_number;
        $employee->user_id = $request->user_id;

        $positionIds = $request->input('positions', []);
        $employee->positions()->sync($positionIds);
        $employee->save();

        $user = User::find($request->user_id);
        $user->employee_id = $employee->id;
        $user->save();
        session()->flash('success', 'Employee edited successfully.');
        return redirect()->route('employees.index');
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->positions()->detach();
        $employee->delete();

        return redirect()->route('employees.index');
    }
}
