<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\BranchController;
use App\Http\Controllers\Public\GalleryController;
use App\Http\Controllers\Public\CourseController;
use App\Http\Controllers\Public\BlogController;
use App\Http\Controllers\Public\AdmissionFormController;
use App\Http\Controllers\Public\QuizController;
use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Employee\EmployeeController;

use App\Http\Controllers\Instructor\InstructorController;

use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\CertificateController;

use App\Http\Controllers\Coupon\CouponController;

use App\Http\Controllers\Courses\CoursesController;

use App\Http\Controllers\Invoice\InvoiceController;

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
    Route::get('/contact', [ContactController::class, 'index'])->name('public.contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('public.contact.store');

    Route::get('/admission', [AdmissionFormController::class, 'index'])->name('public.admission.form');
    Route::post('/admission', [AdmissionFormController::class, 'store'])->name('public.admission.store');

    Route::get('/branches', [BranchController::class, 'index'])->name("public.branch");
    Route::get('/gallery', [GalleryController::class, 'index'])->name("public.gallery");
    Route::get('/courses', [CourseController::class, 'index'])->name("public.courses");
    Route::match(['get', 'post'], '/quiz', [QuizController::class, 'index'])->name('public.quiz');

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
    Route::get('/logout', [SignInController::class, 'adminLogout'])->name('admin.logout');
    Route::get('/instructor/logout', [SignInController::class, 'instructorLogout'])->name('instructor.logout');
    Route::get('/student/logout', [SignInController::class, 'studentLogout'])->name('student.logout');
    // Admin
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('admin_guard');

    // Contact
    Route::get('admin/contact', [ContactController::class, 'adminallContact'])->name('admin.allContact')->middleware('admin_guard');
    Route::get('admin/admission-form', [AdmissionFormController::class, 'adminallAdmssionForm'])->name('admin.allAdmissionForm')->middleware('admin_guard');
    Route::put('/admin/student/update/{id}', [AdmissionFormController::class, 'adminUpdateFormStudent'])->name('admin.formstudents.update')->middleware('admin_guard');

    // Admin-Student Routes
    Route::get('/admin/students/', [StudentController::class, 'adminAllStudent'])->name("admin.allStudents")->middleware('admin_guard');
    Route::get('/admin/students/add', [StudentController::class, 'adminAddStudent'])->name("admin.addStudent")->middleware('admin_guard');
    Route::post('/admin/students/add', [StudentController::class, 'adminStoreStudent'])->name("admin.students.store")->middleware('admin_guard');
    Route::get('/admin/students/edit/{id}', [StudentController::class, 'adminEditStudent'])->name('admin.editStudent')->middleware('admin_guard');
    Route::put('/admin/students/update/{id}', [StudentController::class, 'adminUpdateStudent'])->name('admin.students.update')->middleware('admin_guard');
    Route::get('/admin/students/delete/{id}', [StudentController::class, 'adminDestroyStudent'])->name('admin.deleteStudent')->middleware('admin_guard');

    // Admin-Instructor Routes
    Route::get('/admin/instructors/', [InstructorController::class, 'adminAllInstructors'])->name("admin.allInstructors")->middleware('admin_guard');
    Route::get('/admin/instructors/add', [InstructorController::class, 'adminAddInstructor'])->name("admin.addInstructor")->middleware('admin_guard');
    Route::post('/admin/instructors/add', [InstructorController::class, 'adminStoreInstructor'])->name("admin.instructors.store")->middleware('admin_guard');
    Route::get('/admin/instructors/edit/{id}', [InstructorController::class, 'adminEditInstructor'])->name('admin.editInstructor')->middleware('admin_guard');
    Route::put('/admin/instructors/update/{id}', [InstructorController::class, 'adminUpdateInstructor'])->name('admin.updateInstructor')->middleware('admin_guard');
    Route::get('/admin/instructors/delete/{id}', [InstructorController::class, 'adminDestroyInstructor'])->name('admin.deleteInstructor')->middleware('admin_guard');

    // Admin-Employee Routes
    Route::get('/admin/employees/', [EmployeeController::class, 'adminAllEmployees'])->name("admin.allEmployees")->middleware('admin_guard');
    Route::get('/admin/employees/add', [EmployeeController::class, 'adminAddEmployee'])->name("admin.addEmployee")->middleware('admin_guard');
    Route::post('/admin/employees/add', [EmployeeController::class, 'adminStoreEmployee'])->name("admin.employees.store")->middleware('admin_guard');
    Route::get('/admin/employees/edit/{id}', [EmployeeController::class, 'adminEditEmployee'])->name('admin.editEmployee')->middleware('admin_guard');
    Route::put('/admin/employees/update/{id}', [EmployeeController::class, 'adminUpdateEmployee'])->name('admin.updateEmployee')->middleware('admin_guard');
    Route::get('/admin/employees/delete/{id}', [EmployeeController::class, 'adminDestroyEmployee'])->name('admin.deleteEmployee')->middleware('admin_guard');

    // Admin-Courses Routes
    Route::get('/admin/courses/', [CoursesController::class, 'allCoursesPage'])->name("admin.allCourses")->middleware('admin_guard');
    Route::get('/admin/courses/add', [CoursesController::class, 'addCourses'])->name("admin.addCourses")->middleware('admin_guard');
    Route::post('/admin/courses/add', [CoursesController::class, 'storeCourse'])->name("admin.courses.store")->middleware('admin_guard');
    Route::get('/admin/courses/edit/{id}', [CoursesController::class, 'editCourse'])->name('admin.editCourse')->middleware('admin_guard');
    Route::put('/admin/courses/{id}', [CoursesController::class, 'updateCourse'])->name('admin.updateCourse')->middleware('admin_guard');
    Route::get('/admin/courses/delete/{id}', [CoursesController::class, 'deleteCourse'])->name('admin.deleteCourse')->middleware('admin_guard');

    // Admin - Attendance Routes
    // Student Attendance Routes
    Route::get('/admin/student/attendance', [AttendanceController::class, 'showStudentAttendance'])->name('student.attendance.show')->middleware('admin_guard');
    Route::get('/admin/student/attendance/mark/{date}', [AttendanceController::class, 'markTodayStudentAttendance'])->name('student.attendance.mark')->middleware('admin_guard');
    Route::post('/admin/student/attendance/store', [AttendanceController::class, 'storeStudentAttendance'])->name('student.attendance.store')->middleware('admin_guard');

    // Instructor Attendance Routes
    Route::get('/admin/instructors/attendance', [AttendanceController::class, 'showInstructorAttendance'])->name('instructor.attendance.show')->middleware('admin_guard');
    Route::get('/admin/instructors/attendance/mark/{date}', [AttendanceController::class, 'markTodayAttendance'])->name('instructor.attendance.mark')->middleware('admin_guard');
    Route::post('/admin/instructors/attendance/store', [AttendanceController::class, 'storeInstructorAttendance'])->name('instructor.attendance.store')->middleware('admin_guard');

    // Admin Coupons Routes
    Route::get('/admin/coupons', [CouponController::class, 'allCouponsPage'])->name('admin.allCoupons')->middleware('admin_guard');
    Route::get('/admin/coupons/create', [CouponController::class, 'addCoupons'])->name('admin.addCoupons')->middleware('admin_guard');
    Route::post('/admin/coupons/add', [CouponController::class, 'storeCoupons'])->name('admin.coupons.store')->middleware('admin_guard');
    Route::get('/admin/coupons/edit/{id}', [CouponController::class, 'editCoupons'])->name('admin.editCoupon')->middleware('admin_guard');
    Route::put('/admin/coupons/{id}', [CouponController::class, 'update'])->name('admin.coupons.update')->middleware('admin_guard');
    Route::get('/admin/coupons/delete/{id}', [CouponController::class, 'destroy'])->name('admin.deleteCoupons')->middleware('admin_guard');

    // Admin Cars
    Route::get('/admin/cars', [CarController::class, 'allCarsPage'])->name('admin.allCars')->middleware('admin_guard');
    Route::get('/admin/cars/create', [CarController::class, 'addCars'])->name('admin.addCars')->middleware('admin_guard');
    Route::post('/admin/cars/add', [CarController::class, 'storeCars'])->name('admin.cars.store')->middleware('admin_guard');
    Route::get('/admin/cars/edit/{id}', [CarController::class, 'editCars'])->name('admin.editCar')->middleware('admin_guard');
    Route::put('/admin/cars/{id}', [CarController::class, 'update'])->name('admin.updateCar')->middleware('admin_guard');
    Route::get('/admin/cars/delete/{id}', [CarController::class, 'destroy'])->name('admin.deleteCars')->middleware('admin_guard');

    // Fixed Expenses Routes
    Route::get('/admin/expense/fixed', [FixedExpenseController::class, 'index'])->name('admin.fixedExpenses')->middleware('admin_guard');
    Route::get('/admin/expense/fixed/create', [FixedExpenseController::class, 'create'])->name('admin.fixedExpenses.create')->middleware('admin_guard');
    Route::post('/admin/expense/fixed/store', [FixedExpenseController::class, 'store'])->name('admin.fixedExpenses.store')->middleware('admin_guard');
    Route::get('/admin/expense/fixed/edit/{id}', [FixedExpenseController::class, 'edit'])->name('admin.fixedExpenses.edit')->middleware('admin_guard');
    Route::put('/admin/expense/fixed/update/{id}', [FixedExpenseController::class, 'update'])->name('admin.fixedExpenses.update')->middleware('admin_guard');
    Route::get('/admin/expense/fixed/delete/{id}', [FixedExpenseController::class, 'destroy'])->name('admin.fixedExpenses.delete')->middleware('admin_guard');

    // Car Expenses Routes
    Route::get('/admin/expense/car', [CarExpenseController::class, 'index'])->name('admin.carExpenses')->middleware('admin_guard');
    Route::get('/admin/expense/car/create', [CarExpenseController::class, 'create'])->name('admin.carExpenses.create')->middleware('admin_guard');
    Route::post('/admin/expense/car/store', [CarExpenseController::class, 'store'])->name('admin.carExpenses.store')->middleware('admin_guard');
    Route::get('/admin/expense/car/edit/{id}', [CarExpenseController::class, 'edit'])->name('admin.carExpenses.edit')->middleware('admin_guard');
    Route::put('/admin/expense/car/update/{id}', [CarExpenseController::class, 'update'])->name('admin.carExpenses.update')->middleware('admin_guard');
    Route::get('/admin/expense/car/delete/{id}', [CarExpenseController::class, 'destroy'])->name('admin.carExpenses.delete')->middleware('admin_guard');

    // Daily Expenses Routes
    Route::get('/admin/expense/daily', [DailyExpenseController::class, 'index'])->name('admin.dailyExpenses')->middleware('admin_guard');
    Route::get('/admin/expense/daily/create', [DailyExpenseController::class, 'create'])->name('admin.dailyExpenses.create')->middleware('admin_guard');
    Route::post('/admin/expense/daily/store', [DailyExpenseController::class, 'store'])->name('admin.dailyExpenses.store')->middleware('admin_guard');
    Route::get('/admin/expense/daily/edit/{id}', [DailyExpenseController::class, 'edit'])->name('admin.dailyExpenses.edit')->middleware('admin_guard');
    Route::put('/admin/expense/daily/update/{id}', [DailyExpenseController::class, 'update'])->name('admin.dailyExpenses.update')->middleware('admin_guard');
    Route::get('/admin/expense/daily/delete/{id}', [DailyExpenseController::class, 'destroy'])->name('admin.dailyExpenses.delete')->middleware('admin_guard');

    // Admin Leaves
    Route::get('/admin/leaves', [LeaveController::class, 'adminallLeaves'])->name('admin.allLeaves')->middleware('admin_guard');
    Route::post('update-leave-status', [LeaveController::class, 'adminupdateLeaveStatus'])->name('admin.updateLeaveStatus')->middleware('admin_guard');

    // Admin-Schedules
    Route::get('/admin/schedule/create', [ScheduleController::class, 'createSchedule'])->name('admin.createSchedule')->middleware('admin_guard');
    Route::post('/admin/schedule/store', [ScheduleController::class, 'storeSchedule'])->name('admin.storeSchedule')->middleware('admin_guard');
    Route::get('/admin/schedules', [ScheduleController::class, 'allSchedules'])->name('admin.allSchedules')->middleware('admin_guard');
    Route::get('/admin/schedules/booked-times', [ScheduleController::class, 'getBookedTimes'])->name('schedules.booked-times')->middleware('admin_guard');

    Route::get('/invoices', [InvoiceController::class, 'index'])->name("admin.allInvoices")->middleware('admin_guard');
    // Route::get('/invoices/{id}/pdf', [InvoiceController::class, 'showPdf'])->name('invoice.pdf')->middleware('admin_guard');
    Route::get('/invoices/{id}', [InvoiceController::class, 'show'])->name('invoice.show')->middleware('admin_guard');





// Instructor Routes

    // Dashboard
    Route::get('/instructor/dashboard', [InstructorController::class, 'index'])->name('instructor.dashboard')->middleware('instructor_guard');
    Route::get('/instructor/schedules', [ScheduleController::class, 'instructorSchedules'])->name('instructor.schedules')->middleware('instructor_guard');
    Route::get('/instructor/students', [StudentController::class, 'instructorStudents'])->name('instructor.students')->middleware('instructor_guard');

    // Instructor Leave Routes
    Route::get('/instructor/leaves', [LeaveController::class, 'all_leaves_instructor'])->name('instructor.allLeaves')->middleware('instructor_guard');
    Route::get('/instructor/leaves/create', [LeaveController::class, 'addLeavesInstructor'])->name('instructor.addLeaves')->middleware('instructor_guard');
    Route::post('/instructor/leaves/add', [LeaveController::class, 'storeLeavesInstructor'])->name('instructor.leaves.store')->middleware('instructor_guard');
    Route::get('/instructor/leaves/edit/{leave}', [LeaveController::class, 'editLeaveInstructor'])->name('instructor.editLeave')->middleware('instructor_guard');
    Route::put('/instructor/leaves/{leave}', [LeaveController::class, 'updateLeaveInstructor'])->name('instructor.updateLeave')->middleware('instructor_guard');
    Route::get('/instructor/leaves/delete/{leave}', [LeaveController::class, 'destroyInstructorLeave'])->name('instructor.deleteLeave')->middleware('instructor_guard');

    Route::get('/instructor/student/attendance', [AttendanceController::class, 'showInstructorStudentAttendance'])->name('instructor.student.attendance.show')->middleware('instructor_guard');
    Route::get('/instructor/student/attendance/mark/{date}', [AttendanceController::class, 'markTodayInstructorStudentAttendance'])->name('instructor.student.attendance.mark')->middleware('instructor_guard');
    Route::post('/instructor/student/attendance/store', [AttendanceController::class, 'storeInstructorStudentAttendance'])->name('instructor.student.attendance.store')->middleware('instructor_guard');


// Studnet Routes

  // Dashboard
    Route::get('/student/dashboard', [StudentController::class, 'index'])->name('student.dashboard')->middleware('student_guard');
    Route::get('/student/schedules', [ScheduleController::class, 'studentSchedules'])->name('student.schedules')->middleware('student_guard');
    Route::get('/student/certificate', [CertificateController::class, 'index'])->name('student.certificate')->middleware('student_guard');
    Route::get('/download-certificate', [CertificateController::class, 'downloadCertificate'])->name('download.certificate')->middleware('student_guard');

    // Student Leave Routes
    Route::get('/student/leaves', [LeaveController::class, 'all_leaves_student'])->name('student.allLeaves')->middleware('student_guard');
    Route::get('/student/leaves/create', [LeaveController::class, 'addLeavesStudent'])->name('student.addLeaves')->middleware('student_guard');
    Route::post('/student/leaves/add', [LeaveController::class, 'storeLeavesStudent'])->name('student.leaves.store')->middleware('student_guard');
    Route::get('/student/leaves/edit/{leave}', [LeaveController::class, 'editLeaveStudent'])->name('student.editLeave')->middleware('student_guard');
    Route::put('/student/leaves/{leave}', [LeaveController::class, 'updateLeaveStudent'])->name('student.updateLeave');
    Route::delete('/student/leaves/delete/{leave}', [LeaveController::class, 'destroyStudentLeave'])->name('student.deleteLeave')->middleware('student_guard');

