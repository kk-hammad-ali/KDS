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
            $events[] = [
                'title' => 'S' . $schedule->student->id . ' - ' . $schedule->instructor->user->name,
                'start' => $schedule->class_date . 'T' . $schedule->start_time,
                'end' => $schedule->class_date . 'T' . $schedule->end_time, // Ensure end time is provided
                'backgroundColor' => '#ff0000', // Red for booked slots
                'textColor' => 'white',
                'extendedProps' => [
                    'course_end_date' => $schedule->student->course_end_date,
                ],
            ];
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
            $query->orWhere('vehicle_id', $vehicleId); // Added `orWhere` to also check for vehicle availability
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
        // $instructor = auth()->user(); // Assuming the user is logged in as an instructor

        // Fetch schedules for the logged-in instructor
        $schedules = Schedule::with(['student', 'instructor'])
            ->where('instructor_id', 1)
            ->get();

        $events = [];

        foreach ($schedules as $schedule) {
            $events[] = [
                'title' => 'S' . $schedule->student->id . ' - ' . $schedule->instructor->user->name,
                'start' => $schedule->class_date . 'T' . $schedule->start_time,
                'end' => $schedule->class_date . 'T' . $schedule->end_time, // Ensure end time is provided
                'backgroundColor' => '#ff0000', // Red for booked slots
                'textColor' => 'white',
                'extendedProps' => [
                    'course_end_date' => $schedule->student->course_end_date,
                ],
            ];
        }
        return view('instructor.my_schedule', compact('events'));
    }
}
