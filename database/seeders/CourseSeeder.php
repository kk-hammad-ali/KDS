<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Car;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetch all cars
        $cars = Car::all();

        // Ensure there are cars before seeding courses
        if ($cars->isEmpty()) {
            return; // Exit if no cars are available
        }

        // Seed 2 example courses for each car
        foreach ($cars as $car) {
            Course::create([
                'duration_days' => 15,
                'duration_minutes' => 30,
                'fees' => 15000.00,
                'car_id' => $car->id, // Add reference to the car
            ]);

            Course::create([
                'duration_days' => 10,
                'duration_minutes' => 60,
                'fees' => 20000.00,
                'car_id' => $car->id, // Add reference to the car
            ]);
        }
    }
}
