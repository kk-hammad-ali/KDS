<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\BranchController;
use App\Http\Controllers\Public\GalleryController;
use App\Http\Controllers\Public\CourseController;
use App\Http\Controllers\Public\BlogController;

use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Employee\EmployeeController;

use App\Http\Controllers\Instructor\InstructorController;

use App\Http\Controllers\Student\StudentController;

use App\Http\Controllers\Coupon\CouponController;

use App\Http\Controllers\Courses\CoursesController;

use App\Http\Controllers\Expense\FixedExpenseController;
use App\Http\Controllers\Expense\CarExpenseController;
use App\Http\Controllers\Expense\DailyExpenseController;

use App\Http\Controllers\Auth\SignInController;

use App\Http\Controllers\Car\CarController;

use App\Http\Controllers\Leave\LeaveController;

use App\Http\Controllers\Schedule\ScheduleController;

use App\Http\Controllers\Attendance\AttendanceController;

use App\Http\Controllers\Main\LoginController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Main website
    Route::get('/', function () {
        return view('public.index');
    })->name('home');

    Route::get('/about', [AboutController::class, 'index'])->name("public.about");
    Route::get('/contact', [ContactController::class, 'index'])->name("public.contact");
    Route::get('/branches', [BranchController::class, 'index'])->name("public.branch");
    Route::get('/gallery', [GalleryController::class, 'index'])->name("public.gallery");
    Route::get('/courses', [CourseController::class, 'index'])->name("public.courses");
    Route::get('/blog', [BlogController::class, 'index'])->name("public.blog");
    Route::get('/blog/common-traffic', [BlogController::class, 'commonTraffic'])->name("public.blog.common-traffic");
    Route::get('/blog/driving-test', [BlogController::class, 'drivingTest'])->name("public.blog.driving-test");
    Route::get('/blog/tips-for-beginner', [BlogController::class, 'tipsBeginner'])->name("public.blog.tips-for-beginner");
    Route::get('/courses/mehranCourse', [CourseController::class, 'mehranCourse'])->name("public.courses.mehranCourse");
    Route::get('/courses/altoCourse', [CourseController::class, 'altoCourse'])->name("public.courses.altoCourse");
    Route::get('/courses/hondaCourse', [CourseController::class, 'hondaCourse'])->name("public.courses.hondaCourse");
    Route::get('/courses/vitzCourse', [CourseController::class, 'vitzCourse'])->name("public.courses.vitzCourse");
    Route::get('/courses/miraCourse', [CourseController::class, 'miraCourse'])->name("public.courses.miraCourse");
    Route::get('/courses/cd70', [CourseController::class, 'cd70'])->name("public.courses.cd70");

// Auth Routes
    Route::get('/signin', [SignInController::class, 'index'])->name('login');
    Route::post('/signin', [SignInController::class, 'login'])->name("login_user");

// Admin
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Admin-Student Routes
    Route::get('/admin/students/', [StudentController::class, 'adminAllStudent'])->name("admin.allStudents");
    Route::get('/admin/students/add', [StudentController::class, 'adminAddStudent'])->name("admin.addStudent");
    Route::post('/admin/students/add', [StudentController::class, 'adminStoreStudent'])->name("admin.students.store");
    Route::get('/admin/students/edit/{id}', [StudentController::class, 'adminEditStudent'])->name('admin.editStudent');
    Route::put('/admin/students/update/{id}', [StudentController::class, 'adminUpdateStudent'])->name('admin.students.update');
    Route::get('/admin/students/delete/{id}', [StudentController::class, 'adminDestroyStudent'])->name('admin.deleteStudent');

    // Admin-Instructor Routes
    Route::get('/admin/instructors/', [InstructorController::class, 'adminAllInstructors'])->name("admin.allInstructors");
    Route::get('/admin/instructors/add', [InstructorController::class, 'adminAddInstructor'])->name("admin.addInstructor");
    Route::post('/admin/instructors/add', [InstructorController::class, 'adminStoreInstructor'])->name("admin.instructors.store");
    Route::get('/admin/instructors/edit/{id}', [InstructorController::class, 'adminEditInstructor'])->name('admin.editInstructor');
    Route::put('/admin/instructors/update/{id}', [InstructorController::class, 'adminUpdateInstructor'])->name('admin.updateInstructor');
    Route::get('/admin/students/delete/{id}', [InstructorController::class, 'adminDestroyInstructor'])->name('admin.deleteInstructor');

    // Admin-Employee Routes
    Route::get('/admin/employees/', [EmployeeController::class, 'adminAllEmployees'])->name("admin.allEmployees");
    Route::get('/admin/employees/add', [EmployeeController::class, 'adminAddEmployee'])->name("admin.addEmployee");
    Route::post('/admin/employees/add', [EmployeeController::class, 'adminStoreEmployee'])->name("admin.employees.store");
    Route::get('/admin/employees/edit/{id}', [EmployeeController::class, 'adminEditEmployee'])->name('admin.editEmployee');
    Route::put('/admin/employees/update/{id}', [EmployeeController::class, 'adminUpdateEmployee'])->name('admin.updateEmployee');
    Route::get('/admin/employees/delete/{id}', [EmployeeController::class, 'adminDestroyEmployee'])->name('admin.deleteEmployee');


