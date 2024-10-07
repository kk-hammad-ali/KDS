<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Employee;
use App\Models\Schedule;
use App\Models\Course;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\Coupon;
use App\Models\Instructor;
use App\Models\Invoice;
use App\Models\User;
use App\Models\Car;
use App\Models\Leave;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\Schedule\ScheduleController;
use App\Http\Controllers\Invoice\InvoiceController;
use Illuminate\Pagination\LengthAwarePaginator;


use Carbon\Carbon;

class StudentController extends Controller
{

    protected $emailController;
    protected $scheduleController;
    protected $invoiceController;

    public function __construct(InvoiceController $invoiceController, EmailController $emailController, ScheduleController $scheduleController)
    {
        $this->emailController = $emailController;
        $this->scheduleController = $scheduleController;
        $this->invoiceController = $invoiceController;
    }

    // public function index()
    // {
    //     // Fetch student schedules
    //     $schedulesResponse = $this->scheduleController->studentSchedules(request());

    //     // Convert schedules to a collection if it's an array
    //     $schedules = collect($schedulesResponse->getData()->schedules); // Ensure it's a collection

    //     // Convert the schedules collection to paginated data
    //     $perPage = 10; // Set the number of items per page
    //     $currentPage = LengthAwarePaginator::resolveCurrentPage();
    //     $schedulesPaginated = new LengthAwarePaginator(
    //         $schedules->forPage($currentPage, $perPage), // Items for the current page
    //         $schedules->count(), // Total number of items
    //         $perPage, // Items per page
    //         $currentPage, // Current page
    //         ['path' => request()->url(), 'query' => request()->query()] // Maintain query parameters in the pagination links
    //     );

    //     // Fetch the student and certificate availability from the CertificateController
    //     $student = Student::where('user_id', Auth::id())->first();
    //     $certificateAvailable = $student && $student->course_end_date <= now();

    //     // Fetch all leaves for the logged-in student
    //     $leaves = Leave::where('user_id', Auth::id())->paginate(10);

    //     // Pass schedules, student data, leave data, and certificate availability to the dashboard view
    //     return view('student.dashboard', compact('schedulesPaginated', 'student', 'certificateAvailable', 'leaves'));
    // }


    public function index()
    {
        // Fetch student schedules (events)
        $schedulesResponse = $this->scheduleController->studentSchedules(request());
        $events = $schedulesResponse->getData()->events;

        // Fetch student and certificate availability
        $student = Student::where('user_id', Auth::id())->first();
        $certificateAvailable = $student && $student->course_end_date <= now();

        // Fetch all leaves for the logged-in student
        $leaves = Leave::where('user_id', Auth::id())->paginate(10);

        // Pass events, student data, leave data, and certificate availability to the dashboard view
        return view('student.dashboard', compact('events', 'student', 'certificateAvailable', 'leaves'));
    }



    public function adminAllStudent()
    {
        $students = Student::with('user')->paginate(10);

        return view('admin.students.all_students', compact('students'));
    }

    public function adminAddStudent()
    {
        $instructors = Instructor::with('employee.user')->get();
        $courses = Course::all();
        $cars = Car::all();

        return view('admin.students.add_student', compact('courses', 'cars', 'instructors'));
    }

