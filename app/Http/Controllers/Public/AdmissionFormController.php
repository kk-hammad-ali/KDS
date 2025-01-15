<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Schedule;
use App\Models\Course;
use App\Models\Coupon;
use App\Models\CarModel;
use App\Models\Instructor;
use App\Models\Invoice;
use App\Models\User;
use App\Models\Car;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Invoice\InvoiceController;
use App\Http\Controllers\EmailController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewAdmissionForm;
use App\Notifications\WelcomeNotification;
use App\Notifications\NewStudentAssignedNotification;


class AdmissionFormController extends Controller
{
    protected $emailController;
    protected $invoiceController;

    public function __construct(InvoiceController $invoiceController, EmailController $emailController)
    {
        $this->emailController = $emailController;
        $this->invoiceController = $invoiceController;
    }

    public function index()
    {
        $carModels = CarModel::with('courses')->get();
        return view('public.admission.admission', compact('carModels'));
    }

    public function adminAllAdmissionForm()
    {
        $students = Student::with([
            'course.carModel.cars' // Include cars for the car model
        ])->where('form_type', 'admission')->paginate(10);

        $instructors = Instructor::with('employee.user')->get();
        $courses = Course::with('carModel')->get();
        $carModels = CarModel::all();

        return view('admin.students.admission_form', compact('students', 'courses', 'carModels', 'instructors'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'pickup_sector' => 'required|string|max:50',
            'email' => 'nullable|email|max:255|unique:students,email',
            'course_id' => 'required|exists:courses,id',
        ]);

        // Retrieve the selected course details
        $course = Course::findOrFail($validated['course_id']);

        // Create user
        $user = User::create([
            'name' => $validated['name'],
            'password' => Hash::make("password"), // Default password
        ]);

        // Assign role to user as student
        $user->assignRole('student');

        // Create student entry
        $student = Student::create([
            'user_id' => $user->id,
            'address' => $validated['address'],
            'pickup_sector' => $validated['pickup_sector'],
            'phone' => $validated['phone'],
            'admission_date' => now(),
            'email' => $validated['email'] ?? null,
            'coupon_code' => null,
            'course_id' => $course->id,
            'instructor_id' => null,
            'form_type' => 'admission',
        ]);

        // Notify the admin
        $adminUser = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->first();

        if ($adminUser) {
            $adminUser->notify(new NewAdmissionForm($student));
        }

        $this->emailController->sendNewStudentNotification($student, $user);

        // Redirect back with success message
        return redirect()->route('public.admission.form')->with('success', 'Application submitted successfully.');
    }

    public function adminUpdateFormStudent(Request $request, $id)
    {
        // dd($request->all());
        // Validate the request data
        $validated = $request->validate([
            'instructor_id' => 'required|exists:instructors,id',
            'class_start_time' => 'required|date_format:H:i',
            'class_duration' => 'required|integer|min:30',
            'admission_date' => 'required|date',
            'invoice_date' => 'required|date',
            'amount_received' => 'required|numeric',
            'balance' => 'required|numeric',
            'branch_id' => 'required|exists:branches,id',
            'paid_by' => 'required|string|max:255',
            'amount_in_english' => 'required|string|max:255',
        ]);

        // Find the student by ID
        $student = Student::findOrFail($id);

        // Calculate class end time
        $class_end_time = Carbon::parse($request->class_start_time)
            ->addMinutes((int)$request->class_duration)
            ->format('H:i:s');

        // Calculate course end date based on course duration
        $course_end_date = Carbon::parse($request->admission_date)
            ->addDays((int)$student->course->duration_days)
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

        // Update student
        $student->update([
            'instructor_id' => $request->instructor_id,
            'admission_date' => $request->admission_date,
            'form_type' => 'admin',
            'branch_id' => $request->branch_id,
        ]);

        // Delete existing schedules if they need to be replaced
        Schedule::where('student_id', $student->id)->delete();

        // Create updated schedule
        $schedule = Schedule::create([
            'student_id' => $student->id,
            'instructor_id' => $request->instructor_id,
            'vehicle_id' => $request->car_id,
            'class_date' => $request->admission_date,
            'class_end_date' => $course_end_date,
            'start_time' => $request->class_start_time,
            'end_time' => $class_end_time,
        ]);

        $receiptNumber = $this->invoiceController->generateReceiptNumber();


        $invoice = Invoice::create([
            'schedule_id' => $schedule->id,
            'receipt_number' => $receiptNumber,
            'invoice_date' => $request->invoice_date,
            'paid_by' => $request->paid_by,
            'amount_in_english' => $request->amount_in_english,
            'balance' => $request->balance,
            'branch_id' => $request->branch_id,
            'amount_received' => $request->amount_received,
        ]);

        // Send admission confirmation email
        $this->emailController->sendAdmissionConfirmation($student, $schedule, $student->instructor);

        $student->user->notify(new WelcomeNotification($student));
        $instructor = Instructor::find($request->instructor_id);
        $instructor->employee->user->notify(new NewStudentAssignedNotification($student));

        // Redirect with success message
        return redirect()->route('admin.allStudents')->with('success_student', 'Student updated successfully.');
    }
}
