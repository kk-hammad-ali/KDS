<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Branch\BranchController;
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
use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Car\CarModelController;

// Main website
Route::get('/', function () {
    return view('public.index');
})->name('home');

// Public Routes
Route::get('/about-us', [AboutController::class, 'index'])->name("public.about");
Route::get('/contact-us', [ContactController::class, 'index'])->name('public.contact');
Route::post('/contact', [ContactController::class, 'store'])->name('public.contact.store');
Route::get('/admission', [AdmissionFormController::class, 'index'])->name('public.admission.form');
Route::post('/admission', [AdmissionFormController::class, 'store'])->name('public.admission.store');
Route::get('/branches', [BranchController::class, 'index'])->name("public.branch");
Route::get('/gallery', [GalleryController::class, 'index'])->name("public.gallery");
Route::get('/courses', [CourseController::class, 'index'])->name("public.courses");

// Route::match(['get', 'post'], '/quiz', [QuizController::class, 'index'])->name('public.quiz');

Route::get('/quiz', [QuizController::class, 'index'])->name('public.quiz');
Route::get('/quiz/english', [QuizController::class, 'indexEnglish'])->name('public.quiz.english');
Route::get('/quiz/urdu', [QuizController::class, 'indexUrdu'])->name('public.quiz.urdu');


Route::get('/blog', [BlogController::class, 'index'])->name('public.blog');
Route::get('/blog/common-traffic', [BlogController::class, 'commonTraffic'])->name('public.blog.common-traffic');
Route::get('/blog/driving-test', [BlogController::class, 'drivingTest'])->name('public.blog.driving-test');
Route::get('/blog/tips-for-beginner', [BlogController::class, 'tipsBeginner'])->name('public.blog.tips-for-beginner');

Route::get('/suzuki-mehran', [CourseController::class, 'mehranCourse'])->name("public.courses.mehranCourse");
Route::get('/courses/suzuki-alto-manual', [CourseController::class, 'altoCourse'])->name("public.courses.altoCourse");
Route::get('/courses/honda-city', [CourseController::class, 'hondaCourse'])->name("public.courses.hondaCourse");
Route::get('/toyota-vitz-automatic', [CourseController::class, 'vitzCourse'])->name("public.courses.vitzCourse");
Route::get('/daihatsu-mira-automaic', [CourseController::class, 'miraCourse'])->name("public.courses.miraCourse");
Route::get('/courses/swift', [CourseController::class, 'swiftCourse'])->name("public.courses.swiftCourse");
Route::get('/bike', [CourseController::class, 'cd70'])->name("public.courses.cd70");

// Auth Routes
Route::get('/signin', [SignInController::class, 'index'])->name('login');
Route::post('/signin', [SignInController::class, 'login'])->name("login_user");
Route::get('/logout', [SignInController::class, 'logout'])->name('logout');


// Notification routes
Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'allNotifications'])->name('notifications.all_notifications');
});

