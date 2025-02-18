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
use App\Models\Branch;
use Carbon\Carbon;
use App\Http\Controllers\Schedule\ScheduleController;
use App\Http\Controllers\Branch\BranchController;
use App\Http\Controllers\Student\StudentController;


class DashboardController extends Controller
{

    protected $scheduleController;
    protected $branchController;
    protected $studentController;

    public function __construct(ScheduleController $scheduleController,  BranchController $branchController, StudentController $studentController)
    {
        $this->scheduleController = $scheduleController;
        $this->branchController = $branchController;
        $this->studentController = $studentController;
    }

    public function index(Request $request)
    {
        // Get selected dates from the request, if provided
        $dateBefore = $request->input('dateBefore');
        $dateAfter = $request->input('dateAfter');

        // Determine if we are filtering by a date range or using today's date
        $today = Carbon::today();
        $startDate = $dateBefore ? Carbon::createFromFormat('Y-m-d', $dateBefore) : $today;
        $endDate = $dateAfter ? Carbon::createFromFormat('Y-m-d', $dateAfter) : $today;

        // Fetch expenses and sales data based on the selected date range
        $expenses = $this->getTotalExpenses($startDate, $endDate);
        $sales = $this->getTotalSales($startDate, $endDate);
        $monthlyData = $this->getMonthlyExpensesAndSales($startDate, $endDate);
        $schedules = Schedule::with([
            'instructor.employee.user',
            'vehicle',
            'student'
        ])
        ->whereBetween('class_date', [$startDate, $endDate]) // Filter by date range
        ->get();

        $data = $this->getInstructorsCarsAndTimeSlots();
        $currentCounts = $this->getCurrentCounts($startDate, $endDate);
        $todaysClasses = $this->getTodaysClasses($startDate, $endDate);
        $carSchedules = $this->scheduleController->getAllCarSchedules();
        $instructorSchedules = $this->scheduleController->getAllInstructorSchedules();
        $todayAdmissions = $this->studentController->getTomorrowAdmissionsData();
        $todayCreatedStudents = $this->studentController->getTodayCreatedStudents();
        $currentBranch = auth()->user()->currentBranch;

        // Get today's expense and sales details with date range
        $todayExpenseDetails = $this->getTodayExpenseDetails($startDate, $endDate);
        $todaySalesDetails = $this->getTodaySalesDetails($startDate, $endDate);

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
            'allPickupSectors' => $data['allPickupSectors'],
            'todaysClasses' => $todaysClasses,
            'carSchedules' => $carSchedules['schedules'],
            'instructorSchedules' => $instructorSchedules['schedules'],
            'today' => $carSchedules['today'],
            'currentBranch' => $currentBranch,
            'todayAdmissions' => $todayAdmissions,
            'todayCreatedStudents' => $todayCreatedStudents,
            'todayExpenseDetails' => $todayExpenseDetails,
            'todaySalesDetails' => $todaySalesDetails,
        ]);
    }


    // Refactored function to get total expenses based on date range
    private function getTotalExpenses($startDate, $endDate)
    {
        $todayExpense = DailyExpense::whereDate('expense_date', '>=', $startDate)
            ->whereDate('expense_date', '<=', $endDate)
            ->sum('amount')
            + FixedExpense::whereDate('expense_date', '>=', $startDate)
            ->whereDate('expense_date', '<=', $endDate)
            ->sum('amount')
            + CarExpense::whereDate('expense_date', '>=', $startDate)
            ->whereDate('expense_date', '<=', $endDate)
            ->sum('amount');

        $monthlyExpense = DailyExpense::whereMonth('expense_date', '>=', $startDate)
            ->whereMonth('expense_date', '<=', $endDate)
            ->sum('amount')
            + FixedExpense::whereMonth('expense_date', '>=', $startDate)
            ->whereMonth('expense_date', '<=', $endDate)
            ->sum('amount')
            + CarExpense::whereMonth('expense_date', '>=', $startDate)
            ->whereMonth('expense_date', '<=', $endDate)
            ->sum('amount');

        $yearlyExpense = DailyExpense::whereYear('expense_date', '>=', $startDate)
            ->whereYear('expense_date', '<=', $endDate)
            ->sum('amount')
            + FixedExpense::whereYear('expense_date', '>=', $startDate)
            ->whereYear('expense_date', '<=', $endDate)
            ->sum('amount')
            + CarExpense::whereYear('expense_date', '>=', $startDate)
            ->whereYear('expense_date', '<=', $endDate)
            ->sum('amount');

        $monthlyFuelExpense = CarExpense::where('expense_type', 'fuel')
            ->whereBetween('expense_date', [$startDate, $endDate])
            ->sum('amount');

        return [
            'today' => $todayExpense,
            'monthly' => $monthlyExpense,
            'yearly' => $yearlyExpense,
            'monthly_fuel' => $monthlyFuelExpense,
        ];
    }

    // Refactored function to get total sales based on date range
    private function getTotalSales($startDate, $endDate)
    {
        $todaySales = Student::whereDate('admission_date', '>=', $startDate)
            ->whereDate('admission_date', '<=', $endDate)
            ->with('course')
            ->get()
            ->sum(function ($student) {
                return $student->course->fees ?? 0;
            });

        $monthlySales = Student::whereMonth('admission_date', '>=', $startDate)
            ->whereMonth('admission_date', '<=', $endDate)
            ->with('course')
            ->get()
            ->sum(function ($student) {
                return $student->course->fees ?? 0;
            });

        $yearlySales = Student::whereYear('admission_date', '>=', $startDate)
            ->whereYear('admission_date', '<=', $endDate)
            ->with('course')
            ->get()
            ->sum(function ($student) {
                return $student->course->fees ?? 0;
            });

        return [
            'today' => $todaySales,
            'monthly' => $monthlySales,
            'yearly' => $yearlySales,
        ];
    }

    // Refactored function to get current counts based on date range
    private function getCurrentCounts($startDate, $endDate)
    {
        return [
            'totalStudents' => Student::whereBetween('admission_date', [$startDate, $endDate])->count(),
            'totalInstructors' => Instructor::whereBetween('created_at', [$startDate, $endDate])->count(),
            'totalCars' => Car::count(), // Assuming you do not want to filter cars by date
            'submittedForms' => Student::where('form_type', 'admission')->count(),
            'todaysClasses' => Schedule::whereBetween('class_date', [$startDate, $endDate])->count(),
        ];
    }

    // Refactored function to get monthly expenses and sales data based on date range
    private function getMonthlyExpensesAndSales($startDate, $endDate)
    {
        $monthlyExpenses = [];
        $monthlySales = [];

        foreach (range(1, 12) as $month) {
            // Get monthly expenses based on the date range
            $monthlyExpenses[] = DailyExpense::whereMonth('expense_date', $month)
                ->whereYear('expense_date', Carbon::now()->year)
                ->whereBetween('expense_date', [$startDate, $endDate])
                ->sum('amount')
                + FixedExpense::whereMonth('expense_date', $month)
                ->whereYear('expense_date', Carbon::now()->year)
                ->whereBetween('expense_date', [$startDate, $endDate])
                ->sum('amount')
                + CarExpense::whereMonth('expense_date', $month)
                ->whereYear('expense_date', Carbon::now()->year)
                ->whereBetween('expense_date', [$startDate, $endDate])
                ->sum('amount');

            // Get monthly sales based on the date range
            $monthlySales[] = Student::whereMonth('admission_date', $month)
                ->whereYear('admission_date', Carbon::now()->year)
                ->whereBetween('admission_date', [$startDate, $endDate])
                ->with('course')
                ->get()
                ->sum(function ($student) {
                    return $student->course->fees ?? 0;
                });
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
       $allPickupSectors = Student::whereNotNull('pickup_sector')->distinct()->pluck('pickup_sector');

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
           'allPickupSectors' => $allPickupSectors,
       ];
   }

   public function getTodaysClasses()
   {
       $today = Carbon::today()->format('Y-m-d');

       // Fetch only 10 schedules where today falls between the class_date and class_end_date
       $todaysClasses = Schedule::with(['student.user', 'instructor.employee.user', 'vehicle'])
           ->where('class_date', '<=', $today)
           ->where('class_end_date', '>=', $today)
           ->take(10) // Limit to 10 results
           ->get();

       return $todaysClasses;
   }

    public function getTodayExpenseDetails($startDate, $endDate)
    {
        // Filter expenses based on the provided date range
        $todayExpenses = DailyExpense::whereDate('expense_date', '>=', $startDate)
            ->whereDate('expense_date', '<=', $endDate)
            ->get();

        $todayFixedExpenses = FixedExpense::whereDate('expense_date', '>=', $startDate)
            ->whereDate('expense_date', '<=', $endDate)
            ->get();

        $todayCarExpenses = CarExpense::whereDate('expense_date', '>=', $startDate)
            ->whereDate('expense_date', '<=', $endDate)
            ->get();

        // Merge all expenses
        $allExpenses = $todayExpenses->merge($todayFixedExpenses)->merge($todayCarExpenses);

        return $allExpenses;
    }

    public function getTodaySalesDetails($startDate, $endDate)
    {
        // Get all students admitted between the selected dates and their course fees
        $students = Student::whereDate('admission_date', '>=', $startDate)
            ->whereDate('admission_date', '<=', $endDate)
            ->with('course') // Assuming each student has a course relation
            ->get();

        return $students;
    }
}

