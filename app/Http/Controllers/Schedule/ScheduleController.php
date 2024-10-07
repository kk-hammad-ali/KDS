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
        $schedules = Schedule::with(['student', 'instructor'])->paginate(10);
        $events = [];

        foreach ($schedules as $schedule) {
            $startDate = Carbon::parse($schedule->class_date);
            $endDate = Carbon::parse($schedule->class_end_date);

            // Create events for each day between start and end date
            for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                $events[] = [
                    'title' => 'S1 - ' . $schedule->instructor->employee->user->name,
                    'start' => $date->format('Y-m-d') . 'T' . $schedule->start_time,
                    'end' => $date->format('Y-m-d') . 'T' . $schedule->end_time,
                    'backgroundColor' => '#ff0000',  // Red for booked slots
                    'textColor' => 'white',
                ];
            }
        }

        // Pass both $events and $schedules to the view
        return view('admin.schedules.all_schedules', compact('events', 'schedules'));
    }

    public function getBookedTimes(Request $request)
    {
        $date = $request->get('date');
        $instructorId = $request->get('instructor');
        $vehicleId = $request->get('vehicle');


        $query = Schedule::query();


        if ($instructorId || $vehicleId) {
            if ($instructorId) {
                $query->where('instructor_id', $instructorId);
            }

            if ($vehicleId) {
                $query->where('vehicle_id', $vehicleId);
            }


            $query->where(function ($query) use ($date) {

                $query->where('class_date', '<=', $date)
                    ->where('class_end_date', '>=', $date);
            });


            $bookedSchedules = $query->get(['start_time', 'end_time']);


            $bookedTimes = $bookedSchedules->map(function ($schedule) {
                $start = \Carbon\Carbon::parse($schedule->start_time);
                $end = \Carbon\Carbon::parse($schedule->end_time);


                $times = [];
                while ($start < $end) {
                    $times[] = $start->format('H:i');
                    $start->addMinutes(30);
                }
                return $times;
            })->flatten();

            return response()->json(['booked_times' => $bookedTimes]);
        }

        return response()->json(['booked_times' => []]);
    }

    public function instructorSchedules(Request $request)
    {
        // Get the logged-in instructor
        $instructor = auth()->user()->instructor;

        $events = [];

        // Fetch schedules for the logged-in instructor
        $schedules = Schedule::with(['student', 'instructor.employee.user'])
            ->where('instructor_id', $instructor->id)
            ->get();

        // Generate events similar to student schedules
        foreach ($schedules as $schedule) {
            $startDate = Carbon::parse($schedule->class_date);
            $endDate = Carbon::parse($schedule->student->course_end_date);

            // Create events for each day between class start date and course end date
            for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                $events[] = [
                    'title' => 'Class with ' . $schedule->student->user->name,
                    'start' => $date->format('Y-m-d') . 'T' . $schedule->start_time,
                    'end' => $date->format('Y-m-d') . 'T' . $schedule->end_time,
                    'backgroundColor' => '#ff0000',  // Red for instructor classes
                    'textColor' => 'white',
                ];
            }
        }

        // Return the events for the logged-in instructor
        return response()->json([
            'events' => $events
        ]);
    }

    // public function studentSchedules(Request $request)
    // {
    //     // Get the logged-in student's record
    //     $student = auth()->user()->student;

    //     // Fetch schedules for the logged-in student, eager load instructor and employee
    //     $schedules = Schedule::with(['instructor.employee.user']) // Eager load related models
    //         ->where('student_id', $student->id)
    //         ->get();

    //     return response()->json([
    //         'schedules' => $schedules
    //     ]);
    // }


    public function studentSchedules(Request $request)
    {
        $student = auth()->user()->student;

        $events = [];

        // Fetch schedules for the logged-in student
        $schedules = Schedule::with(['instructor.employee.user'])
            ->where('student_id', $student->id)
            ->get();

        // Generate events similar to `allSchedules`
        foreach ($schedules as $schedule) {
            $startDate = Carbon::parse($schedule->class_date);
            $endDate = Carbon::parse($schedule->class_end_date);

            for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                $events[] = [
                    'title' => 'Class with ' . $schedule->instructor->employee->user->name,
                    'start' => $date->format('Y-m-d') . 'T' . $schedule->start_time,
                    'end' => $date->format('Y-m-d') . 'T' . $schedule->end_time,
                    'backgroundColor' => '#28a745',  // Green for student classes
                    'textColor' => 'white',
                ];
            }
        }

        // Return events for the logged-in student
        return response()->json([
            'events' => $events
        ]);
    }


}
