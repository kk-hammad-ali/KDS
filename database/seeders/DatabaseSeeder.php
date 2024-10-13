<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        $this->call(UserSeeder::class);
        $this->call(CouponSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(InstructorSeeder::class);
        $this->call(CarSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(LeavesTableSeeder::class);
        // $this->call(ScheduleSeeder::class);
        $this->call(InvoiceSeeder::class);
    }
}