// Admin Routes
Route::middleware(['role:admin'])->group(function () {

    Route::post('/switch-branch', [BranchController::class, 'switchBranch'])->name('branch.switch');

    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/contact', [ContactController::class, 'adminallContact'])->name('admin.allContact');
    Route::get('/admin/admission-forms', [AdmissionFormController::class, 'adminAllAdmissionForm'])->name('admin.allAdmissionForms');
    Route::put('/admin/student/update/{id}', [AdmissionFormController::class, 'adminUpdateFormStudent'])->name('admin.formstudents.update');

    // Admin-Student Routes
    Route::get('/admin/students/', [StudentController::class, 'adminAllStudent'])->name("admin.allStudents");
    Route::get('/admin/students/add', [StudentController::class, 'adminAddStudent'])->name("admin.addStudent");
    Route::post('/admin/students/add', [StudentController::class, 'adminStoreStudent'])->name("admin.students.store");
    Route::get('/admin/students/edit/{id}', [StudentController::class, 'adminEditStudent'])->name('admin.editStudent');
    Route::put('/admin/students/update/{id}', [StudentController::class, 'adminUpdateStudent'])->name('admin.students.update');
    Route::delete('/admin/students/delete/{id}', [StudentController::class, 'adminDestroyStudent'])->name('admin.deleteStudent');

    // Admin-Instructor Routes
    Route::get('/admin/instructors/', [InstructorController::class, 'adminAllInstructors'])->name("admin.allInstructors");
    Route::get('/admin/instructors/add', [InstructorController::class, 'adminAddInstructor'])->name("admin.addInstructor");
    Route::post('/admin/instructors/add', [InstructorController::class, 'adminStoreInstructor'])->name("admin.instructors.store");
    Route::get('/admin/instructors/edit/{id}', [InstructorController::class, 'adminEditInstructor'])->name('admin.editInstructor');
    Route::put('/admin/instructors/update/{id}', [InstructorController::class, 'adminUpdateInstructor'])->name('admin.updateInstructor');
    Route::delete('/admin/instructors/delete/{id}', [InstructorController::class, 'adminDestroyInstructor'])->name('admin.deleteInstructor');

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
    Route::put('/admin/courses/{id}', [CoursesController::class, 'updateCourse'])->name('admin.updateCourse');
    Route::get('/admin/courses/delete/{id}', [CoursesController::class, 'deleteCourse'])->name('admin.deleteCourse');

    // Admin - Attendance Routes
    // Student Attendance Routes
    Route::get('/admin/student/attendance', [AttendanceController::class, 'showStudentAttendance'])->name('student.attendance.show');
    Route::get('/admin/student/attendance/mark/{date}', [AttendanceController::class, 'markTodayStudentAttendance'])->name('student.attendance.mark');
    Route::post('/admin/student/attendance/store', [AttendanceController::class, 'storeStudentAttendance'])->name('student.attendance.store');
    Route::get('/admin/student/attendance/update', [AttendanceController::class, 'showAndUpdateStudentAttendance'])->name('student.attendance.update');
    Route::post('/admin/student/attendance/store-update', [AttendanceController::class, 'storeUpdatedStudentAttendance'])->name('student.attendance.store.update');

    // Instructor Attendance Routes
    // Display the instructor attendance
    Route::get('/admin/instructors/attendance', [AttendanceController::class, 'showInstructorAttendance'])->name('instructor.attendance.show');
    Route::get('/admin/instructors/attendance/mark/{date}', [AttendanceController::class, 'markTodayInstructorAttendance'])->name('instructor.attendance.mark');
    Route::post('/admin/instructors/attendance/store', [AttendanceController::class, 'storeInstructorAttendance'])->name('instructor.attendance.store');
    Route::get('/admin/instructors/attendance/update', [AttendanceController::class, 'showAndUpdateInstructorAttendance'])->name('instructor.attendance.update');
    Route::post('/admin/instructors/attendance/store-update', [AttendanceController::class, 'storeUpdatedInstructorAttendance'])->name('instructor.attendance.store.update');

    // Admin Coupons Routes
    Route::get('/admin/coupons', [CouponController::class, 'allCouponsPage'])->name('admin.allCoupons');
    Route::get('/admin/coupons/create', [CouponController::class, 'addCoupons'])->name('admin.addCoupons');
    Route::post('/admin/coupons/add', [CouponController::class, 'storeCoupons'])->name('admin.coupons.store');
    Route::get('/admin/coupons/edit/{id}', [CouponController::class, 'editCoupons'])->name('admin.editCoupon');
    Route::put('/admin/coupons/{id}', [CouponController::class, 'update'])->name('admin.coupons.update');
    Route::get('/admin/coupons/delete/{id}', [CouponController::class, 'destroy'])->name('admin.deleteCoupons');

    // Admin Cars
    Route::get('/admin/cars', [CarController::class, 'allCarsPage'])->name('admin.allCars');
    Route::post('/admin/cars/add', [CarController::class, 'storeCars'])->name('admin.cars.store');
    Route::put('/admin/cars/{id}', [CarController::class, 'update'])->name('admin.updateCar');
    Route::get('/admin/cars/delete/{id}', [CarController::class, 'destroy'])->name('admin.deleteCars');

    // Admin Car Models
    Route::get('/admin/car-models', [CarModelController::class, 'allCarModelsPage'])->name('admin.allCarModels');
    Route::post('/admin/car-models/add', [CarModelController::class, 'storeCarModel'])->name('admin.carModels.store');
    Route::put('/admin/car-models/{id}', [CarModelController::class, 'updateCarModel'])->name('admin.updateCarModel');
    Route::get('/admin/car-models/delete/{id}', [CarModelController::class, 'deleteCarModel'])->name('admin.deleteCarModel');


    // Fixed Expenses Routes
    Route::get('/admin/expense/fixed', [FixedExpenseController::class, 'index'])->name('admin.fixedExpenses');
    Route::get('/admin/expense/fixed/create', [FixedExpenseController::class, 'create'])->name('admin.fixedExpenses.create');
    Route::post('/admin/expense/fixed/store', [FixedExpenseController::class, 'store'])->name('admin.fixedExpenses.store');
    Route::get('/admin/expense/fixed/edit/{id}', [FixedExpenseController::class, 'edit'])->name('admin.fixedExpenses.edit');
    Route::put('/admin/expense/fixed/update/{id}', [FixedExpenseController::class, 'update'])->name('admin.fixedExpenses.update');
    Route::delete('/admin/expense/fixed/delete/{id}', [FixedExpenseController::class, 'destroy'])->name('admin.fixedExpenses.delete');

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
    Route::get('/admin/leaves', [LeaveController::class, 'adminallLeaves'])->name('admin.allLeaves');
    Route::post('update-leave-status', [LeaveController::class, 'adminupdateLeaveStatus'])->name('admin.updateLeaveStatus');

    // Admin-Schedules
    Route::get('/admin/schedule/create', [ScheduleController::class, 'createSchedule'])->name('admin.createSchedule');
    Route::post('/admin/schedule/store', [ScheduleController::class, 'storeSchedule'])->name('admin.storeSchedule');
    Route::get('/admin/schedules', [ScheduleController::class, 'allSchedules'])->name('admin.allSchedules');
    Route::get('/admin/schedules/booked-times', [ScheduleController::class, 'getBookedTimes'])->name('schedules.booked-times');
    Route::post('/admin/schedule/pause/{student}', [ScheduleController::class, 'pauseStudentSchedule'])->name('admin.pauseStudentSchedule');


    Route::get('/invoices', [InvoiceController::class, 'index'])->name("admin.allInvoices");
    Route::get('/invoices/{id}', [InvoiceController::class, 'show'])->name('invoice.show');

    // Branch Routes
    Route::get('/admin/branch', [BranchController::class, 'adminindex'])->name('admin.allBranches');
    Route::post('/admin/branch/store', [BranchController::class, 'store'])->name('admin.branches.store');
    Route::get('/admin/branch/edit/{id}', [BranchController::class, 'edit'])->name('admin.branches.edit');
    Route::put('/admin/branch/update/{id}', [BranchController::class, 'update'])->name('admin.branches.update');
    Route::delete('/admin/branch/delete/{id}', [BranchController::class, 'destroy'])->name('admin.branches.delete');
});

