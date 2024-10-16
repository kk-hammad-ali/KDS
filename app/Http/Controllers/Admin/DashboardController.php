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
use App\Http\Controllers\Schedule\ScheduleController;


class DashboardController extends Controller
{

    protected $scheduleController;

    public function __construct(ScheduleController $scheduleController)
    {
        $this->scheduleController = $scheduleController;
    }

    public function index()
    {
        // Fetch expenses and sales data
        $expenses = $this->getTotalExpenses();
        $sales = $this->getTotalSales();
        $monthlyData = $this->getMonthlyExpensesAndSales();
        $schedules = Schedule::with('instructor.employee.user', 'vehicle')->get();
        $data = $this->getInstructorsCarsAndTimeSlots();
        $currentCounts = $this->getCurrentCounts();
        $todaysClasses = $this->getTodaysClasses();
        $carSchedules = $this->scheduleController->getAllCarSchedules();
        $instructorSchedules = $this->scheduleController->getAllInstructorSchedules();


        return view('admin.dashboard', [
            'todayExpense' => $expenses['today'],
            'monthlyExpense' => $expenses['monthly'],
            'yearlyExpense' => $expenses['yearly'],
            'monthlyFuelExpense' => $expenses['monthly_fuel'],
            'todaySales' => $sales['today'],
            'monthlySales' => $sales['monthly'],
            'yearlySales' => $sales['yearly'],
            'monthlyExpenseData' => $monthlyData['monthlyExpenses'],
            'monthlySalesData' => $monthlyData['monthlySales'],
            'totalStudentsCount' => $currentCounts['totalStudents'],
            'totalInstructorsCount' => $currentCounts['totalInstructors'],
            'totalCarsCount' => $currentCounts['totalCars'],
            'submittedFormsCount' => $currentCounts['submittedForms'],
            'todaysClassesCount' => $currentCounts['todaysClasses'],
            'schedules' => $schedules,
            'instructors' => $data['instructors'],
            'all_cars' => $data['cars'],
            'timeSlots' => $data['timeSlots'],
            'todaysClasses' => $todaysClasses,
            'carSchedules' => $carSchedules['schedules'],
            'instructorSchedules' => $instructorSchedules['schedules'],
            'today' => $carSchedules['today'],
        ]);
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

        $monthlyFuelExpense = CarExpense::where('expense_type', 'fuel')
        ->whereMonth('expense_date', Carbon::now()->month)
        ->sum('amount');

        return [
            'today' => $todayExpense,
            'monthly' => $monthlyExpense,
            'yearly' => $yearlyExpense,
            'monthly_fuel' =>$monthlyFuelExpense,
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


   // Function for dropdown data (instructors, cars, and time slots)
   private function getInstructorsCarsAndTimeSlots()
   {
       $instructors = Instructor::with('employee.user')->get();
       $cars = Car::all();

       // Generate time slots
       $timeSlots = [];
       for ($hour = 8; $hour <= 19; $hour++) {
           $time1 = Carbon::createFromTime($hour, 0)->format('H:i');
           $time2 = Carbon::createFromTime($hour, 30)->format('H:i');
           $timeSlots[] = [
               'value' => $time1,
               'display' => Carbon::createFromTime($hour, 0)->format('h:i A')
           ];
           $timeSlots[] = [
               'value' => $time2,
               'display' => Carbon::createFromTime($hour, 30)->format('h:i A')
           ];
       }

       return [
           'instructors' => $instructors,
           'cars' => $cars,
           'timeSlots' => $timeSlots,
       ];
   }

   public function getTodaysClasses()
   {
       $today = Carbon::today()->format('Y-m-d');

       // Fetch schedules where today falls between the class_date and class_end_date
       $todaysClasses = Schedule::with(['student.user', 'instructor.employee.user', 'vehicle'])
           ->where('class_date', '<=', $today)
           ->where('class_end_date', '>=', $today)
           ->get();

       return $todaysClasses;
   }
}

