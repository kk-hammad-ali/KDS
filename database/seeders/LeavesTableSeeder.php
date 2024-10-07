<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LeavesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample data for leaves
        $leaves = [
            [
                'user_id' => 1,
                'start_date' => Carbon::now()->addDays(1)->toDateString(),
                'end_date' => Carbon::now()->addDays(3)->toDateString(),
                'leave_reason' => 'Medical leave',
                'status' => 'pending',
            ],
            [
                'user_id' => 2,
                'start_date' => Carbon::now()->addDays(4)->toDateString(),
                'end_date' => Carbon::now()->addDays(6)->toDateString(),
                'leave_reason' => 'Family emergency',
                'status' => 'approved',
            ],
            [
                'user_id' => 3,
                'start_date' => Carbon::now()->addDays(7)->toDateString(),
                'end_date' => Carbon::now()->addDays(10)->toDateString(),
                'leave_reason' => 'Vacation',
                'status' => 'pending',
            ],
            [
                'user_id' => 4,
                'start_date' => Carbon::now()->addDays(11)->toDateString(),
                'end_date' => Carbon::now()->addDays(12)->toDateString(),
                'leave_reason' => 'Personal leave',
                'status' => 'rejected',
            ],
            [
                'user_id' => 5,
                'start_date' => Carbon::now()->addDays(13)->toDateString(),
                'end_date' => Carbon::now()->addDays(15)->toDateString(),
                'leave_reason' => 'Bereavement',
                'status' => 'approved',
            ],
        ];

        // Insert data into leaves table
        DB::table('leaves')->insert($leaves);
    }
}
