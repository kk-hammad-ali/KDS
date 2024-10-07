<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coupons = [];

        for ($i = 0; $i < 5; $i++) {
            $coupons[] = [
                'code' => strtoupper(Str::random(10)), // Generate a random 10-character coupon code
                'discount' => rand(5, 50), // Random discount between 5 and 50
                'expiry_date' => Carbon::now()->addDays(rand(30, 365)), // Expiry date between 1 month to 1 year
                'is_active' => rand(0, 1), // Randomly mark coupon as active or inactive
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert the coupons into the table
        DB::table('coupons')->insert($coupons);
    }
}
