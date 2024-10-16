<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Admin Permissions
        Permission::create(['name' => 'view dashboard']);
        Permission::create(['name' => 'view admission forms']);
        Permission::create(['name' => 'manage students']);
        Permission::create(['name' => 'add students']);
        Permission::create(['name' => 'edit students']);
        Permission::create(['name' => 'delete students']);
        Permission::create(['name' => 'manage instructors']);
        Permission::create(['name' => 'add instructors']);
        Permission::create(['name' => 'edit instructors']);
        Permission::create(['name' => 'delete instructors']);
        Permission::create(['name' => 'manage employees']);
        Permission::create(['name' => 'add employees']);
        Permission::create(['name' => 'edit employees']);
        Permission::create(['name' => 'delete employees']);
        Permission::create(['name' => 'manage courses']);
        Permission::create(['name' => 'add courses']);
        Permission::create(['name' => 'edit courses']);
        Permission::create(['name' => 'delete courses']);
        Permission::create(['name' => 'view all leaves']);
        Permission::create(['name' => 'update leave status']);
        Permission::create(['name' => 'manage leaves']);
        Permission::create(['name' => 'add leaves']);
        Permission::create(['name' => 'edit leaves']);
        Permission::create(['name' => 'delete leaves']);
        Permission::create(['name' => 'manage coupons']);
        Permission::create(['name' => 'add coupons']);
        Permission::create(['name' => 'edit coupons']);
        Permission::create(['name' => 'delete coupons']);
        Permission::create(['name' => 'manage cars']);
        Permission::create(['name' => 'add cars']);
        Permission::create(['name' => 'edit cars']);
        Permission::create(['name' => 'delete cars']);
        Permission::create(['name' => 'manage fixed expenses']);
        Permission::create(['name' => 'add fixed expenses']);
        Permission::create(['name' => 'edit fixed expenses']);
        Permission::create(['name' => 'delete fixed expenses']);
        Permission::create(['name' => 'manage car expenses']);
        Permission::create(['name' => 'add car expenses']);
        Permission::create(['name' => 'edit car expenses']);
        Permission::create(['name' => 'delete car expenses']);
        Permission::create(['name' => 'manage daily expenses']);
        Permission::create(['name' => 'add daily expenses']);
        Permission::create(['name' => 'edit daily expenses']);
        Permission::create(['name' => 'delete daily expenses']);
        Permission::create(['name' => 'view invoices']);
        Permission::create(['name' => 'manage invoices']);
        Permission::create(['name' => 'view attendance']);
        Permission::create(['name' => 'mark student attendance']);
        Permission::create(['name' => 'store student attendance']);
        Permission::create(['name' => 'view instructor attendance']);
        Permission::create(['name' => 'mark instructor attendance']);
        Permission::create(['name' => 'store instructor attendance']);

        // Instructor Permissions
        Permission::create(['name' => 'view instructor dashboard']);
        Permission::create(['name' => 'manage leaves for instructor']);
        Permission::create(['name' => 'add leaves for instructor']);
        Permission::create(['name' => 'edit leaves for instructor']);
        Permission::create(['name' => 'delete leaves for instructor']);
        Permission::create(['name' => 'view students under instructor']);
        Permission::create(['name' => 'manage attendance for instructor']);
        Permission::create(['name' => 'mark attendance for students']);
        Permission::create(['name' => 'store attendance for students']);

        // Student Permissions
        Permission::create(['name' => 'view student dashboard']);
        Permission::create(['name' => 'manage leaves for student']);
        Permission::create(['name' => 'add leaves for student']);
        Permission::create(['name' => 'edit leaves for student']);
        Permission::create(['name' => 'delete leaves for student']);
        Permission::create(['name' => 'view certificate']);
        Permission::create(['name' => 'download certificate']);
    }
}
