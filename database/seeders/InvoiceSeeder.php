<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Schedule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Ensure there are schedules in the database before seeding invoices
        $scheduleIds = DB::table('schedules')->pluck('id');

        foreach (range(1, 3) as $index) {  // Change to 3 invoices
            DB::table('invoices')->insert([
                'schedule_id' => $faker->randomElement($scheduleIds),
                'receipt_number' => $faker->unique()->numerify('REC-#####'),
                'invoice_date' => $faker->date(),
                'paid_by' => $faker->name(),
                'amount_in_english' => 'English Ammount',
                'balance' => $faker->randomFloat(2, 0, 500),
                'branch' => $faker->city(),
                'amount_received' => $faker->randomFloat(2, 100, 1000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
