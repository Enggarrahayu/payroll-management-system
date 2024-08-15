<?php

namespace App\Http\Controllers;

use App\Models\EmployeePosition;
use App\Models\Payroll;
use App\Models\Position;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class PayrollController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $employee_positions = EmployeePosition::with('position', 'employee')->get();
        } else {
            $employee_positions = EmployeePosition::with('position','employee')->where('employee_id', Auth::user()->employee_id)->get();
        }
        return view('payroll.index', compact('employee_positions'));
    }

    public function addPayroll($id)
    {
        $employee_position = EmployeePosition::find($id);
        return view('payroll.create', compact('employee_position'));
    }

    public function show($id)
    {
        $payrolls = Payroll::with('employeePosition')->where('employee_position_id', $id)->get();
        $first_payroll = Payroll::with('employeePosition')->where('employee_position_id', $id)->first();
        return view('payroll.show', compact('payrolls', 'first_payroll'));
    }

    public function store(Request $request)
    {
        $payroll = new Payroll();
        $payroll->status = 'pending';
        $payroll->month = $request->month;
        $payroll->year = $request->year;
        $payroll->deduction = $request->deduction;
        $payroll->absen = $request->absen;
        $payroll->present = $request->present;
        $payroll->employee_position_id = $request->employee_position_id;
        $payroll->overtime_hours = $request->overtime_hours;
        $payroll->bonus_salary = $request->bonus_salary;

        $position_id = EmployeePosition::find($payroll->employee_position_id)->position_id;
        $base_salary = Position::find($position_id)->base_salary;
        $overtime_cost = Position::find($position_id)->overtime_cost;
        $totalSalary = $payroll->calculateTotalSalary(
            $payroll->absen,
            $base_salary,
            $payroll->overtime_hours,
            $overtime_cost,
            $payroll->bonus_salary,
            $payroll->deduction
        );

        $payroll->total_salary = $totalSalary;
        $payroll->save();
        session()->flash('success', 'Payroll created successfully.');
        return redirect()->route('payrolls.index');
    }

    public function paySalary($id)
    {
        $payroll = Payroll::find($id);
        $payroll->status = 'paid';
        $payroll->payment_date = Carbon::now();
        $payroll->save();

        return redirect()->back();
    }

    public function paymentDetailPdf($id)
    {
        $payroll = Payroll::find($id);
        $base_salary = $payroll->employeePosition->position->base_salary;
        $overtime_hours = $payroll->overtime_hours;
        $absen = $payroll->absen;
        $bonus_salary = $payroll->bonus_salary;
        $overtime_cost = $payroll->employeePosition->position->overtime_cost;
        $total_salary = $payroll->total_salary;
        $document_name = $payroll->employeePosition->employee->id  . $payroll->employeePosition->position->id . $payroll->id;
        $html = View::make('payroll.payment_detail_pdf', compact('base_salary', 'overtime_hours', 'absen', 'bonus_salary', 'overtime_cost', 'total_salary', 'document_name', 'payroll'))->render();

        $pdf = new Dompdf();
        $pdf->loadHtml($html);
        $pdf->setPaper('A4');

        $pdf->render();

        return $pdf->stream($document_name . '.pdf', ['Attachment' => false]);
    }
}
