<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instructor;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Schedule\ScheduleController;

class InstructorController extends Controller
{

    protected $studentController;
    protected $scheduleController;

    public function __construct(StudentController $studentController, ScheduleController $scheduleController)
    {
        $this->studentController = $studentController;
        $this->scheduleController = $scheduleController;
    }

    public function index()
    {
        // Assuming the instructor is logged in
        $instructor = auth()->user()->instructor;

        // Call the instructorStudents function from the StudentController
        $studentsResponse = $this->studentController->instructorStudents();

        // Get the 'students' data from the response
        $students = $studentsResponse->getData()->students;

        // Fetch instructors and pass data to the dashboard view
        $instructors = Instructor::with('employee.user')->get();

        // Fetch student schedules (events)
        $schedulesResponse = $this->scheduleController->instructorSchedules(request());
        $events = $schedulesResponse->getData()->events;

        // Pass instructors, students, and events to the dashboard view
        return view('instructor.dashboard', compact('instructors', 'students', 'events'));
    }


    public function adminAllInstructors()
    {
        $instructors = Instructor::with('employee.user')->paginate(10);
        return view('admin.instructors.all_instructors', compact('instructors'));
    }

    public function adminAddInstructor()
    {
        return view('admin.instructors.add_instructor');
    }

    public function adminStoreInstructor(Request $request)
    {
            // Enhanced validation with custom error messages
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'password' => 'required|string|min:8',
                'email' => 'required|email|unique:employees,email',
                'phone' => 'required|string|unique:employees,phone',
                'address' => 'required|string|max:255',
                'salary' => 'required|numeric|min:0',
                'id_card_number' => 'required|string|max:50',
                'license_city' => 'required|string|max:255',
                'license_start_date' => 'required|date',
                'license_end_date' => 'required|date|after:license_start_date',  // Ensure the end date is after the start date
                'experience' => 'nullable|string|max:50',
                'license_number' => 'required|string|max:50',
                'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            ]);

            // Log validation success and move to the second dd
            // dd($validatedData);

            // Create the User
            $user = User::create([
                'name' => $request->name,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole('instructor');

            // Handle Picture Upload
            $picturePath = null;
            if ($request->hasFile('picture')) {
                $picturePath = $request->file('picture')->store('employees', 'public');
            }

            // Create Employee
            $employee = Employee::create([
                'user_id' => $user->id,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'salary' => $request->salary,
                'gender' => $request->gender,
                'id_card_number' => $request->id_card_number,
                'picture' => $picturePath,
                'designation' => 'Instructor',
            ]);

            // Create Instructor
            Instructor::create([
                'employee_id' => $employee->id,
                'license_city' => $request->license_city,
                'license_start_date' => $request->license_start_date,
                'license_end_date' => $request->license_end_date,
                'experience' => $request->experience,
                'license_number' => $request->license_number,
            ]);

            return redirect()->route('admin.allInstructors')->with('success_instructor', 'Instructor added successfully.');
    }

    public function adminEditInstructor($id)
    {
        $instructor = Instructor::with('employee.user')->findOrFail($id);
        return view('admin.instructors.edit_instructor', compact('instructor'));
    }

    public function adminUpdateInstructor(Request $request, $id)
    {
        // Fetch the instructor to get the employee's id
        $instructor = Instructor::with('employee.user')->findOrFail($id);
        $employee = $instructor->employee;

        // Update validation
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:employees,phone,' . $employee->id, // Ensure phone is unique except for the current employee
            'address' => 'required|string|max:255',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'gender' => 'required|in:male,female',
            'license_number' => 'required|string|max:255',
            'id_card_number' => 'required|string|max:255',
            'license_city' => 'required|string|max:255',
            'license_start_date' => 'required|date',
            'license_end_date' => 'required|date',
            'salary' => 'required|numeric|min:0',
        ]);

        // Update the user information
        $user = $employee->user;
        $user->name = $request->name;
        $user->save();

        // Handle the file upload if a new picture is provided
        $picturePath = $employee->picture;
        if ($request->hasFile('picture')) {
            if ($employee->picture) {
                Storage::disk('public')->delete('employees/' . $employee->picture);
            }
            $picture = $request->file('picture');
            $picturePath = $picture->store('employees', 'public');
        }

        // Update employee data
        $employee->update([
            'phone' => $request->phone,
            'address' => $request->address,
            'picture' => $picturePath,
            'gender' => $request->gender,
            'salary' => $request->salary,
        ]);

        // Update instructor data
        $instructor->update([
            'id_card_number' => $request->id_card_number,
            'license_city' => $request->license_city,
            'license_start_date' => $request->license_start_date,
            'license_end_date' => $request->license_end_date,
            'license_number' => $request->license_number,
        ]);

        return redirect()->route('admin.allInstructors')->with('success_updated_instructor', 'Instructor updated successfully.');
    }


    public function adminDestroyInstructor($id)
    {
        $instructor = Instructor::with('employee')->findOrFail($id);

        // Check if the instructor has a picture and delete it if necessary
        if ($instructor->employee->picture) {
            Storage::disk('public')->delete('employees/' . $instructor->employee->picture);
        }

        // Delete the instructor and its related employee
        $instructor->employee->delete();
        $instructor->delete();

        return redirect()->route('admin.allInstructors')->with('success_deleted_instructor', 'Instructor deleted successfully.');
    }
}
