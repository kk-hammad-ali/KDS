<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FixedExpense;
use App\Models\Employee;
use App\Models\Salary;
use Carbon\Carbon;

class FixedExpenseController extends Controller
{
    public function index()
    {
        // Fetch all fixed expenses, related employees, and salaries
        $fixedExpenses = FixedExpense::with('employee')->paginate(10);
        // Convert `expense_date` into Carbon instances for formatting
        foreach ($fixedExpenses as $expense) {
            $expense->expense_date = Carbon::parse($expense->expense_date)->format('Y-m-d');
        }
        $salaries = Salary::with('employee')->get();
        $employees = Employee::all();

        return view('expense.fixed.index', compact('fixedExpenses', 'salaries', 'employees'));
    }

    public function create()
    {
        // Get all employees for the form dropdown
        $employees = Employee::all();
        return view('expense.fixed.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'expense_type' => 'required|string',
            'amount' => 'required|numeric',
            'employee_id' => 'nullable|exists:employees,id', // Only for salary
            'expense_date' => 'required|date',
        ]);

        // Create the fixed expense
        $fixedExpense = FixedExpense::create($validated);

        // If it's a salary, also create a salary record
        if ($request->expense_type === 'Salary' && $request->employee_id) {
            Salary::create([
                'employee_id' => $request->employee_id,
                'amount' => $request->amount,
                'payment_date' => $request->expense_date,
            ]);
        }

        return redirect()->route('admin.fixedExpenses')->with('success', 'Fixed expense added successfully.');
    }

    public function edit($id)
    {
        // Find the fixed expense by ID, or return 404 if not found
        $fixedExpense = FixedExpense::findOrFail($id);
        $fixedExpense->expense_date = $fixedExpense->expense_date->format('Y-m-d'); // Ensure the date is in 'YYYY-MM-DD' format
        $employees = Employee::all();

        return view('expense.fixed.edit', compact('fixedExpense', 'employees'));
    }


    public function update(Request $request, $id)
    {
        // Find the fixed expense by ID, or return 404 if not found
        $fixedExpense = FixedExpense::findOrFail($id);

        $validated = $request->validate([
            'expense_type' => 'required|string',
            'amount' => 'required|numeric',
            'employee_id' => 'nullable|exists:employees,id', // Only for salary
            'expense_date' => 'required|date',
        ]);

        // Update the fixed expense
        $fixedExpense->update($validated);

        // If it's a salary, also update or create a salary record
        if ($request->expense_type === 'Salary' && $request->employee_id) {
            $salary = Salary::where('employee_id', $request->employee_id)
                ->where('payment_date', $request->expense_date)
                ->first();

            if ($salary) {
                // Update existing salary record
                $salary->update([
                    'amount' => $request->amount,
                ]);
            } else {
                // Create a new salary record
                Salary::create([
                    'employee_id' => $request->employee_id,
                    'amount' => $request->amount,
                    'payment_date' => $request->expense_date,
                ]);
            }
        }

        return redirect()->route('admin.fixedExpenses')->with('success', 'Fixed expense updated successfully.');
    }

    public function destroy($id)
    {
        // Find the fixed expense by ID, or return 404 if not found
        $fixedExpense = FixedExpense::findOrFail($id);

        // Delete the fixed expense record
        $fixedExpense->delete();

        return redirect()->route('admin.fixedExpenses')->with('success', 'Fixed expense deleted successfully.');
    }
}
