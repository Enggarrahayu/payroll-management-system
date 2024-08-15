<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $positions = Position::all();
        return view('position.index', compact('positions'));
    }

    public function create()
    {
        return view('position.create');
    }

    public function store(Request $request)
    {
        Position::create([
            'name' => $request->name,
            'base_salary' => $request->base_salary,
            'overtime_cost' => $request->overtime_cost,
        ]);

        session()->flash('success', 'Position created successfully.');
        return redirect()->route('positions.index');
    }

    public function edit($id)
    {
        $position = Position::find($id);
        return view('position.edit', compact('position'));
    }

    public function update($id, Request $request)
    {
        $position = Position::find($id);
        $position->name = $request->name;
        $position->base_salary = $request->base_salary;
        $position->overtime_cost = $request->overtime_cost;
        $position->save();

        session()->flash('success', 'Position edited successfully.');
        return redirect()->route('positions.index');
    }

    public function destroy($id)
    {
        $position = Position::find($id);
        $position->delete();

        return redirect()->route('positions.index');
    }
}
