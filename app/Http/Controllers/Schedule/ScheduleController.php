<?php

namespace App\Http\Controllers\Schedule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Instructor;
use Carbon\Carbon;
use App\Models\Car;

class ScheduleController extends Controller
{

    public function allSchedules()
    {
        $schedules = Schedule::with(['student', 'instructor', 'vehicle'])->paginate(10);
        $events = [];

        $carSchedules = $this->getAllCarSchedules();

        foreach ($schedules as $schedule) {
            // Ensure class_date and class_end_date are parsed correctly
            $startDate = Carbon::parse($schedule->class_date);
            $endDate = Carbon::parse($schedule->class_end_date);

            // Create events for each day between start and end date
            for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                $events[] = [
                    'title' => $schedule->student->user->name . ' - ' . $schedule->instructor->employee->user->name .
                            ' (' . \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') . ' to ' .
                            \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') . ')',
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

        return view('admin.schedules.all_schedules',[
            'carSchedules' => $carSchedules['schedules'],
            'today' => $carSchedules['today'],
            'events' => $events,
        ]);
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
            // Ensure class_date and class_end_date are parsed correctly
            $startDate = Carbon::parse($schedule->class_date);
            $endDate = Carbon::parse($schedule->student->course_end_date); // Assuming course_end_date is relevant here

            // Create events for each day between class start date and course end date
            for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                $events[] = [
                    'title' => 'Class with ' . $schedule->student->user->name . ' (' . \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') . ' to ' . \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') . ')',
                    'start' => $date->format('Y-m-d') . 'T' . $schedule->start_time,
                    'end' => $date->format('Y-m-d') . 'T' . $schedule->end_time,
                    'backgroundColor' => '#ff0000', // Red for instructor classes
                    'textColor' => 'white',
                    'extendedProps' => [
                        'course_end_date' => $schedule->student->course_end_date,
                    ],
                ];
            }
        }

        // Return the events for the logged-in instructor
        return response()->json([
            'events' => $events
        ]);
    }

    public function studentSchedules(Request $request)
    {
        // Get the logged-in student
        $student = auth()->user()->student;

        $events = [];

        // Fetch schedules for the logged-in student
        $schedules = Schedule::with(['instructor.employee.user'])
            ->where('student_id', $student->id)
            ->get();

        // Generate events similar to `allSchedules`
        foreach ($schedules as $schedule) {
            // Ensure class_date and class_end_date are parsed correctly
            $startDate = Carbon::parse($schedule->class_date);
            $endDate = Carbon::parse($schedule->class_end_date);

            for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                $events[] = [
                    'title' => 'Class with ' . $schedule->instructor->employee->user->name . ' (' . \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') . ' to ' . \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') . ')',
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

    public function getAllCarSchedules()
    {
       // Fetch all cars
       $cars = Car::all();

       // Initialize an array to hold car schedules
       $carSchedules = [];

       // Get today's date
       $today = Carbon::today();

       // Loop through each car
       foreach ($cars as $car) {
           // Fetch schedules with related student and instructor models for today
           $schedules = Schedule::with(['student.user', 'instructor.employee.user'])
               ->where('vehicle_id', $car->id)
               ->where('class_date', '<=', $today) // Class starts before or on today
               ->where('class_end_date', '>=', $today) // Class ends after or on today
               ->get(['start_time', 'end_time', 'student_id', 'instructor_id', 'class_date', 'class_end_date']);

           // Create time slots from 8 AM to 8 PM (30 minutes each)
           $timeSlots = [];
           $startTime = Carbon::createFromTime(8, 0); // 8:00 AM
           $endTime = Carbon::createFromTime(20, 0); // 8:00 PM

           while ($startTime < $endTime) {
               $timeSlot = [
                   'time' => $startTime->format('H:i'),
                   'status' => 'available', // Default status is 'available'
                   'student_name' => null,
                   'instructor_name' => null,
                   'class_date' => null,
                   'end_date' => null,
                   'address' => null, // Initialize address
               ];

               // Check if this time slot is booked
               foreach ($schedules as $schedule) {
                   $scheduleStart = Carbon::parse($schedule->start_time);
                   $scheduleEnd = Carbon::parse($schedule->end_time);
                   $classStartDate = Carbon::parse($schedule->class_date);
                   $classEndDate = Carbon::parse($schedule->class_end_date);

                   // Check if the current time slot falls within the schedule period
                   if ($startTime >= $scheduleStart && $startTime < $scheduleEnd &&
                       Carbon::now()->between($classStartDate, $classEndDate)) {
                       $timeSlot['status'] = 'booked';
                       $timeSlot['student_name'] = $schedule->student->user->name; // Fetch student name
                       $timeSlot['instructor_name'] = $schedule->instructor->employee->user->name; // Fetch instructor name
                       $timeSlot['class_date'] = $classStartDate->format('Y-m-d'); // Class start date
                       $timeSlot['end_date'] = $classEndDate->format('Y-m-d'); // Class end date
                       $timeSlot['address'] = $schedule->student->address; // Fetch pickup address
                       break;
                   }
               }

               $timeSlots[] = $timeSlot;
               $startTime->addMinutes(30); // Move to the next 30-minute interval
           }

           // Add car schedule to the array
           $carSchedules[] = [
               'car' => $car->make . ' - ' . $car->model . ' - ' . $car->registration_number,
               'timeSlots' => $timeSlots,
           ];
       }

       // Return the car schedules and today's date
       return [
           'schedules' => $carSchedules,
           'today' => $today->format('l, F j, Y'), // Format today's date for display
       ];
   }

   public function getAllInstructorSchedules()
    {
        // Fetch all instructors
        $instructors = Instructor::all();

        // Initialize an array to hold instructor schedules
        $instructorSchedules = [];

        // Get today's date
        $today = Carbon::today();

        // Loop through each instructor
        foreach ($instructors as $instructor) {
            // Fetch schedules with related student and vehicle models for today
            $schedules = Schedule::with(['student.user', 'vehicle'])
                ->where('instructor_id', $instructor->id)
                ->where('class_date', '<=', $today) // Class starts before or on today
                ->where('class_end_date', '>=', $today) // Class ends after or on today
                ->get(['start_time', 'end_time', 'student_id', 'class_date', 'class_end_date', 'vehicle_id']);

            // Create time slots from 8 AM to 8 PM (30 minutes each)
            $timeSlots = [];
            $startTime = Carbon::createFromTime(8, 0); // 8:00 AM
            $endTime = Carbon::createFromTime(20, 0); // 8:00 PM

            while ($startTime < $endTime) {
                $timeSlot = [
                    'time' => $startTime->format('H:i'),
                    'status' => 'available', // Default status is 'available'
                    'student_name' => null,
                    'class_date' => null,
                    'end_date' => null,
                    'vehicle_details' => null, // Initialize vehicle details
                ];

                // Check if this time slot is booked
                foreach ($schedules as $schedule) {
                    $scheduleStart = Carbon::parse($schedule->start_time);
                    $scheduleEnd = Carbon::parse($schedule->end_time);
                    $classStartDate = Carbon::parse($schedule->class_date);
                    $classEndDate = Carbon::parse($schedule->class_end_date);

                    // Check if the current time slot falls within the schedule period
                    if ($startTime >= $scheduleStart && $startTime < $scheduleEnd &&
                        Carbon::now()->between($classStartDate, $classEndDate)) {
                        $timeSlot['status'] = 'booked';
                        $timeSlot['student_name'] = $schedule->student->user->name; // Fetch student name
                        $timeSlot['class_date'] = $classStartDate->format('Y-m-d'); // Class start date
                        $timeSlot['end_date'] = $classEndDate->format('Y-m-d'); // Class end date
                        $timeSlot['vehicle_details'] = $schedule->vehicle->make . ' ' . $schedule->vehicle->model; // Vehicle details
                        break;
                    }
                }

                $timeSlots[] = $timeSlot;
                $startTime->addMinutes(30); // Move to the next 30-minute interval
            }

            // Add instructor schedule to the array
            $instructorSchedules[] = [
                'instructor' => $instructor->employee->user->name, // Assuming the instructor has a related employee
                'timeSlots' => $timeSlots,
            ];
        }

        // Return the instructor schedules and today's date
        return [
            'schedules' => $instructorSchedules,
            'today' => $today->format('l, F j, Y'), // Format today's date for display
        ];
    }

}
