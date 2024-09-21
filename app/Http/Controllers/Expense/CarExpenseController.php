<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use App\Models\CarExpense;
use App\Models\Car;
use Illuminate\Http\Request;

class CarExpenseController extends Controller
{
    // Display a listing of the car expenses
    public function index()
    {
        $carExpenses = CarExpense::with('car')->get();
        return view('expense.car.index', compact('carExpenses'));
    }

    // Show the form for creating a new car expense
    public function create()
    {
        $cars = Car::all(); // Get all cars for selection
        return view('expense.car.create', compact('cars'));
    }

    // Store a newly created car expense
    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'expense_type' => 'required|in:maintenance,fuel',
            'amount' => 'required|numeric',
            'expense_date' => 'required|date',
        ]);

        CarExpense::create($validated);

        return redirect()->route('admin.carExpenses')->with('success', 'Car expense added successfully.');
    }

    // Show the form for editing the specified car expense
    public function edit($id)
    {
        $carExpense = CarExpense::findOrFail($id);
        $cars = Car::all(); // Get all cars for selection
        return view('expense.car.edit', compact('carExpense', 'cars'));
    }

    // Update the specified car expense
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'expense_type' => 'required|in:maintenance,fuel',
            'amount' => 'required|numeric',
            'expense_date' => 'required|date',
        ]);

        $carExpense = CarExpense::findOrFail($id);
        $carExpense->update($validated);

        return redirect()->route('admin.carExpenses')->with('success', 'Car expense updated successfully.');
    }

    // Remove the specified car expense
    public function destroy($id)
    {
        $carExpense = CarExpense::findOrFail($id);
        $carExpense->delete();

        return redirect()->route('admin.carExpenses')->with('success', 'Car expense deleted successfully.');
    }
}