    public function adminStoreStudent(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'father_or_husband_name' => 'required|string|max:255',
            'cnic' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'optional_phone' => 'nullable|string|max:15',
            'admission_date' => 'required|date',
            'email' => 'nullable|email',
            'course_id' => 'required|exists:courses,id',
            'fees' => 'required|numeric',
            'practical_driving_hours' => 'required|numeric',
            'theory_classes' => 'required|numeric',
            'coupon_code' => 'nullable|string|max:50',
            'instructor_id' => 'required|exists:employees,id',
            'vehicle_id' => 'required|exists:cars,id',
            'course_duration' => 'required|integer',
            'class_start_time' => 'required',
            'class_duration' => 'required|integer',
            'transmission' => 'required|in:automatic,manual',
            'invoice_date' => 'required|date',
            'amount_received' => 'required|numeric',
            'balance' => 'required|numeric',
            'branch' => 'required|string|max:255',
            'paid_by' => 'required|string|max:255',
            'amount_in_english' => 'required|string|max:255',
        ]);

        // dd($request->all());

        // Calculate class end time
        $class_end_time = Carbon::parse($request->class_start_time)
            ->addMinutes((int)$request->class_duration)
            ->format('H:i:s');

        // Calculate course end date based on course duration
        $course_end_date = Carbon::parse($request->admission_date)
            ->addDays((int)$request->course_duration)
            ->format('Y-m-d');

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

        // Create user
        $user = User::create([
            'name' => $validated['name'],
            'password' => Hash::make("12345678"),
        ]);

        // Create student
        $student = Student::create([
            'user_id' => $user->id,
            'father_or_husband_name' => $validated['father_or_husband_name'],
            'cnic' => $validated['cnic'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'optional_phone' => $validated['optional_phone'],
            'admission_date' => $validated['admission_date'],
            'email' => $validated['email'] ?? null,
            'fees' => $validated['fees'],
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
            'form_type' => 'admin',
            'transmission' => $validated['transmission'],
        ]);

        // Create schedule
        $schedule = Schedule::create([
            'student_id' => $student->id,
            'instructor_id' => $request->instructor_id,
            'vehicle_id' => $request->vehicle_id,
            'class_date' => $request->admission_date,  // Start date
            'class_end_date' => $course_end_date,      // End date
            'start_time' => $request->class_start_time,
            'end_time' => $class_end_time,
        ]);

        $receiptNumber = $this->invoiceController->generateReceiptNumber();


        $invoice = Invoice::create([
            'schedule_id' => $schedule->id,
            'receipt_number' => $receiptNumber,
            'invoice_date' => $request->invoice_date,
            'amount_received' => $request->amount_received,
            'balance' => $request->balance,
            'branch' => $request->branch,
            'paid_by' => $request->paid_by,
            'amount_in_english' => $request->amount_in_english,
        ]);

        $this->emailController->sendAdmissionConfirmation($student, $schedule, $student->instructor, $student->vehicle);


        return redirect()->route('admin.allStudents')->with('success_student', 'Student added successfully.');
    }

    public function adminEditStudent($id)
    {
        $student = Student::with('user')->findOrFail($id);
        $instructors = Employee::where('designation', 'instructor')->get();
        $cars = Car::all();
        $courses = Course::all();

        return view('admin.students.edit_student', compact('student', 'instructors', 'cars', 'courses'));
    }

    public function adminUpdateStudent(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'father_or_husband_name' => 'required|string|max:255',
            'cnic' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'optional_phone' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255', // Add email validation
        ]);

        // Find student and user
        $student = Student::findOrFail($id);
        $user = $student->user;

        // Update user
        $user->update([
            'name' => $validated['name'],
        ]);

        // Update student
        $student->update([
            'father_or_husband_name' => $validated['father_or_husband_name'],
            'cnic' => $validated['cnic'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'optional_phone' => $validated['optional_phone'],
            'email' => $validated['email'] ?? null, // Add email field to the update
        ]);

        return redirect()->route('admin.allStudents')->with('success', 'Student updated successfully.');
    }


    /**
     * Remove the specified student from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function adminDestroyStudent($id)
    {
        $student = Student::findOrFail($id);

        // Delete associated user and student
        $student->user()->delete();
        $student->delete();

        return redirect()->route('admin.allStudents')->with('success_deleted_student', 'Student deleted successfully.');
    }


    public function instructorStudents()
    {

        $instructor = auth()->user()->instructor;


        $students = Student::with(['user', 'course'])
            ->where('instructor_id', $instructor->id)
            ->get();


        return response()->json([
            'students' => $students
        ]);
    }

}