// Instructor Routes
Route::middleware(['role:instructor'])->group(function () {
    Route::get('/instructor/dashboard', [InstructorController::class, 'index'])->name('instructor.dashboard');
    Route::get('/instructor/schedules', [ScheduleController::class, 'instructorSchedules'])->name('instructor.schedules');
    Route::get('/instructor/students', [StudentController::class, 'instructorStudents'])->name('instructor.students');

    // Instructor Leave Routes
    Route::get('/instructor/leaves', [LeaveController::class, 'all_leaves_instructor'])->name('instructor.allLeaves');
    Route::get('/instructor/leaves/create', [LeaveController::class, 'addLeavesInstructor'])->name('instructor.addLeaves');
    Route::post('/instructor/leaves/add', [LeaveController::class, 'storeLeavesInstructor'])->name('instructor.leaves.store');
    Route::get('/instructor/leaves/edit/{leave}', [LeaveController::class, 'editLeaveInstructor'])->name('instructor.editLeave');
    Route::put('/instructor/leaves/{leave}', [LeaveController::class, 'updateLeaveInstructor'])->name('instructor.updateLeave');
    Route::delete('/instructor/leaves/delete/{leave}', [LeaveController::class, 'destroyInstructorLeave'])->name('instructor.deleteLeave');

    Route::get('/instructor/student/attendance', [AttendanceController::class, 'showInstructorStudentAttendance'])->name('instructor.student.attendance.show');
    Route::get('/instructor/student/attendance/mark/{date}', [AttendanceController::class, 'markTodayInstructorStudentAttendance'])->name('instructor.student.attendance.mark');
    Route::post('/instructor/student/attendance/store', [AttendanceController::class, 'storeInstructorStudentAttendance'])->name('instructor.student.attendance.store');
});

// Student Routes
Route::middleware(['role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'index'])->name('student.dashboard');
    Route::get('/student/schedules', [ScheduleController::class, 'studentSchedules'])->name('student.schedules');
    Route::get('/student/certificate', [CertificateController::class, 'index'])->name('student.certificate');
    Route::get('/download-certificate', [CertificateController::class, 'downloadCertificate'])->name('download.certificate');

    // Student Leave Routes
    Route::get('/student/leaves', [LeaveController::class, 'all_leaves_student'])->name('student.allLeaves');
    Route::get('/student/leaves/create', [LeaveController::class, 'addLeavesStudent'])->name('student.addLeaves');
    Route::post('/student/leaves/add', [LeaveController::class, 'storeLeavesStudent'])->name('student.leaves.store');
    Route::get('/student/leaves/edit/{leave}', [LeaveController::class, 'editLeaveStudent'])->name('student.editLeave');
    Route::put('/student/leaves/{leave}', [LeaveController::class, 'updateLeaveStudent'])->name('student.updateLeave');
    Route::delete('/student/leaves/delete/{leave}', [LeaveController::class, 'destroyStudentLeave'])->name('student.deleteLeave');
});

