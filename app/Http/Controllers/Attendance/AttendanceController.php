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

    public function markAttendanceForm()
    {
        $students = Student::all();
        $instructors = Instructor::all();

        return view('attendance.mark', compact('students', 'instructors'));
    }

    /**
     * Store student attendance records.
     */
    public function showStudentAttendance()
    {
        $attendanceEvents = Attendance::whereHas('student') // Only student attendance
            ->get()
            ->map(function($attendance) {
                return [
                    'title' => $attendance->student->user->name,
                    'start' => $attendance->attendance_date, // Date of attendance
                    'attendance' => $attendance->student_present ? 'present' : 'absent', // Determine status
                ];
            });

        return view('attendance.student.student_attendance', compact('attendanceEvents'));
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
        $attendanceEvents = Attendance::whereHas('instructor') // Only instructor attendance
            ->get()
            ->map(function($attendance) {
                return [
                    'title' => $attendance->instructor->employee->user->name,
                    'start' => $attendance->attendance_date, // Date of attendance
                    'attendance' => $attendance->instructor_present ? 'present' : 'absent', // Determine status
                ];
            });

        return view('attendance.instructor.insructor_attendance', compact('attendanceEvents'));
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

}
