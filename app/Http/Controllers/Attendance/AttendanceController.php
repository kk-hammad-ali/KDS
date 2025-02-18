<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Instructor;
use App\Models\Schedule;
use Carbon\Carbon;


class AttendanceController extends Controller
{
    /**
     * Display attendance records for a specific date.
     */

    /**
     * Show form to mark attendance for students and instructors.
     */

    /**
     * Store student attendance records.
     */
    public function showStudentAttendance()
    {
        $date = Carbon::now()->format('Y-m-d');

        // Fetch all students who are currently enrolled and have a non-null instructor_id,
        // using the schedules table to check if the class_end_date is >= the current date
        $students = Student::whereHas('schedules', function($query) use ($date) {
            $query->where('class_end_date', '>=', $date);
        })->where('admission_date', '<=', $date)
        ->whereNotNull('instructor_id')
        ->get();

        $instructors = Instructor::all();
        $events = [];

        // Fetch all attendance records with student relationships
        $attendances = Attendance::with('student.user')->get();

        foreach ($attendances as $attendance) {
            // Check if the attendance has a student and if that student has a user
            if ($attendance->student && $attendance->student->user) {
                $attendanceDate = Carbon::parse($attendance->attendance_date);

                $events[] = [
                    'title' => $attendance->student->user->name, // Safe to access now
                    'start' => $attendanceDate->format('Y-m-d'),
                    'attendance' => $attendance->student_present ? 'present' : 'absent',
                    'className' => 'attendance-event', // Add this line
                    'backgroundColor' => $attendance->student_present ? '#28a745' : '#dc3545',
                    'textColor' => 'white',
                ];
            }
        }

        // Pass the $events array to the view
        return view('attendance.student.student_attendance', compact('events','students', 'instructors','date'));
    }



    public function markTodayStudentAttendance($date)
    {
        // Get students based on their schedule's course end date
        $students = Student::whereHas('schedules', function($query) use ($date) {
            $query->where('class_end_date', '>=', $date);
        })->where('admission_date', '<=', $date)
        ->get();

        return view('attendance.student.mark_student_attendance', compact('students', 'date'));
    }


    public function storeStudentAttendance(Request $request)
    {
        $validated = $request->validate([
            'student_attendance' => 'nullable|array',
        ]);

        $currentDate = Carbon::now()->format('Y-m-d');

        if (isset($validated['student_attendance'])) {
            foreach ($validated['student_attendance'] as $student_id => $attendance) {
                // Use updateOrCreate to either create a new attendance record or update the existing one
                Attendance::updateOrCreate(
                    [
                        'student_id' => $student_id,
                        'attendance_date' => $currentDate,
                    ],
                    [
                        'student_present' => $attendance[$currentDate] ? 1 : 0,
                    ]
                );
            }
        }

        return redirect()->route('student.attendance.show')->with('success', 'Student attendance marked successfully.');
    }


    public function showAndUpdateStudentAttendance(Request $request)
    {
        // Ensure the selected date is passed correctly
        $selectedDate = $request->query('date'); // Get the date passed from the form

        if (!$selectedDate) {
            return redirect()->route('admin.dashboard'); // Handle case where no date is selected
        }

        // Fetch students enrolled between admission date and class end date
        $students = Student::whereHas('schedules', function ($query) use ($selectedDate) {
            $query->whereDate('class_date', '<=', $selectedDate)
                  ->whereDate('class_end_date', '>=', $selectedDate);
        })->get();

        $attendanceRecords = [];

        // Get attendance data for students
        foreach ($students as $student) {
            $attendance = Attendance::where('student_id', $student->id)
                                    ->where('attendance_date', $selectedDate)
                                    ->first();

            $attendanceRecords[] = [
                'student' => $student,
                'attendance' => $attendance,
            ];
        }

        // Return the view with selected date and attendance records
        return view('attendance.student.update_student_attendance', compact('attendanceRecords', 'selectedDate'));
    }



    public function storeUpdatedStudentAttendance(Request $request)
    {
        $validated = $request->validate([
            'attendance_update' => 'nullable|array',
            'date' => 'required|date', // Validate the date field
        ]);

        $selectedDate = $validated['date']; // Get the date from the form

        if (isset($validated['attendance_update'])) {
            foreach ($validated['attendance_update'] as $student_id => $attendance) {
                // Update the attendance record for the student
                Attendance::updateOrCreate(
                    [
                        'student_id' => $student_id,
                        'attendance_date' => $selectedDate,
                    ],
                    [
                        'student_present' => $attendance['present'] ? 1 : 0,
                    ]
                );
            }
        }

        return redirect()->route('student.attendance.show', ['date' => $selectedDate])
            ->with('success', 'Attendance updated successfully.');
    }


