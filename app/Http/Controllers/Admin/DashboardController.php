<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DailyExpense;
use App\Models\FixedExpense;
use App\Models\CarExpense;
use App\Models\Schedule;
use App\Models\Instructor;
use App\Models\Student;
use App\Models\Car;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $expenses = $this->getTotalExpenses();
        $sales = $this->getTotalSales();


        $monthlyData = $this->getMonthlyExpensesAndSales();

        $instructorSchedules = $this->getInstructorSchedules();
        $carSchedules = $this->getCarSchedules();

        $currentCounts = $this->getCurrentCounts();

        return view('admin.dashboard-2', [
            'todayExpense' => $expenses['today'],
            'monthlyExpense' => $expenses['monthly'],
            'yearlyExpense' => $expenses['yearly'],
            'todaySales' => $sales['today'],
            'monthlySales' => $sales['monthly'],
            'yearlySales' => $sales['yearly'],
            'monthlyExpenseData' => $monthlyData['monthlyExpenses'],  // Array for chart
            'monthlySalesData' => $monthlyData['monthlySales'],
            'availableSlots' => $instructorSchedules['availableSlots'],
            'bookedSchedules' => $instructorSchedules['bookedSchedules'],
            'class_date' => $instructorSchedules['class_date'],
            'instructors' => $instructorSchedules['instructors'],
            'availableCarSlots' => $carSchedules['availableSlots'],
            'bookedCarSchedules' => $carSchedules['bookedSchedules'],
            'cars' => $carSchedules['cars'],
            'totalStudentsCount' => $currentCounts['totalStudents'],
            'totalInstructorsCount' => $currentCounts['totalInstructors'],
            'totalCarsCount' => $currentCounts['totalCars'],
            'submittedFormsCount' => $currentCounts['submittedForms'],
            'todaysClassesCount' => $currentCounts['todaysClasses'],
        ]);
    }


    private function getCarSchedules()
    {
        $class_date = Carbon::now()->format('Y-m-d'); // Use current date
        $cars = Car::all(); // Fetch all cars

        $bookedSchedules = Schedule::with('student:id,course_end_date')
            ->where('class_date', '<=', $class_date)
            ->where('class_end_date', '>=', $class_date) // Check the end date of the class
            ->get(['vehicle_id', 'start_time', 'end_time', 'class_date', 'class_end_date', 'student_id']);

        $availableSlots = [];

        // Generate available slots for each car from 8 AM to 8 PM in 30-minute intervals
        foreach ($cars as $car) {
            $carIdentifier = $car->make . ' ' . $car->model . ' (' . $car->registration_number . ')'; // Car identifier
            $availableSlots[$carIdentifier] = [];

            for ($hour = 8; $hour <= 19; $hour++) {
                $time1 = Carbon::createFromTime($hour, 0)->format('H:i:s');
                $time2 = Carbon::createFromTime($hour, 30)->format('H:i:s');

                // Check if these slots are booked for this car
                $slot1Booked = $bookedSchedules->first(function ($slot) use ($car, $time1) {
                    return $slot->vehicle_id == $car->id &&
                        $slot->start_time <= $time1 && $slot->end_time > $time1;
                });

                $slot2Booked = $bookedSchedules->first(function ($slot) use ($car, $time2) {
                    return $slot->vehicle_id == $car->id &&
                        $slot->start_time <= $time2 && $slot->end_time > $time2;
                });

                // Add available or booked slots to the list for the car
                $availableSlots[$carIdentifier][] = [
                    'time' => $time1,
                    'status' => $slot1Booked ? 'Booked' : 'Available',
                    'start_time' => $slot1Booked->start_time ?? null,
                    'end_time' => $slot1Booked->end_time ?? null,
                    'class_date' => $slot1Booked->class_date ?? null,
                    'course_end_date' => $slot1Booked->student->course_end_date ?? null
                ];

                $availableSlots[$carIdentifier][] = [
                    'time' => $time2,
                    'status' => $slot2Booked ? 'Booked' : 'Available',
                    'start_time' => $slot2Booked->start_time ?? null,
                    'end_time' => $slot2Booked->end_time ?? null,
                    'class_date' => $slot2Booked->class_date ?? null,
                    'course_end_date' => $slot2Booked->student->course_end_date ?? null
                ];
            }
        }

        return [
            'availableSlots' => $availableSlots,
            'bookedSchedules' => $bookedSchedules,
            'cars' => $cars,
        ];
    }

    // Refactored function to get instructor schedules
    private function getInstructorSchedules()
    {
        $class_date = Carbon::now()->format('Y-m-d'); // Use current date
        $instructors = Instructor::with('employee.user')->get(); // Fetch instructors with user details

        $bookedSchedules = Schedule::with('student:id,course_end_date')
            ->where('class_date', '<=', $class_date)
            ->where('class_end_date', '>=', $class_date) // Check the end date of the class
            ->get(['instructor_id', 'start_time', 'end_time', 'class_date', 'class_end_date', 'student_id']);

        $availableSlots = [];

        // Generate available slots for each instructor from 8 AM to 8 PM in 30-minute intervals
        foreach ($instructors as $instructor) {
            $instructorName = $instructor->employee->user->name; // Get the instructor's name from the User model
            $availableSlots[$instructorName] = [];

            for ($hour = 8; $hour <= 19; $hour++) {
                $time1 = Carbon::createFromTime($hour, 0)->format('H:i:s');
                $time2 = Carbon::createFromTime($hour, 30)->format('H:i:s');

                // Check if these slots are booked for this instructor
                $slot1Booked = $bookedSchedules->first(function ($slot) use ($instructor, $time1) {
                    return $slot->instructor_id == $instructor->id &&
                        $slot->start_time <= $time1 && $slot->end_time > $time1;
                });

                $slot2Booked = $bookedSchedules->first(function ($slot) use ($instructor, $time2) {
                    return $slot->instructor_id == $instructor->id &&
                        $slot->start_time <= $time2 && $slot->end_time > $time2;
                });

                // Add available or booked slots to the list for the instructor
                $availableSlots[$instructorName][] = [
                    'time' => $time1,
                    'status' => $slot1Booked ? 'Booked' : 'Available',
                    'start_time' => $slot1Booked->start_time ?? null,
                    'end_time' => $slot1Booked->end_time ?? null,
                    'class_date' => $slot1Booked->class_date ?? null,
                    'course_end_date' => $slot1Booked->student->course_end_date ?? null
                ];

                $availableSlots[$instructorName][] = [
                    'time' => $time2,
                    'status' => $slot2Booked ? 'Booked' : 'Available',
                    'start_time' => $slot2Booked->start_time ?? null,
                    'end_time' => $slot2Booked->end_time ?? null,
                    'class_date' => $slot2Booked->class_date ?? null,
                    'course_end_date' => $slot2Booked->student->course_end_date ?? null
                ];
            }
        }

        return [
            'availableSlots' => $availableSlots,
            'bookedSchedules' => $bookedSchedules,
            'class_date' => $class_date,
            'instructors' => $instructors,
        ];
    }

    // Refactored function to get total expenses
    private function getTotalExpenses()
    {
        $todayExpense = DailyExpense::whereDate('expense_date', Carbon::today())->sum('amount')
            + FixedExpense::whereDate('expense_date', Carbon::today())->sum('amount')
            + CarExpense::whereDate('expense_date', Carbon::today())->sum('amount');

        $monthlyExpense = DailyExpense::whereMonth('expense_date', Carbon::now()->month)->sum('amount')
            + FixedExpense::whereMonth('expense_date', Carbon::now()->month)->sum('amount')
            + CarExpense::whereMonth('expense_date', Carbon::now()->month)->sum('amount');

        $yearlyExpense = DailyExpense::whereYear('expense_date', Carbon::now()->year)->sum('amount')
            + FixedExpense::whereYear('expense_date', Carbon::now()->year)->sum('amount')
            + CarExpense::whereYear('expense_date', Carbon::now()->year)->sum('amount');

        return [
            'today' => $todayExpense,
            'monthly' => $monthlyExpense,
            'yearly' => $yearlyExpense,
        ];
    }

        // Refactored function to get total sales
    private function getTotalSales()
    {
        // Calculate sales from students' fees for today
        $todaySales = Student::whereDate('admission_date', Carbon::today())->sum('fees');

        // Calculate sales from students' fees for this month
        $monthlySales = Student::whereMonth('admission_date', Carbon::now()->month)->sum('fees');

        // Calculate sales from students' fees for this year
        $yearlySales = Student::whereYear('admission_date', Carbon::now()->year)->sum('fees');

        return [
            'today' => $todaySales,
            'monthly' => $monthlySales,
            'yearly' => $yearlySales,
        ];
    }


    private function getCurrentCounts()
    {
        return [
            'totalStudents' => Student::count(),
            'totalInstructors' => Instructor::count(),
            'totalCars' => Car::count(),
            'submittedForms' => Student::where('form_type', 'admission')->count(),
            'todaysClasses' => Schedule::where('class_date', Carbon::today()->format('Y-m-d'))->count(),
        ];
    }

    // Function to get monthly expenses and sales data
    private function getMonthlyExpensesAndSales()
    {
        $monthlyExpenses = [];
        $monthlySales = [];

        // Loop through each month (1-12) to gather monthly data
        foreach (range(1, 12) as $month) {
            // Get monthly expenses
            $monthlyExpenses[] = DailyExpense::whereMonth('expense_date', $month)
                ->whereYear('expense_date', Carbon::now()->year)
                ->sum('amount')
                + FixedExpense::whereMonth('expense_date', $month)
                ->whereYear('expense_date', Carbon::now()->year)
                ->sum('amount')
                + CarExpense::whereMonth('expense_date', $month)
                ->whereYear('expense_date', Carbon::now()->year)
                ->sum('amount');

            // Get monthly sales
            $monthlySales[] = Student::whereMonth('admission_date', $month)
                ->whereYear('admission_date', Carbon::now()->year)
                ->sum('fees');
        }

        return [
            'monthlyExpenses' => $monthlyExpenses,
            'monthlySales' => $monthlySales,
        ];
    }

}

