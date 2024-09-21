<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseController extends Controller
{
    public function fix_expense_page(){
        return view('admin.expenses.fix_expenses');
    }


    public function allExpensePage(){
        $expenses = Expense::all();
        return view('admin.expenses.all_expenses', compact('expenses'));
    }


    public function addExpenses()
    {
        return view('admin.expenses.add_expenses');
    }

    public function storeExpenses(Request $request)
    {
        $request->validate([
            'type' => 'required|in:rent,salary,utilities,bills',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
        ]);

        Expense::create($request->all());

        return redirect()->route('admin.allExpenses')->with('success_expenses', 'Expense added successfully.');
    }

    public function editExpenses($id)
    {
        $expense = Expense::findOrFail($id);
        return view('admin.expenses.edit_expenses', compact('expense'));
    }

    // Update the specified expense in storage
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'type' => 'required|in:rent,salary,utilities,bills',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
        ]);

        $expense = Expense::findOrFail($id);
        $expense->update($validated);

        return redirect()->route('admin.allExpenses')->with('success_updated_expense', 'Expense updated successfully.');
    }


    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return redirect()->route('admin.allExpenses')->with('success_expense_deleted', 'Expense deleted successfully.');
    }
}