    // Instructor Attendance Functions

// Show the attendance records for instructors
public function showInstructorAttendance()
{
    $date = Carbon::now()->format('Y-m-d');
    $instructors = Instructor::all();
    $events = [];

    // Fetch all attendance records with instructor relationships
    $attendances = Attendance::with('instructor.employee.user')->get();

    foreach ($attendances as $attendance) {
        if ($attendance->instructor && $attendance->instructor->employee && $attendance->instructor->employee->user) {
            $attendanceDate = Carbon::parse($attendance->attendance_date);

            $events[] = [
                'title' => $attendance->instructor->employee->user->name,
                'start' => $attendanceDate->format('Y-m-d'),
                'attendance' => $attendance->instructor_present ? 'present' : 'absent',
                'className' => 'attendance-event',
                'backgroundColor' => $attendance->instructor_present ? '#28a745' : '#dc3545',
                'textColor' => 'white',
            ];
        }
    }

    return view('attendance.instructor.insructor_attendance', compact('events', 'date', 'instructors'));
}

    // Mark today's attendance for instructors
    public function markTodayInstructorAttendance($date)
    {
        $instructors = Instructor::all();

        return view('attendance.instructor.mark_instructor_attendance', compact('instructors', 'date'));
    }

    // Store instructor attendance records
    public function storeInstructorAttendance(Request $request)
    {
        $validated = $request->validate([
            'instructor_attendance' => 'nullable|array',
        ]);

        $currentDate = Carbon::now()->format('Y-m-d');

        if (isset($validated['instructor_attendance'])) {
            foreach ($validated['instructor_attendance'] as $instructor_id => $attendance) {
                // Use updateOrCreate to create or update attendance records
                Attendance::updateOrCreate(
                    [
                        'instructor_id' => $instructor_id,
                        'attendance_date' => $currentDate,
                    ],
                    [
                        'instructor_present' => $attendance[$currentDate] ? 1 : 0,
                    ]
                );
            }
        }

        return redirect()->route('instructor.attendance.show')->with('success', 'Instructor attendance marked successfully.');
    }

    // Show and update instructor attendance for a specific date
    public function showAndUpdateInstructorAttendance(Request $request)
    {
        $selectedDate = $request->query('date'); // Get the date from the query string

        if (!$selectedDate) {
            return redirect()->route('admin.dashboard'); // Handle case where no date is selected
        }

        $instructors = Instructor::all();
        $attendanceRecords = [];

        foreach ($instructors as $instructor) {
            // Check if attendance exists for the instructor on the given date
            $attendance = Attendance::where('instructor_id', $instructor->id)
                ->where('attendance_date', $selectedDate)
                ->first();

            $attendanceRecords[] = [
                'instructor' => $instructor,
                'attendance' => $attendance,
            ];
        }

        return view('attendance.instructor.update_instructor_attendance', compact('attendanceRecords', 'selectedDate'));
    }

    // Store updated instructor attendance
    public function storeUpdatedInstructorAttendance(Request $request)
    {
        $validated = $request->validate([
            'attendance_update' => 'nullable|array',
            'date' => 'required|date', // Validate the date field
        ]);

        $selectedDate = $validated['date']; // Get the date from the form

        if (isset($validated['attendance_update'])) {
            foreach ($validated['attendance_update'] as $instructor_id => $attendance) {
                Attendance::updateOrCreate(
                    [
                        'instructor_id' => $instructor_id,
                        'attendance_date' => $selectedDate,
                    ],
                    [
                        'instructor_present' => $attendance['present'] ? 1 : 0,
                    ]
                );
            }
        }

        return redirect()->route('instructor.attendance.show', ['date' => $selectedDate])
            ->with('success', 'Instructor attendance updated successfully.');
    }

    public function storeBulkAttendance(Request $request)
    {
        $validated = $request->validate([
            'students' => 'required|array', // Ensure at least one student is selected
            'attendance_start_date' => 'required|date',
            'attendance_end_date' => 'required|date|after_or_equal:attendance_start_date', // Ensure the end date is after or equal to the start date
            'attendance_status' => 'required|boolean',
        ]);

        // Get the selected attendance status and date range
        $attendanceStatus = $validated['attendance_status'];
        $startDate = Carbon::parse($validated['attendance_start_date']);
        $endDate = Carbon::parse($validated['attendance_end_date']);

        // Loop through each date in the selected range
        $dates = [];
        while ($startDate <= $endDate) {
            $dates[] = $startDate->format('Y-m-d');
            $startDate->addDay(); // Increment the date by 1 day
        }

        // Loop through each selected date and student
        foreach ($validated['students'] as $studentId) {
            foreach ($dates as $date) {
                // Mark attendance for the student on the selected date
                Attendance::updateOrCreate(
                    [
                        'student_id' => $studentId,
                        'attendance_date' => $date,
                    ],
                    [
                        'student_present' => $attendanceStatus,
                    ]
                );
            }
        }

        return redirect()->route('student.attendance.show')->with('success', 'Attendance marked successfully.');
    }

    public function showBulkAttendanceForm()
    {
        $date = Carbon::now()->format('Y-m-d'); // Today's date

        // Fetch all students that are eligible for attendance (you can adjust the query based on your needs)
        $students = Student::whereHas('schedules', function($query) use ($date) {
            $query->where('class_end_date', '>=', $date); // Ensure the student's schedule ends after today
        })->get();

        // Return the view with the list of students and today's date
        return view('attendance.student.bulk_mark_attendance', compact('students', 'date'));
    }



}


