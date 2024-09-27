<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Employee;
use App\Models\Schedule;
use App\Models\Course;
use App\Models\Coupon;
use App\Models\Instructor;
use App\Models\User;
use App\Models\Car;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AdmissionFormController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        $cars = Car::all();
        return view('public.admission.admission', compact('courses', 'cars'));
    }

    public function adminallAdmssionForm()
    {
        $students = Student::where('form_type', 'admission')->get();
        $instructors = Instructor::with('employee.user')->get();
        $courses = Course::all();
        $cars = Car::all();
        return view('admin.students.admisson_form', compact('students', 'courses', 'cars', 'instructors'));
    }

    public function store(Request $request)
    {
        // Debugging output
        // dd($request->all());

        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'father_husband_name' => 'required|string|max:255',
            'cnic' => 'required|string|unique:students',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'secondary_phone' => 'nullable|string|max:15',
            'transmission_type' => 'required|string|in:Manual,Automatic',
            'course_id' => 'required|exists:courses,id',
            'fees' => 'required|numeric',
            'course_duration' => 'required|integer',
        ]);


        // Debugging output
        // dd($validated);

        // Create user
        $user = User::create([
            'name' => $validated['name'],
            'password' => Hash::make("12345678"), // Default password
        ]);

        // Create student entry
        Student::create([
            'user_id' => $user->id,
            'father_or_husband_name' => $validated['father_husband_name'],
            'cnic' => $validated['cnic'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'optional_phone' => $validated['secondary_phone'],
            'admission_date' => now(), // Set admission date to now
            'driving_time_per_week' => 0, // Default or empty value
            'fees' => $validated['fees'],
            'practical_driving_hours' => 0, // Default or empty value
            'theory_classes' => 0, // Default or empty value
            'coupon_code' => null, // Default or empty value
            'course_id' => $validated['course_id'],
            'instructor_id' => null, // Default or empty value
            'vehicle_id' => null, // Default or empty value
            'course_duration' => $validated['course_duration'],
            'class_start_time' => null, // Default or empty value
            'class_end_time' => null, // Default or empty value
            'class_duration' => 0, // Default or empty value
            'course_end_date' => now()->addDays($validated['course_duration']),
            'transmission' => $validated['transmission_type'],
            'form_type' => 'admission',
        ]);

        // Redirect back with success message
        return redirect()->route('public.admission.form')->with('success', 'Application submitted successfully.');
    }
}
