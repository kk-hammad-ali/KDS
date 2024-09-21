<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Instructor;
use App\Models\Schedule;
use App\Models\Course;
use App\Models\Coupon;
use App\Models\User;
use App\Models\Car;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class StudentController extends Controller
{
    public function adminAllStudent(){
        $students = Student::with('user')->get();

        return view('admin.students.all_students', compact('students'));
    }


    public function adminAddStudent(Request $request)
    {
        $courses = Course::all();
        $instructors = Instructor::join('users', 'instructors.user_id', '=', 'users.id')
                         ->where('users.role', 1)
                         ->select('instructors.*')
                         ->get();
        $cars = Car::all();

        return view('admin.students.add_student', compact('courses', 'cars', 'instructors'));
    }

    public function adminEditStudent($id){
        $student = Student::with('user')->findOrFail($id);
        $instructors = Instructor::all();
        $cars = Car::all();
        $courses = Course::all();

        return view('admin.students.edit_student', compact('student', 'instructors', 'cars', 'courses'));
    }

    public function adminStoreStudent(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'father_or_husband_name' => 'required|string|max:255',
            'cnic' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'optional_phone' => 'nullable|string|max:15',
            'admission_date' => 'required|date',
            'driving_time_per_week' => 'required|numeric',
            'course_id' => 'required|exists:courses,id',
            'fees' => 'required|numeric',
            'practical_driving_hours' => 'required|numeric',
            'theory_classes' => 'required|numeric',
            'coupon_code' => 'nullable|string|max:50',
            'instructor_id' => 'required|exists:instructors,id',
            'vehicle_id' => 'required|exists:cars,id',
            'course_duration' => 'required|integer',
            'class_start_time' => 'required',
            'class_duration' => 'required|integer',
        ]);

        // Retrieve the selected course
        $course = Course::find($validated['course_id']);

        // Initialize fees with the course fees
        $fees = $course->fees;

        // Apply coupon discount if a valid coupon is provided
        if ($request->filled('coupon_code')) {
            $coupon = Coupon::where('code', $validated['coupon_code'])
                            ->where('is_active', true)
                            ->where('expiry_date', '>=', now())
                            ->first();

            if ($coupon) {
                $fees -= $coupon->discount;
            }
        }

        // Create the user
        $user = User::create([
            'name' => $validated['name'],
            'password' => Hash::make("12345678"),
        ]);

        // Calculate class end time based on the start time and duration
        $class_end_time = Carbon::parse($request->class_start_time)
            ->addMinutes((int)$request->class_duration)
            ->format('H:i:s');

        // Calculate the course end date
        $course_end_date = Carbon::parse($request->admission_date)
            ->addDays((int)$request->course_duration)
            ->format('Y-m-d');

        // Check for overlapping schedules in the schedules table (now including vehicle check)
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

        // Create the student
        $student = Student::create([
            'user_id' => $user->id,
            'father_or_husband_name' => $validated['father_or_husband_name'],
            'cnic' => $validated['cnic'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'optional_phone' => $validated['optional_phone'],
            'admission_date' => $validated['admission_date'],
            'driving_time_per_week' => $validated['driving_time_per_week'],
            'fees' => $fees,
            'practical_driving_hours' => $validated['practical_driving_hours'],
            'theory_classes' => $validated['theory_classes'],
            'coupon_code' => $validated['coupon_code'],
            'course_id' => $validated['course_id'],
            'instructor_id' => $request->instructor_id,
            'vehicle_id' => $request->vehicle_id,
            'course_duration' => $request->course_duration,
            'class_start_time' => $request->class_start_time,
            'class_end_time' => $class_end_time,
            'course_end_date' => $course_end_date,
            'class_duration' => $request->class_duration,
        ]);

        // Automatically create the schedule
        $current_date = Carbon::parse($request->admission_date);
        for ($i = 0; $i < $request->course_duration; $i++) {
            Schedule::create([
                'student_id' => $student->id,
                'instructor_id' => $request->instructor_id,
                'vehicle_id' => $request->vehicle_id,
                'class_date' => $current_date->format('Y-m-d'),
                'start_time' => $request->class_start_time,
                'end_time' => $class_end_time,
            ]);
            $current_date->addDay();
        }

        return redirect()->route('admin.allStudents')->with('success_student', 'Student added successfully.');
    }


    public function adminUpdateStudent(Request $request, $id)
    {
        // Validate only personal attributes
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'father_or_husband_name' => 'required|string|max:255',
            'cnic' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'optional_phone' => 'nullable|string|max:15',
        ]);

        // Find the student by id
        $student = Student::findOrFail($id);
        $user = $student->user;  // Retrieve the associated user

        // Update the user name
        $user->update([
            'name' => $validated['name'],
        ]);

        // Update student personal record
        $student->update([
            'father_or_husband_name' => $validated['father_or_husband_name'],
            'cnic' => $validated['cnic'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'optional_phone' => $validated['optional_phone'],
        ]);

        // Return success message and redirect
        return redirect()->route('admin.allStudents')->with('success', 'Student updated successfully.');
    }


    public function adminDestroyStudent($id)
    {
        // Retrieve the student instance by ID
        $student = Student::findOrFail($id);

        // Delete the associated user first
        $student->user()->delete();

        // Then delete the student
        $student->delete();

        // Redirect back with a success message
        return redirect()->route('admin.allStudents')->with('success_deleted_student', 'Student deleted successfully.');
    }

    public function instructorStudents()
    {
        // $instructor = auth()->user()->instructor; // Assuming the instructor is logged in and has a relationship to the instructor model

        // Fetch students who belong to the logged-in instructor
        $students = Student::with('user')
            ->where('instructor_id', 1) // Filter students by the instructor ID
            ->get();

        return view('instructor.my_students', compact('students'));
    }
}
