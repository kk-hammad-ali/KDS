<?php

namespace App\Http\Controllers\Schedule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Instructor;
use Carbon\Carbon;

class ScheduleController extends Controller
{

    public function allSchedules(Request $request)
    {
        $schedules = Schedule::with(['student', 'instructor'])->get();
        $events = [];

        foreach ($schedules as $schedule) {
            $startDate = Carbon::parse($schedule->class_date);
            $endDate = Carbon::parse($schedule->class_end_date);

            // Create events for each day between start and end date
            for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                $events[] = [
                    'title' => 'S' . $schedule->student->id . ' - ' . $schedule->instructor->employee->user->name,
                    'start' => $date->format('Y-m-d') . 'T' . $schedule->start_time,
                    'end' => $date->format('Y-m-d') . 'T' . $schedule->end_time,
                    'backgroundColor' => '#ff0000', // Red for booked slots
                    'textColor' => 'white',
                    'extendedProps' => [
                        'course_end_date' => $schedule->student->course_end_date,
                    ],
                ];
            }
        }

        return view('admin.schedules.all_schedules', compact('events'));
    }


    public function getBookedTimes(Request $request)
    {
        $date = $request->get('date');
        $instructorId = $request->get('instructor');
        $vehicleId = $request->get('vehicle'); // Adjusted to match the request variable name

        // Query to check for booked slots for either the instructor or the vehicle
        $query = Schedule::query();

        if ($date) {
            $query->where('class_date', $date);
        }

        if ($instructorId) {
            $query->where('instructor_id', $instructorId);
        }

        if ($vehicleId) {
            $query->where('vehicle_id', $vehicleId);
        }

        // Fetch both start_time and end_time
        $bookedSchedules = $query->get(['start_time', 'end_time']);

        // Map the start and end times into an array of time ranges
        $bookedTimes = $bookedSchedules->map(function ($schedule) {
            $start = \Carbon\Carbon::parse($schedule->start_time);
            $end = \Carbon\Carbon::parse($schedule->end_time);

            // Create an array of 30-minute slots between start_time and end_time
            $times = [];
            while ($start < $end) {
                $times[] = $start->format('H:i');
                $start->addMinutes(30); // Increment by 30-minute intervals
            }
            return $times;
        })->flatten(); // Flatten into a single array of time slots

        return response()->json(['booked_times' => $bookedTimes]);
    }

    public function instructorSchedules(Request $request)
    {
        // Get the logged-in instructor
        $instructor = auth()->user()->instructor;

        // Fetch schedules for the logged-in instructor
        $schedules = Schedule::with(['student', 'instructor'])
            ->where('instructor_id', $instructor->id)
            ->get();

        $events = [];

        foreach ($schedules as $schedule) {
            // Loop through each day from class start date to course end date
            $startDate = \Carbon\Carbon::parse($schedule->class_date);
            $endDate = \Carbon\Carbon::parse($schedule->student->course_end_date);

            // Loop through each day between start and end date and add event for each day
            while ($startDate <= $endDate) {
                $events[] = [
                    'title' => 'S' . $schedule->student->id . ' - ' . $schedule->instructor->employee->name,
                    'start' => $startDate->format('Y-m-d') . 'T' . $schedule->start_time,
                    'end' => $startDate->format('Y-m-d') . 'T' . $schedule->end_time,
                    'backgroundColor' => '#ff0000', // Red for booked slots
                    'textColor' => 'white',
                    'extendedProps' => [
                        'course_end_date' => $schedule->student->course_end_date,
                    ],
                ];

                // Move to the next day
                $startDate->addDay();
            }
        }

        // Return the view with events for the FullCalendar
        return view('instructor.my_schedule', compact('events'));
    }


    public function studentSchedules(Request $request)
    {
        // Get the logged-in student's record
        $student = auth()->user()->student;

        // Fetch schedules for the logged-in student
        $schedules = Schedule::with(['student', 'instructor'])
            ->where('student_id', $student->id)
            ->get();

        $events = [];

        foreach ($schedules as $schedule) {
            // Loop through each day from class start date to course end date
            $startDate = \Carbon\Carbon::parse($schedule->class_date);
            $endDate = \Carbon\Carbon::parse($schedule->student->course_end_date);

            // Loop through each day between start and end date and add event for each day
            while ($startDate <= $endDate) {
                $events[] = [
                    'title' => 'S' . $schedule->student->id . ' - ' . $schedule->instructor->employee->name,
                    'start' => $startDate->format('Y-m-d') . 'T' . $schedule->start_time,
                    'end' => $startDate->format('Y-m-d') . 'T' . $schedule->end_time,
                    'backgroundColor' => '#ff0000', // Red for booked slots
                    'textColor' => 'white',
                    'extendedProps' => [
                        'course_end_date' => $schedule->student->course_end_date,
                    ],
                ];

                // Move to the next day
                $startDate->addDay();
            }
        }

        // Return the view with events for the FullCalendar
        return view('student.my_schedule', compact('events'));
    }
}
