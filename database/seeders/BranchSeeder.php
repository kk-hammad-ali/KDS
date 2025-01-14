<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;
use App\Models\User;

class BranchSeeder extends Seeder
{
    public function run()
    {
        // Create branches without assigning managers (as manager is now handled by user's current_branch_id)
        $branch1 = Branch::create([
            'name' => 'Main Branch',
            'address' => 'I-10',
        ]);
        // Assign the branches to managers in the EmployeeSeeder, as per the updated flow
    }
}
