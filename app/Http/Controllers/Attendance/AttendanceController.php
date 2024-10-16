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

        // Fetch all students who are currently enrolled and have a non-null instructor_id
        $students = Student::where('admission_date', '<=', $date)->where('course_end_date', '>=', $date)->whereNotNull('instructor_id')->get();
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
        $students = Student::where('admission_date', '<=', $date)
            ->where('course_end_date', '>=', $date)
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

    // Instructor Attendance Functions (already implemented)
    public function showInstructorAttendance()
    {
        $events = [];

        $instructors = Instructor::all();

        $date = Carbon::now()->format('Y-m-d');

        // Fetch all attendance records with instructor relationships
        $attendances = Attendance::with('instructor.employee.user')->get();

        foreach ($attendances as $attendance) {
            // Check if the attendance has an instructor and if that instructor has a user
            if ($attendance->instructor && $attendance->instructor->employee && $attendance->instructor->employee->user) {
                $attendanceDate = Carbon::parse($attendance->attendance_date);

                $events[] = [
                    'title' => $attendance->instructor->employee->user->name, // Safe to access now
                    'start' => $attendanceDate->format('Y-m-d'),
                    'attendance' => $attendance->instructor_present ? 'present' : 'absent',
                    'className' => 'attendance-event', // Add this line
                    'backgroundColor' => $attendance->instructor_present ? '#28a745' : '#dc3545',
                    'textColor' => 'white',
                ];
            }
        }

        // Pass the $events array to the view
        return view('attendance.instructor.insructor_attendance', compact('events','date','instructors'));
    }

    public function markTodayAttendance($date)
    {
        $instructors = Instructor::all();

        // Pass the instructors and the selected date to the view
        return view('attendance.instructor.mark_instructor_attendance', compact('instructors', 'date'));
    }

    public function storeInstructorAttendance(Request $request)
    {
        $validated = $request->validate([
            'instructor_attendance' => 'nullable|array',
        ]);

        $currentDate = Carbon::now()->format('Y-m-d');

        if (isset($validated['instructor_attendance'])) {
            foreach ($validated['instructor_attendance'] as $instructor_id => $attendance) {
                // Use updateOrCreate to either create a new attendance record or update the existing one
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

    public function showInstructorStudentAttendance()
    {
        $events = [];
        $instructor = auth()->user()->instructor; // Fetch the logged-in instructor

        // Fetch attendance records for students associated with the instructor
        $attendances = Attendance::with('student.user')->whereHas('student', function ($query) use ($instructor) {
            $query->where('instructor_id', $instructor->id);
        })->get();

        foreach ($attendances as $attendance) {
            // Check if the attendance has a student and if that student has a user
            if ($attendance->student && $attendance->student->user) {
                $attendanceDate = Carbon::parse($attendance->attendance_date);

                $events[] = [
                    'title' => $attendance->student->user->name, // Safe to access now
                    'start' => $attendanceDate->format('Y-m-d'),
                    'attendance' => $attendance->student_present ? 'present' : 'absent',
                    'className' => 'attendance-event', // Add this line for CSS styling
                    'backgroundColor' => $attendance->student_present ? '#28a745' : '#dc3545',
                    'textColor' => 'white',
                ];
            }
        }

        // Pass the $events array to the view
        return view('attendance.instructor_student.student_attendance', compact('events'));
    }


    /**
     * Show form for marking student attendance (For the logged-in instructor's students).
     */
    public function markTodayInstructorStudentAttendance($date)
    {
        $instructor = auth()->user()->instructor; // Fetch the logged-in instructor
        $students = Student::where('instructor_id', $instructor->id)
            ->where('admission_date', '<=', $date)
            ->where('course_end_date', '>=', $date)
            ->get();

        return view('attendance.instructor_student.mark_student_attendance', compact('students', 'date'));
    }

    /**
     * Store attendance records for instructor's students.
     */
    public function storeInstructorStudentAttendance(Request $request)
    {
        $validated = $request->validate([
            'student_attendance' => 'nullable|array',
        ]);

        $currentDate = Carbon::now()->format('Y-m-d');

        if (isset($validated['student_attendance'])) {
            foreach ($validated['student_attendance'] as $student_id => $attendance) {
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

        return redirect()->route('instructor.student.attendance.show')
            ->with('success', 'Attendance marked successfully.');
    }

}
