<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $instructorRole = Role::firstOrCreate(['name' => 'instructor']);
        $studentRole = Role::firstOrCreate(['name' => 'student']);
        $managerRole = Role::firstOrCreate(['name' => 'manager']);

        // Admin Permissions
        $adminPermissions = [
            'view dashboard',
            'view admission forms',
            'manage students',
            'add students',
            'edit students',
            'delete students',
            'manage instructors',
            'add instructors',
            'edit instructors',
            'delete instructors',
            'manage employees',
            'add employees',
            'edit employees',
            'delete employees',
            'manage courses',
            'add courses',
            'edit courses',
            'delete courses',
            'view all leaves',
            'update leave status',
            'manage leaves',
            'add leaves',
            'edit leaves',
            'delete leaves',
            'manage coupons',
            'add coupons',
            'edit coupons',
            'delete coupons',
            'manage cars',
            'add cars',
            'edit cars',
            'delete cars',
            'manage fixed expenses',
            'add fixed expenses',
            'edit fixed expenses',
            'delete fixed expenses',
            'manage car expenses',
            'add car expenses',
            'edit car expenses',
            'delete car expenses',
            'manage daily expenses',
            'add daily expenses',
            'edit daily expenses',
            'delete daily expenses',
            'view invoices',
            'manage invoices',
            'view attendance',
            'mark student attendance',
            'store student attendance',
            'view instructor attendance',
            'mark instructor attendance',
            'store instructor attendance',
        ];

        // Assign permissions to admin role
        $adminRole->givePermissionTo($adminPermissions);

        // Manager gets a subset of admin permissions for now
        $managerPermissions = [
            'view dashboard',
            'manage students',
            'add students',
            'edit students',
            'manage instructors',
            'add instructors',
            'edit instructors',
            'manage courses',
            'add courses',
            'edit courses',
            'view all leaves',
            'manage leaves',
            'add leaves',
            'edit leaves',
            'manage cars',
            'add cars',
            'edit cars',
            'manage daily expenses',
            'add daily expenses',
            'edit daily expenses',
            'view invoices',
            'manage invoices',
        ];

        // Assign permissions to manager role
        $managerRole->givePermissionTo($managerPermissions);

        // Instructor Permissions
        $instructorPermissions = [
            'view instructor dashboard',
            'view attendance',
            'manage leaves for instructor',
            'add leaves for instructor',
            'edit leaves for instructor',
            'delete leaves for instructor',
            'view students under instructor',
            'mark attendance for students',
            'store attendance for students',
        ];

        // Assign permissions to instructor role
        $instructorRole->givePermissionTo($instructorPermissions);

        // Student Permissions
        $studentPermissions = [
            'view student dashboard',
            'manage leaves for student',
            'add leaves for student',
            'edit leaves for student',
            'delete leaves for student',
            'view certificate',
            'download certificate',
        ];

        // Assign permissions to student role
        $studentRole->givePermissionTo($studentPermissions);
    }
}
