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
use App\Models\Branch;
use App\Models\Leave;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\Schedule\ScheduleController;
use App\Http\Controllers\Invoice\InvoiceController;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;
use App\Notifications\WelcomeNotification;
use App\Notifications\NewStudentAssignedNotification;



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

    public function index()
    {
        // Fetch student schedules (events)
        $schedulesResponse = $this->scheduleController->studentSchedules(request());
        $events = $schedulesResponse->getData()->events;

        // Fetch student and certificate availability
        $student = Student::where('user_id', Auth::id())->first();
        $certificateAvailable = $student && $student->course_end_date <= now();

        // Fetch all leaves for the logged-in student using student_id
        $leaves = Leave::where('student_id', $student ? $student->id : null)->paginate(10);

        // Pass events, student data, leave data, and certificate availability to the dashboard view
        return view('student.dashboard', compact('events', 'student', 'certificateAvailable', 'leaves'));
    }


    public function adminAllStudent()
    {
        // Ensure only admin can access this function
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $students = Student::with('user') ->where('form_type', 'admin')->paginate(10);
        return view('admin.students.all_students', compact('students'));
    }

    public function adminAddStudent()
    {
        // Ensure only admin can access this function
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $instructors = Instructor::with('employee.user')->get();
        $courses = Course::with('carModel')->get();
        $cars = Car::all();
        $branches = Branch::all();

        return view('admin.students.add_student', compact('courses', 'cars', 'instructors','branches'));
    }

    public function adminStoreStudent(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'father_or_husband_name' => 'nullable|string|max:255',
            'cnic' => 'nullable|string|max:20|unique:students,cnic',
            'address' => 'required|string|max:255',
            'pickup_sector' => 'required|string|max:50',
            'phone' => 'required|string|max:15',
            'optional_phone' => 'nullable|string|max:15',
            'admission_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:admission_date',
            'email' => 'nullable|email',
            'course_id' => 'required|exists:courses,id',
            'car_id' => 'required|exists:cars,id',
            'coupon_code' => 'nullable|string|max:50',
            'instructor_id' => 'required|exists:employees,id',
            'class_start_time' => 'required',
            'class_duration' => 'required|integer',
            'invoice_date' => 'required|date',
            'amount_received' => 'required|numeric',
            'balance' => 'required|numeric',
            'branch_id' => 'required|exists:branches,id',
            'timing_preference' => 'nullable|array',
        ]);

        // Extract timing preference
        $timingPreference = $request->timing_preference ?? [];
        $originalStartTime = Carbon::parse($request->class_start_time);
        $adjustedStartTime = clone $originalStartTime;
        $additionalMinutes = 0;

        // Adjust start time if "Before" is selected and not at the minimum time
        if (in_array('before', $timingPreference) && $originalStartTime->gt(Carbon::createFromTime(8, 0))) {
            $adjustedStartTime = $adjustedStartTime->subMinutes(30);
            $additionalMinutes += 30;
        }

        // Adjust class duration if "After" is selected and does not exceed the end time
        $adjustedClassDuration = $validated['class_duration'] + $additionalMinutes;
        $adjustedEndTime = $adjustedStartTime->copy()->addMinutes($adjustedClassDuration);

        if (in_array('after', $timingPreference) && $adjustedEndTime->lte(Carbon::createFromTime(20, 0))) {
            $adjustedClassDuration += 30; // Add 30 minutes after
            $adjustedEndTime = $adjustedEndTime->addMinutes(30);
        }

        // Finalize the formatted end time
        $class_end_time = $adjustedEndTime->format('H:i:s');

        // Fetch the course based on course_id
        $course = Course::findOrFail($request->course_id);

        // Check if end date is provided, else calculate it based on admission date and course duration
        $course_end_date = $request->has('end_date') && $request->end_date
            ? Carbon::parse($request->end_date)->format('Y-m-d') // Use the provided end date
            : Carbon::parse($request->admission_date)
                ->addDays($course->duration_days) // Add duration_days from the course
                ->format('Y-m-d');


                // dd($course_end_date);
        // Check for overlapping schedule with adjusted times
        $overlappingSchedule = Schedule::where('instructor_id', $request->instructor_id)
            ->where('vehicle_id', $request->vehicle_id)
            ->where(function ($query) use ($request, $adjustedStartTime, $class_end_time) {
                $query->where('class_date', $request->admission_date)
                    ->whereTime('start_time', '<', $class_end_time)
                    ->whereTime('end_time', '>', $adjustedStartTime->format('H:i:s'));
            })->exists();

        if ($overlappingSchedule) {
            return redirect()->back()->withErrors(['error' => 'The selected time slot or car is already booked.'])->withInput();
        }

        // Create user
        $user = User::create([
            'name' => $validated['name'],
            'password' => Hash::make($validated['phone']),
        ]);

        $user->assignRole('student');

        // Updated student creation logic within the method
        $student = Student::create([
            'user_id' => $user->id,
            'father_or_husband_name' => $validated['father_or_husband_name'],
            'cnic' => $validated['cnic'],
            'address' => $validated['address'],
            'pickup_sector' => $validated['pickup_sector'],
            'phone' => $validated['phone'],
            'optional_phone' => $validated['optional_phone'],
            'admission_date' => $validated['admission_date'],
            'email' => $validated['email'] ?? null,
            'coupon_code' => $validated['coupon_code'],
            'course_id' => $validated['course_id'],
            'instructor_id' => $request->instructor_id,
            'form_type' => 'admin',
            'branch_id' => $validated['branch_id'],
            'timing_preference' => $timingPreference ? implode(', ', $timingPreference) : null,
        ]);

        // Notify user and instructor
        $user->notify(new WelcomeNotification($user));
        $instructor = Instructor::find($request->instructor_id);
        $instructor->employee->user->notify(new NewStudentAssignedNotification($student));

        // Create schedule with adjusted times
        $schedule = Schedule::create([
            'student_id' => $student->id,
            'instructor_id' => $request->instructor_id,
            'vehicle_id' =>  $validated['car_id'],
            'class_date' => $request->admission_date,
            'class_end_date' => $course_end_date,
            'start_time' => $adjustedStartTime->format('H:i:s'),
            'end_time' => $class_end_time,
        ]);

        // Generate receipt number and create invoice
        $receiptNumber = $this->invoiceController->generateReceiptNumber();
        $invoice = Invoice::create([
            'schedule_id' => $schedule->id,
            'receipt_number' => $receiptNumber,
            'invoice_date' => $request->invoice_date,
            'amount_received' => $request->amount_received,
            'balance' => $request->balance,
            'branch_id' => $validated['branch_id'],
            'paid_by' =>  $validated['name'],
        ]);

        // Send admission confirmation email
        $this->emailController->sendAdmissionConfirmation($student, $schedule, $student->instructor, $student->vehicle);

        return redirect()->route('admin.allStudents')->with('success_student', 'Student added successfully.');
    }

    public function adminEditStudent($id)
    {
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $student = Student::with(['user', 'instructor.employee.user', 'schedules'])->findOrFail($id);
        $instructors = Instructor::with('employee.user')->get();
        $courses = Course::with('carModel')->get();
        $cars = Car::all();
        $branches = Branch::all();

        // Check if the student has a schedule and if class_end_date exists
        $class_end_date = $student->schedules->first()->class_end_date ?? null;

        return view('admin.students.edit_student', compact('student', 'instructors', 'cars', 'courses', 'class_end_date'));
    }

    public function adminUpdateStudent(Request $request, $id)
    {
        // dd($request->all());
        // Validate incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'father_or_husband_name' => 'nullable|string|max:255',
            'cnic' => 'nullable|string|max:20',
            'address' => 'required|string|max:255',
            'pickup_sector' => 'required|string|max:50',
            'phone' => 'required|string|max:15',
            'optional_phone' => 'nullable|string|max:15',
            'admission_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:admission_date',
            'email' => 'nullable|email',
            'course_id' => 'required|exists:courses,id',
            'car_id' => 'required|exists:cars,id',
            'coupon_code' => 'nullable|string|max:50',
            'instructor_id' => 'required|exists:employees,id',
            'class_start_time' => 'required',
            'class_duration' => 'required|integer',
            'invoice_date' => 'required|date',
            'amount_received' => 'required|numeric',
            'balance' => 'required|numeric',
            'branch_id' => 'required|exists:branches,id',
            'timing_preference' => 'nullable|array',
        ]);

        // Get student and related user record
        $student = Student::findOrFail($id);
        $user = $student->user;

        // Extract timing preference
        $newTimingPreference = $request->timing_preference ?? [];
        $previousTimingPreference = explode(', ', $student->timing_preference ?? '');
        $originalStartTime = Carbon::parse($request->class_start_time);
        $adjustedStartTime = clone $originalStartTime;
        $adjustedClassDuration = $validated['class_duration'];

        // Check if "before" was added or removed and adjust time accordingly
        if (in_array('before', $newTimingPreference) && !in_array('before', $previousTimingPreference)) {
            $adjustedStartTime = $adjustedStartTime->subMinutes(30);
            $adjustedClassDuration += 30;
        } elseif (!in_array('before', $newTimingPreference) && in_array('before', $previousTimingPreference)) {
            $adjustedStartTime = $adjustedStartTime->addMinutes(30);
            $adjustedClassDuration -= 30;
        }

        // Check if "after" was added or removed and adjust duration accordingly
        $adjustedEndTime = $adjustedStartTime->copy()->addMinutes($adjustedClassDuration);
        if (in_array('after', $newTimingPreference) && !in_array('after', $previousTimingPreference)) {
            $adjustedClassDuration += 30;
            $adjustedEndTime = $adjustedEndTime->addMinutes(30);
        } elseif (!in_array('after', $newTimingPreference) && in_array('after', $previousTimingPreference)) {
            $adjustedClassDuration -= 30;
            $adjustedEndTime = $adjustedEndTime->subMinutes(30);
        }

        $class_end_time = $adjustedEndTime->format('H:i:s');


        // Fetch the course based on course_id
        $course = Course::findOrFail($request->course_id);

        // Check if end date is provided, else calculate it based on admission date and course duration
        $course_end_date = $request->has('end_date') && $request->end_date
            ? Carbon::parse($request->end_date)->format('Y-m-d') // Use the provided end date
            : Carbon::parse($request->admission_date)
                ->addDays($course->duration_days) // Add duration_days from the course
                ->format('Y-m-d');


        // Check for overlapping schedule with adjusted times
        $overlappingSchedule = Schedule::where('instructor_id', $request->instructor_id)
            ->where('vehicle_id', $request->car_id)
            ->where(function ($query) use ($request, $adjustedStartTime, $class_end_time) {
                $query->where('class_date', $request->admission_date)
                    ->whereTime('start_time', '<', $class_end_time)
                    ->whereTime('end_time', '>', $adjustedStartTime->format('H:i:s'));
            })->exists();

        if ($overlappingSchedule) {
            return redirect()->back()->withErrors(['error' => 'The selected time slot or car is already booked.'])->withInput();
        }

        // Update user and student details
        $user->update(['name' => $validated['name']]);

        $schedule = $student->schedules()->first();

        if ($schedule && $schedule->status === 'paused') {
            // Update the schedule status to 'active'
            $schedule->update(['status' => 'active']);
        }

        // Update student details
        $student->update([
            'father_or_husband_name' => $validated['father_or_husband_name'],
            'cnic' => $validated['cnic'],
            'address' => $validated['address'],
            'pickup_sector' => $validated['pickup_sector'],
            'phone' => $validated['phone'],
            'optional_phone' => $validated['optional_phone'],
            'admission_date' => $validated['admission_date'],
            'email' => $validated['email'] ?? null,
            'coupon_code' => $validated['coupon_code'],
            'course_id' => $validated['course_id'],
            'instructor_id' => $request->instructor_id,
            'class_start_time' => $adjustedStartTime->format('H:i:s'),
            'class_end_time' => $class_end_time,
            'course_end_date' => $course_end_date,
            'class_duration' => $adjustedClassDuration,
            'form_type' => 'admin',
            'branch_id' => $validated['branch_id'],
            'timing_preference' => implode(', ', $newTimingPreference),
        ]);

        // Update schedule
        $schedule = Schedule::updateOrCreate(
            ['student_id' => $student->id],
            [
                'instructor_id' => $request->instructor_id,
                'vehicle_id' => $request->car_id,
                'class_date' => $request->admission_date,
                'class_end_date' => $course_end_date,
                'start_time' => $adjustedStartTime->format('H:i:s'),
                'end_time' => $class_end_time,
            ]
        );

        // Update invoice details
        Invoice::updateOrCreate(
            ['schedule_id' => $schedule->id],
            [
                'invoice_date' => $request->invoice_date,
                'amount_received' => $request->amount_received,
                'balance' => $request->balance,
                'branch' => $request->branch,
                'paid_by' =>  $validated['name'],
            ]
        );

        return redirect()->route('admin.allStudents')->with('success', 'Student updated successfully.');
    }


    public function adminDestroyStudent($id)
    {
        // Ensure only admin can access this function
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $student = Student::findOrFail($id);

        // Delete related records
        $student->schedules()->delete();
        $student->attendances()->delete();
        $student->user()->delete();
        $student->delete();

        return redirect()->route('admin.allStudents')->with('success_deleted_student', 'Student deleted successfully.');
    }

    public function instructorStudents()
    {
        // Ensure only instructor can access this function
        if (!Auth::user()->hasRole('instructor')) {
            abort(403, 'Unauthorized action.');
        }

        $instructor = auth()->user()->instructor;

        // Fetch students with relationships to course and car model
        $students = Student::with(['user'   ,'course.carModel'])
            ->where('instructor_id', $instructor->id)
            ->get();

        return response()->json([
            'students' => $students
        ]);
    }


    public function getTomorrowAdmissionsData()
    {
        // Get tomorrow's date
        $tomorrow = Carbon::tomorrow();

        // Fetch students whose first class is tomorrow
        $tomorrowAdmissions = Student::with(['user', 'schedules' => function ($query) use ($tomorrow) {
                // Get the earliest class for each student and check if it is tomorrow
                $query->whereDate('class_date', $tomorrow) // Check if class date is tomorrow
                      ->whereHas('instructor')  // Ensure schedule has an instructor
                      ->whereHas('vehicle');    // Ensure schedule has a vehicle
            }, 'schedules.instructor.employee.user', 'schedules.vehicle'])
            ->whereHas('schedules', function ($query) use ($tomorrow) {
                // Check if the first class is tomorrow by ordering by class_date and filtering
                $query->whereDate('class_date', $tomorrow)
                      ->orderBy('class_date', 'asc') // Ensure we are getting the first class
                      ->limit(1); // We are only interested in the first class
            })
            ->get();

        return $tomorrowAdmissions;
    }

    public function getTodayCreatedStudents()
    {
        // Get today's date
        $today = Carbon::today();

        // Fetch students created today with associated user and invoice details
        $todayCreatedStudents = Student::with('user', 'invoice') // Eager load 'user' and 'invoice'
            ->whereDate('created_at', $today)
            ->get();

        return $todayCreatedStudents;
    }


}
