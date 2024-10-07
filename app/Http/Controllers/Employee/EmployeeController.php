<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Instructor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function adminAllEmployees()
    {
        $employees = Employee::with('user')->paginate(10);
        return view('employees.all_employees', compact('employees'));
    }

    public function adminAddEmployee()
    {
        return view('employees.add_employee');
    }

    public function adminStoreEmployee(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|string|unique:employees,phone',
            'password' => 'required|string|min:8',
            'id_card_number' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'gender' => 'required|in:male,female',
            'salary' => 'required|numeric|min:0',
            'designation' => 'nullable|string|max:255',
            // Instructor-specific fields
            'license_city' => 'required_if:designation,Instructor|string|max:255',
            'license_start_date' => 'required_if:designation,Instructor|date',
            'license_end_date' => 'required_if:designation,Instructor|date',
            'license_number' => 'required_if:designation,Instructor|string|max:50',
            'experience' => 'nullable|string|max:255',
        ]);



        // Create the user first
        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role' => 1, // Assuming 1 is for employee role
        ]);


        // Handle the file upload if a picture is provided
        $picturePath = null;
        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $picturePath = $picture->store('employees', 'public');
            $picturePath = str_replace('public', '', $picturePath);
        }



        // Create the employee
        $employee = Employee::create([
            'user_id' => $user->id,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'picture' => $picturePath,
            'gender' => $request->gender,
            'salary' => $request->salary,
            'designation' => $request->designation,
            'id_card_number' => $request->id_card_number,
        ]);



        // If the designation is Instructor, create an instructor entry
        if ($request->designation == 'Instructor') {
            Instructor::create([
                'employee_id' => $employee->id,
                'license_city' => $request->license_city,
                'license_start_date' => $request->license_start_date,
                'license_end_date' => $request->license_end_date,
                'license_number' => $request->license_number,
                'experience' => $request->experience,
            ]);
        }



        return redirect()->route('admin.allEmployees')->with('success_employee', 'Employee added successfully.');
    }

    public function adminEditEmployee($id)
    {
        $employee = Employee::findOrFail($id);
        $designations = ['Manager', 'Instructor', 'Others']; // Add other designations here
        return view('employees.edit_employee', compact('employee', 'designations'));
    }

    public function adminUpdateEmployee(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id, // Email must be unique except for this employee
            'phone' => 'required|string|unique:employees,phone,' . $id, // Phone must be unique except for this employee
            'address' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'gender' => 'required|in:male,female',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'id_card_number' => 'required|string|max:50',
            'designation' => 'nullable|string|max:255',
        ]);

        // Find the employee and the related user
        $employee = Employee::findOrFail($id);
        $user = $employee->user;

        // Update the user information
        $user->update([
            'name' => $request->name,
        ]);

        // Handle the file upload if a new picture is provided
        if ($request->hasFile('picture')) {
            // Delete old picture if exists
            if ($employee->picture) {
                Storage::disk('public')->delete($employee->picture);
            }

            $picture = $request->file('picture');
            $picturePath = $picture->store('employees', 'public');
            $picturePath = str_replace('public', '', $picturePath);
        } else {
            $picturePath = $employee->picture;
        }

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
        ]);

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