// Manager Routes
Route::middleware(['role:manager'])->group(function () {
    Route::get('/manager/dashboard', [ManagerController::class, 'index'])->name('manager.dashboard');
});



    // Route::get('/send-whatsapp', function () {
    //     $phoneNumberId = '467611526431527'; // Your Phone Number ID
    //     $recipientPhoneNumber = '+923165507654'; // The phone number to send the message to
    //     $accessToken = 'EAAXhcL58v6MBO6Ox0Y9p8CtkvF2JUo5sEoYBaXvGTCrucJSKP7ZADtPnzlECFpdWFrdTz1vgZBOIRrtkD1nHTE1diWkQL4ZCnc00xbbJw651jAnt6XpSZAbHsiR9ksntGENihQOPBoYt6Sv0JIjKF06h9fkh1ih1U9hNkvVJ51tYokA5K2E1e4kKVc3kRdWibHHlVnM0reL1ZC7zzZB3iMeAcABtm0yzB375tmiQyTUZAgZD'; // Replace with your valid access token
    //     $message = 'Hello KK';

    //     // Create a Guzzle HTTP client instance
    //     $client = new Client();

    //     try {
    //         // Send the message to the recipient
    //         $response = $client->post("https://graph.facebook.com/v16.0/{$phoneNumberId}/messages", [
    //             'headers' => [
    //                 'Authorization' => "Bearer {$accessToken}",
    //                 'Content-Type' => 'application/json',
    //             ],
    //             'json' => [
    //                 'messaging_product' => 'whatsapp',
    //                 'to' => $recipientPhoneNumber,
    //                 'type' => 'text',
    //                 'text' => [
    //                     'body' => $message,
    //                 ],
    //             ],
    //         ]);

    //         // Return success response
    //         return response()->json([
    //             'status' => 'success',
    //             'message' => "Message sent successfully to {$recipientPhoneNumber}.",
    //             'response' => json_decode($response->getBody(), true),
    //         ]);
    //     } catch (\Exception $e) {
    //         // Return error response
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => $e->getMessage(),
    //         ]);
    //     }
    // });


    // Route::get('/send-whatsapp', function () {
    //     $phoneNumberId = '467611526431527'; // Your Phone Number ID
    //     $recipientPhoneNumber = '+923165507654'; // The phone number to send the message to
    //     $accessToken = 'EAAXhcL58v6MBO6Ox0Y9p8CtkvF2JUo5sEoYBaXvGTCrucJSKP7ZADtPnzlECFpdWFrdTz1vgZBOIRrtkD1nHTE1diWkQL4ZCnc00xbbJw651jAnt6XpSZAbHsiR9ksntGENihQOPBoYt6Sv0JIjKF06h9fkh1ih1U9hNkvVJ51tYokA5K2E1e4kKVc3kRdWibHHlVnM0reL1ZC7zzZB3iMeAcABtm0yzB375tmiQyTUZAgZD'; // Replace with your valid access token
    //     $message = 'Hello KK';

    //     // Create a Guzzle HTTP client instance
    //     $client = new Client();

    //     try {
    //         // Send the message to the recipient
    //         $response = $client->post("https://graph.facebook.com/v16.0/{$phoneNumberId}/messages", [
    //             'headers' => [
    //                 'Authorization' => "Bearer {$accessToken}",
    //                 'Content-Type' => 'application/json',
    //             ],
    //             'json' => [
    //                 'messaging_product' => 'whatsapp',
    //                 'to' => $recipientPhoneNumber,
    //                 'type' => 'text',
    //                 'text' => [
    //                     'body' => $message,
    //                 ],
    //             ],
    //         ]);

    //         // Return success response
    //         return response()->json([
    //             'status' => 'success',
    //             'message' => "Message sent successfully to {$recipientPhoneNumber}.",
    //             'response' => json_decode($response->getBody(), true),
    //         ]);
    //     } catch (\Exception $e) {
    //         // Return error response
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => $e->getMessage(),
    //         ]);
    //     }
    // });
