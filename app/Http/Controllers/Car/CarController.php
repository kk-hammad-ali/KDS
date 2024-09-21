<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function allCarsPage(){
        $cars = Car::all();
        return view('admin.cars.all_cars', compact('cars'));
    }


    public function addCars()
    {
        return view('admin.cars.add_cars');
    }

    public function storeCars(Request $request)
    {
        $validatedData = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|numeric',
            'registration_number' => 'required|string|max:255|unique:cars',
            'transmission' => 'required|in:automatic,manual',
        ]);

        Car::create($validatedData);

        return redirect()->route('admin.allCars')->with('success_cars', 'Car added successfully.');
    }

    public function editCars($id)
    {
        $car = Car::findOrFail($id);
        return view('admin.cars.edit_cars', compact('car'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|numeric',
            'registration_number' => 'required|string|max:255|unique:cars,registration_number,' . $id,
            'transmission' => 'required|in:automatic,manual',
        ]);

        $car = Car::findOrFail($id);
        $car->update($validatedData);

        return redirect()->route('admin.allCars')->with('success_updated_cars', 'Car updated successfully.');
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return redirect()->route('admin.allCars')->with('success_car_deleted', 'Car deleted successfully.');
    }
}