// Admin-Courses Routes
    Route::get('/admin/courses/', [CoursesController::class, 'allCoursesPage'])->name("admin.allCourses");
    Route::get('/admin/courses/add', [CoursesController::class, 'addCourses'])->name("admin.addCourses");
    Route::post('/admin/courses/add', [CoursesController::class, 'storeCourse'])->name("admin.courses.store");
    Route::get('/admin/courses/edit/{id}', [CoursesController::class, 'editCourse'])->name('admin.editCourse');
    Route::post('/admin/courses/{course}/update', [CoursesController::class, 'updateCourse'])->name('admin.updateCourse');
    Route::get('/admin/courses/delete/{id}', [CoursesController::class, 'deleteCourse'])->name('admin.deleteCourse');

// Admin - Attendence Routes
    // Student Attendance Routes
    Route::get('/student/attendance', [AttendanceController::class, 'showStudentAttendance'])->name('student.attendance.show');
    Route::get('/student/attendance/mark/{date}', [AttendanceController::class, 'markTodayStudentAttendance'])->name('student.attendance.mark');
    Route::post('/student/attendance/store', [AttendanceController::class, 'storeStudentAttendance'])->name('student.attendance.store');


    // Instructor Attendance Routes
    Route::get('/admin/instructors/attendance', [AttendanceController::class, 'showInstructorAttendance'])->name('instructor.attendance.show');
    Route::get('/admin/instructors/attendance/mark/{date}', [AttendanceController::class, 'markTodayAttendance'])->name('instructor.attendance.mark');
    Route::post('/admin/instructors/attendance/store', [AttendanceController::class, 'storeInstructorAttendance'])->name('instructor.attendance.store');

//Admin Fix Expenses
Route::get('/admin/fix-expenses/', [ExpenseController::class, 'fix_expense_page'])->name("admin.fixExpenses");


// Admin Coupons Routes
    Route::get('/admin/coupons', [CouponController::class, 'allCouponsPage'])->name('admin.allCoupons');
    Route::get('/admin/coupons/create', [CouponController::class, 'addCoupons'])->name('admin.addCoupons');
    Route::post('/admin/coupons/add', [CouponController::class, 'storeCoupons'])->name('admin.coupons.store');
    Route::get('/admin/coupons/edit/{id}', [CouponController::class, 'editCoupons'])->name('admin.editCoupon');
    Route::put('/admin/coupons/{id}', [CouponController::class, 'update'])->name('admin.coupons.update');
    Route::get('/admin/coupons/delete/{id}', [CouponController::class, 'destroy'])->name('admin.deleteCoupons');

