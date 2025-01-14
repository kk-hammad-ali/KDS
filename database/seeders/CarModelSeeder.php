<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarModel;

class CarModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carModels = [
            ['name' => 'Suzuki Mehran', 'transmission' => 'manual'],
            ['name' => 'Suzuki Alto', 'transmission' => 'manual'],
            ['name' => 'Toyota Vitz', 'transmission' => 'automatic'],
            ['name' => 'Daihatsu Mira', 'transmission' => 'automatic'],
            ['name' => 'Honda City', 'transmission' => 'automatic'],
            ['name' => 'Bike (CD-70)', 'transmission' => 'manual'],
        ];

        foreach ($carModels as $carModel) {
            CarModel::create($carModel);
        }
    }
}
