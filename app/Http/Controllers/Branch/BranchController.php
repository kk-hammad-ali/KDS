<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\Branch;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class BranchController extends Controller
{
    public function index()
    {
        return view('public.branch');
    }

    public function adminindex()
    {
        $branches = Branch::all();
        // $managers = User::role('manager')->get();

        return view('branches.index', compact('branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            // 'manager_id' => 'required|exists:users,id',
        ]);

        Branch::create([
            'name' => $request->name,
            'address' => $request->address,
            // 'manager_id' => $request->manager_id,
        ]);

        return redirect()->route('admin.allBranches')->with('success', 'Branch created successfully');
    }

    // public function edit($id)
    // {
    //     $branch = Branch::findOrFail($id);
    //     $managers = User::role('manager')->get(); // Fetch managers for the dropdown

    //     return view('admin.branches.edit', compact('branch', 'managers'));
    // }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            // 'manager_id' => 'required|exists:users,id',
        ]);

        $branch = Branch::findOrFail($id);
        $branch->update([
            'name' => $request->name,
            'address' => $request->address,
            // 'manager_id' => $request->manager_id,
        ]);

        return redirect()->route('admin.allBranches')->with('success', 'Branch updated successfully');
    }

    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return redirect()->route('admin.allBranches')->with('success', 'Branch deleted successfully');
    }

    public function switchBranch(Request $request)
    {
        $request->validate([
            'branch_id' => 'nullable|exists:branches,id',
        ]);
        $user = auth()->user();
        $user->current_branch_id = $request->branch_id;
        $user->save();

        return redirect()->back()->with('success', 'Branch switched successfully');
    }

}
