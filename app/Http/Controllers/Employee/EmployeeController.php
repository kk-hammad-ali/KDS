<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Instructor;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\EmailController;

class EmployeeController extends Controller
{
    protected $emailController;

    public function __construct(EmailController $emailController)
    {
        $this->emailController = $emailController;
    }

    public function adminAllEmployees()
    {
        $employees = Employee::with('user')->paginate(10);
        return view('employees.all_employees', compact('employees'));
    }

    public function adminAddEmployee()
    {
        $branches = Branch::all();
        return view('employees.add_employee', compact('branches'));
    }


    public function adminEditEmployee($id)
    {
        $employee = Employee::findOrFail($id);
        $designations = ['Manager', 'Instructor', 'Others']; // Add other designations here
        return view('employees.edit_employee', compact('employee', 'designations'));
    }

    public function adminStoreEmployee(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'required|string|unique:employees,phone',
            'password' => 'required|string|min:8',
            'id_card_number' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'gender' => 'required|in:male,female',
            'salary' => 'required|numeric|min:0',
            'designation' => 'nullable|string|max:255',
            'branch_id' => 'required|exists:branches,id',
            'license_city' => 'required_if:designation,Instructor|string|max:255',
            'license_start_date' => 'required_if:designation,Instructor|date',
            'license_end_date' => 'required_if:designation,Instructor|date',
            'license_number' => 'required_if:designation,Instructor|string|max:50',
            'experience' => 'nullable|string|max:255',
        ]);

        // Create the user for Manager and Instructor, but not for Others
        if ($request->designation != 'Others') {
            $user = User::create([
                'name' => $request->name,
                'password' => Hash::make($request->password),
            ]);
        } else {
            $user = null;
        }

        // Handle file upload
        $picturePath = $request->hasFile('picture') ? $request->file('picture')->store('employees', 'public') : null;

        // Create the employee
        $employee = Employee::create([
            'user_id' => $user ? $user->id : null,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'picture' => $picturePath,
            'gender' => $request->gender,
            'salary' => $request->salary,
            'designation' => $request->designation,
            'id_card_number' => $request->id_card_number,
            'branch_id' => $request->branch_id,
        ]);

        // Assign roles based on designation
        if ($request->designation == 'Instructor') {
            $user->assignRole('instructor');
            Instructor::create([
                'employee_id' => $employee->id,
                'license_city' => $request->license_city,
                'license_start_date' => $request->license_start_date,
                'license_end_date' => $request->license_end_date,
                'license_number' => $request->license_number,
                'experience' => $request->experience,
            ]);

            $this->emailController->sendInstructorWelcome($instructor, $user->name, $request->password);

        } elseif ($request->designation == 'Manager') {
            $user->assignRole('manager');
            $user->update(['current_branch_id' => $request->branch_id]);
        }

         // For 'Others', just assign the branch to the employee directly
        if ($request->designation == 'Others') {
            $employee->update(['branch_id' => $request->branch_id]);
        }

        return redirect()->route('admin.allEmployees')->with('success_employee', 'Employee added successfully.');
    }

    public function adminUpdateEmployee(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id,
            'phone' => 'required|string|unique:employees,phone,' . $id,
            'address' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'gender' => 'required|in:male,female',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'id_card_number' => 'required|string|max:50',
            'designation' => 'nullable|string|max:255',
            'branch_id' => 'required|exists:branches,id',
        ]);

        // Find the employee and the related user
        $employee = Employee::findOrFail($id);
        $user = $employee->user;

        // Update the user information for non-'Others' employees
        if ($user) {
            $user->update(['name' => $request->name]);
        }

        // Handle the file upload if a new picture is provided
        $picturePath = $request->hasFile('picture') ? $request->file('picture')->store('employees', 'public') : $employee->picture;

        // Update employee data
        $employee->update([
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'salary' => $request->salary,
            'gender' => $request->gender,
            'designation' => $request->designation,
            'picture' => $picturePath,
            'id_card_number' => $request->id_card_number,
            'branch_id' => $request->branch_id, // Update branch
        ]);

        // Update roles based on designation
        if ($request->designation == 'Manager' && $user) {
            $user->syncRoles(['manager']);
        } elseif ($request->designation == 'Instructor' && $user) {
            $user->syncRoles(['instructor']);
        }

        return redirect()->route('admin.allEmployees')->with('success_updated_employee', 'Employee updated successfully.');
    }


    public function adminDestroyEmployee($id)
    {
        $employee = Employee::findOrFail($id);

        // Delete employee's picture if it exists
        if ($employee->picture) {
            Storage::disk('public')->delete('employees/' . $employee->picture);
        }

        // Delete the associated user
        if ($employee->user) {
            $employee->user->delete(); // This will also delete the user
        }

        // Delete the employee record
        $employee->delete();

        return redirect()->route('admin.allEmployees')->with('success_deleted_employee', 'Employee and associated user deleted successfully.');
    }
}
