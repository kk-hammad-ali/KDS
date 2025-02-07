<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(BranchSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CarModelSeeder::class);
        $this->call(CarSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(EmployeeSeeder::class);
        // $this->call(StudentSeeder::class);
        // $this->call(FormSubmittedSeeder::class);
        $this->call(InstructorSeeder::class);
        // $this->call(CouponSeeder::class);
        // $this->call(LeavesTableSeeder::class);
        // $this->call(InvoiceSeeder::class);
    }
}
