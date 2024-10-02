<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Employee;
use App\Models\Schedule;
use App\Models\Course;
use App\Models\Coupon;
use Illuminate\Validation\Rule;
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

    public function adminUpdateFormStudent(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'father_husband_name' => 'required|string|max:255',
            // 'cnic' => 'required|string|unique:students,cnic,' . $id,
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'secondary_phone' => 'nullable|string|max:15',
            'instructor_id' => 'required|exists:instructors,id',
            'vehicle_id' => 'required|exists:cars,id',
            'class_start_time' => 'required|date_format:H:i',
            'class_duration' => 'required|integer|min:30',
            'admission_date' => 'required|date',
            'driving_time_per_week' => 'required|integer',
            'practical_driving_hours' => 'required|integer',
            'theory_classes' => 'required|integer',
        ]);

        // Find the student by ID
        $student = Student::findOrFail($id);

        // Calculate class end time
        $class_end_time = Carbon::parse($request->class_start_time)
            ->addMinutes((int)$request->class_duration)
            ->format('H:i:s');

        // Calculate course end date
        $course_end_date = Carbon::parse($request->admission_date)
            ->addDays((int)$student->course_duration);

        // Check for overlapping schedule
        $overlappingSchedule = Schedule::where('instructor_id', $request->instructor_id)
            ->where('vehicle_id', $request->vehicle_id)
            ->where(function ($query) use ($request, $class_end_time) {
                $query->where('class_date', $request->admission_date)
                    ->whereTime('start_time', '<', $class_end_time)
                    ->whereTime('end_time', '>', $request->class_start_time);
            })->exists();

        if ($overlappingSchedule) {
            return redirect()->back()->withErrors(['error' => 'The selected time slot or car is already booked.'])->withInput();
        }

        // Update the user name if present
        if ($student->user) {
            $student->user->update([
                'name' => $validated['name'],
            ]);
        } else {
            // Handle the case where the user is not found
            return redirect()->back()->withErrors('User associated with the student could not be found.');
        }

        // Update student entry
        $student->update([
            'father_or_husband_name' => $validated['father_husband_name'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'optional_phone' => $validated['secondary_phone'] ?? null,
            'admission_date' => $validated['admission_date'],
            'driving_time_per_week' => $validated['driving_time_per_week'],
            'practical_driving_hours' => $validated['practical_driving_hours'],
            'theory_classes' => $validated['theory_classes'],
            'instructor_id' => $validated['instructor_id'],
            'vehicle_id' => $validated['vehicle_id'],
            'course_duration' => $student->course_duration,  // course_duration is not editable
            'class_start_time' => $validated['class_start_time'],
            'class_end_time' => $class_end_time,
            'class_duration' => $validated['class_duration'],
            'course_end_date' => $course_end_date,
            'form_type' => 'admin',
        ]);

        // Delete existing schedules if they need to be replaced
        Schedule::where('student_id', $student->id)->delete();

        // dd($request->class_start_time);
        // dd($class_end_time);

        // Create updated schedule
        Schedule::create([
            'student_id' => $student->id,
            'instructor_id' => $request->instructor_id,
            'vehicle_id' => $request->vehicle_id,
            'class_date' => $request->admission_date,  // Start date
            'class_end_date' => $course_end_date,      // End date
            'start_time' => $request->class_start_time,
            'end_time' => $class_end_time,
        ]);

        // Redirect back with success message
        return redirect()->route('admin.allStudents')->with('success', 'Student and schedule updated successfully.');
    }

}
