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
        $cars = [
            // Suzuki Mehran
            ['car_model_id' => 1, 'registration_number' => 'MEH-001'],
            ['car_model_id' => 1, 'registration_number' => 'MEH-002'],

            // Suzuki Alto
            ['car_model_id' => 2, 'registration_number' => 'ALT-001'],
            ['car_model_id' => 2, 'registration_number' => 'ALT-002'],

            // Toyota Vitz
            ['car_model_id' => 3, 'registration_number' => 'VIT-001'],
            ['car_model_id' => 3, 'registration_number' => 'VIT-002'],

            // Daihatsu Mira
            ['car_model_id' => 4, 'registration_number' => 'MIR-001'],
            ['car_model_id' => 4, 'registration_number' => 'MIR-002'],

            // Honda City
            ['car_model_id' => 5, 'registration_number' => 'HON-001'],
            ['car_model_id' => 5, 'registration_number' => 'HON-002'],

            // Bike (CD-70)
            ['car_model_id' => 6, 'registration_number' => 'CD70-001'],
            ['car_model_id' => 6, 'registration_number' => 'CD70-002'],

        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}
