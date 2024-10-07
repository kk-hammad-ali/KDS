<?php

namespace App\Http\Controllers\Car;

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    // Display the list of cars
    public function allCarsPage()
    {
        $cars = Car::paginate(10);
        return view('cars.all_cars', compact('cars'));
    }

    // Return the view to add a new car
    public function addCars()
    {
        return view('admin.cars.add_cars');
    }

    // Store a new car
    public function storeCars(Request $request)
    {
        // Updated validation rules
        $validatedData = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255', // Model is a string, not numeric
            'registration_number' => 'required|string|max:255|unique:cars',
            'transmission' => 'required|in:automatic,manual',
        ]);

        // Store car
        Car::create($validatedData);

        return redirect()->route('admin.allCars')->with('success_cars', 'Car added successfully.');
    }

    // Return the view to edit a car
    public function editCars($id)
    {
        $car = Car::findOrFail($id);
        return view('admin.cars.edit_cars', compact('car'));
    }

    // Update the car
    public function update(Request $request, $id)
    {
        // Updated validation rules
        $validatedData = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255', // Model is a string, not numeric
            'registration_number' => 'required|string|max:255|unique:cars,registration_number,' . $id,
            'transmission' => 'required|in:automatic,manual',
        ]);

        // Find and update the car
        $car = Car::findOrFail($id);
        $car->update($validatedData);

        return redirect()->route('admin.allCars')->with('success_updated_cars', 'Car updated successfully.');
    }

    // Delete a car
    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return redirect()->route('admin.allCars')->with('success_car_deleted', 'Car deleted successfully.');
    }
}