// Admin Cars
    Route::get('/admin/cars', [CarController::class, 'allCarsPage'])->name('admin.allCars');
    Route::get('/admin/cars/create', [CarController::class, 'addCars'])->name('admin.addCars');
    Route::post('/admin/cars/add', [CarController::class, 'storeCars'])->name('admin.cars.store');
    Route::get('/admin/cars/edit/{id}', [CarController::class, 'editCars'])->name('admin.editCar');
    Route::put('/admin/cars/{id}', [CarController::class, 'update'])->name('admin.updateCar');
    Route::get('/admin/cars/delete/{id}', [CarController::class, 'destroy'])->name('admin.deleteCars');

    // Fixed Expenses Routes
    Route::get('/admin/expense/fixed', [FixedExpenseController::class, 'index'])->name('admin.fixedExpenses');
    Route::get('/admin/expense/fixed/create', [FixedExpenseController::class, 'create'])->name('admin.fixedExpenses.create');
    Route::post('/admin/expense/fixed/store', [FixedExpenseController::class, 'store'])->name('admin.fixedExpenses.store');
    Route::get('/admin/expense/fixed/edit/{id}', [FixedExpenseController::class, 'edit'])->name('admin.fixedExpenses.edit');
    Route::put('/admin/expense/fixed/update/{id}', [FixedExpenseController::class, 'update'])->name('admin.fixedExpenses.update');
    Route::get('/admin/expense/fixed/delete/{id}', [FixedExpenseController::class, 'destroy'])->name('admin.fixedExpenses.delete');

    // Car Expenses Routes
    Route::get('/admin/expense/car', [CarExpenseController::class, 'index'])->name('admin.carExpenses');
    Route::get('/admin/expense/car/create', [CarExpenseController::class, 'create'])->name('admin.carExpenses.create');
    Route::post('/admin/expense/car/store', [CarExpenseController::class, 'store'])->name('admin.carExpenses.store');
    Route::get('/admin/expense/car/edit/{id}', [CarExpenseController::class, 'edit'])->name('admin.carExpenses.edit');
    Route::put('/admin/expense/car/update/{id}', [CarExpenseController::class, 'update'])->name('admin.carExpenses.update');
    Route::get('/admin/expense/car/delete/{id}', [CarExpenseController::class, 'destroy'])->name('admin.carExpenses.delete');

    // Daily Expenses Routes
    Route::get('/admin/expense/daily', [DailyExpenseController::class, 'index'])->name('admin.dailyExpenses');
    Route::get('/admin/expense/daily/create', [DailyExpenseController::class, 'create'])->name('admin.dailyExpenses.create');
    Route::post('/admin/expense/daily/store', [DailyExpenseController::class, 'store'])->name('admin.dailyExpenses.store');
    Route::get('/admin/expense/daily/edit/{id}', [DailyExpenseController::class, 'edit'])->name('admin.dailyExpenses.edit');
    Route::put('/admin/expense/daily/update/{id}', [DailyExpenseController::class, 'update'])->name('admin.dailyExpenses.update');
    Route::get('/admin/expense/daily/delete/{id}', [DailyExpenseController::class, 'destroy'])->name('admin.dailyExpenses.delete');

// Admin Leaves
    Route::get('/admin/leaves', [LeaveController::class, 'allLeavePage'])->name('admin.allLeaves');
    Route::post('update-leave-status', [LeaveController::class, 'updateStatus'])->name('admin.updateLeaveStatus');

// Admin-Schedules
    Route::get('/admin/schedule/create', [ScheduleController::class, 'createSchedule'])->name('admin.createSchedule');
    Route::post('/admin/schedule/store', [ScheduleController::class, 'storeSchedule'])->name('admin.storeSchedule');
    Route::get('/admin/schedules', [ScheduleController::class, 'allSchedules'])->name('admin.allSchedules');
    Route::get('/admin/schedules/booked-times', [ScheduleController::class, 'getBookedTimes'])->name('schedules.booked-times');


// Instructor Routes

// Dashboard
    Route::get('/instructor/dashboard', [InstructorController::class, 'index'])->name('instructor.dashboard');
    Route::get('/instructor/schedules', [ScheduleController::class, 'instructorSchedules'])->name('instructor.schedules');
    Route::get('/instructor/students', [StudentController::class, 'instructorStudents'])->name('instructor.students');

// Instructor Leave
    Route::get('/instructor/leaves', [LeaveController::class, 'all_leaves_instructor'])->name('instructor.allLeaves');
    Route::get('/instructor/leaves/create', [LeaveController::class, 'addLeavesInstructor'])->name('instructor.addLeaves');
    Route::post('/instructor/leaves/add', [LeaveController::class, 'storeLeaves'])->name('instructor.leaves.store');
    Route::get('/instructor/leaves/edit/{leave}', [LeaveController::class, 'editLeave'])->name('instructor.editLeave');
    Route::put('/instructor/leaves/{leave}', [LeaveController::class, 'updateLeave'])->name('instructor.updateLeave');
    Route::get('/instructor/leaves/delete/{leave}', [LeaveController::class, 'destroy'])->name('instructor.deleteLeave');
