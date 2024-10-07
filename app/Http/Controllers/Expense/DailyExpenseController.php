<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DailyExpense;

class DailyExpenseController extends Controller
{
    // Display a listing of the daily expenses
    public function index()
    {
        $dailyExpenses = DailyExpense::paginate(10);
        return view('expense.daily.index', compact('dailyExpenses'));
    }

    // Show the form for creating a new daily expense
    public function create()
    {
        return view('expense.daily.create');
    }

    // Store a newly created daily expense
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'expense_date' => 'required|date',
        ]);

        DailyExpense::create($validated);

        return redirect()->route('admin.dailyExpenses')->with('success', 'Daily expense added successfully.');
    }

    // Show the form for editing the specified daily expense
    public function edit($id)
    {
        $dailyExpense = DailyExpense::findOrFail($id);
        return view('expense.daily.edit', compact('dailyExpense'));
    }

    // Update the specified daily expense
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'expense_date' => 'required|date',
        ]);

        $dailyExpense = DailyExpense::findOrFail($id);
        $dailyExpense->update($validated);

        return redirect()->route('admin.dailyExpenses')->with('success', 'Daily expense updated successfully.');
    }

    // Remove the specified daily expense
    public function destroy($id)
    {
        $dailyExpense = DailyExpense::findOrFail($id);
        $dailyExpense->delete();

        return redirect()->route('admin.dailyExpenses')->with('success', 'Daily expense deleted successfully.');
    }
}
