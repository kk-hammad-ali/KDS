<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed some example cars
        Car::create([
            'make' => 'Toyota',
            'model' => 'Corolla',
            'registration_number' => 'ABC-123',
            'transmission' => 'automatic',
        ]);

        Car::create([
            'make' => 'Honda',
            'model' => 'Civic',
            'registration_number' => 'XYZ-789',
            'transmission' => 'manual',
        ]);

        Car::create([
            'make' => 'Ford',
            'model' => 'Focus',
            'registration_number' => 'JKL-456',
            'transmission' => 'automatic',
        ]);
    }
}
