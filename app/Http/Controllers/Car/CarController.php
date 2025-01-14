<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarModel;

class CarController extends Controller
{
    /**
     * Display the list of cars
     */
    public function allCarsPage()
    {
        $cars = Car::with('carModel')->paginate(10); // Eager load car model relationships
        $carModels = CarModel::paginate(10); // Fetch all car models for dropdown or selection
        return view('cars.all_cars', compact('cars', 'carModels'));
    }

    /**
     * Store a new car
     */
    public function storeCars(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'car_model_id' => 'required|exists:car_models,id', // Ensure the car model exists
            'registration_number' => 'required|string|max:255|unique:cars', // Unique registration number
        ]);

        // Store car
        Car::create($validatedData);

        return redirect()->route('admin.allCars')->with('success_cars', 'Car added successfully.');
    }

    /**
     * Update the car
     */
    public function update(Request $request, $id)
    {
        // Validation
        $validatedData = $request->validate([
            'car_model_id' => 'required|exists:car_models,id', // Ensure the car model exists
            'registration_number' => 'required|string|max:255|unique:cars,registration_number,' . $id, // Unique per car, exclude current car
        ]);

        // Find and update the car
        $car = Car::findOrFail($id);
        $car->update($validatedData);

        return redirect()->route('admin.allCars')->with('success_updated_cars', 'Car updated successfully.');
    }

    /**
     * Delete a car
     */
    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return redirect()->route('admin.allCars')->with('success_car_deleted', 'Car deleted successfully.');
    }
}
