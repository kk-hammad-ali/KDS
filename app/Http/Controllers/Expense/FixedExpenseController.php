<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FixedExpense;
use App\Models\Employee;

class FixedExpenseController extends Controller
{
    public function index()
    {
        $fixedExpenses = FixedExpense::with('employee')->get();
        return view('expense.fixed.index', compact('fixedExpenses'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('expense.fixed.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'expense_type' => 'required|string',
            'amount' => 'required|numeric',
            'employee_id' => 'nullable|exists:employees,id',
            'status' => 'required|in:paid,unpaid',
            'expense_date' => 'required|date',
        ]);

        FixedExpense::create($validated);
        return redirect()->route('admin.fixedExpenses')->with('success', 'Fixed expense added successfully.');
    }

    public function edit($id)
    {
        $fixedExpense = FixedExpense::findOrFail($id);
        $employees = Employee::all();
        return view('expense.fixed.edit', compact('fixedExpense', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $fixedExpense = FixedExpense::findOrFail($id);

        $validated = $request->validate([
            'expense_type' => 'required|string',
            'amount' => 'required|numeric',
            'employee_id' => 'nullable|exists:employees,id',
            'status' => 'required|in:paid,unpaid',
            'expense_date' => 'required|date',
        ]);

        $fixedExpense->update($validated);
        return redirect()->route('admin.fixedExpenses')->with('success', 'Fixed expense updated successfully.');
    }

    public function destroy($id)
    {
        $fixedExpense = FixedExpense::findOrFail($id);
        $fixedExpense->delete();
        return redirect()->route('admin.fixedExpenses')->with('success', 'Fixed expense deleted successfully.');
    }
}
