<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarModel;

class CarModelController extends Controller
{

    /**
     * Store a newly created car model in storage.
     */
    public function storeCarModel(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'transmission' => 'required|in:automatic,manual',
        ]);

        CarModel::create($request->all());

        return redirect()->route('admin.allCars')->with('success', 'Car Model added successfully.');
    }

    /**
     * Update the specified car model in storage.
     */
    public function updateCarModel(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'transmission' => 'required|in:automatic,manual',
        ]);

        $carModel = CarModel::findOrFail($id);
        $carModel->update($request->all());

        return redirect()->route('admin.allCars')->with('success', 'Car Model updated successfully.');
    }

    /**
     * Remove the specified car model from storage.
     */
    public function deleteCarModel($id)
    {
        $carModel = CarModel::findOrFail($id);
        $carModel->delete();

        return redirect()->route('admin.allCars')->with('success', 'Car Model deleted successfully.');
    }
}
