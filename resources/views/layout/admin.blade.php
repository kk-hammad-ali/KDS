<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>King Driving School - Admin</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link href="img/favicon.ico" rel="icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('imgs/logo.jpg') }}" type="image/x-icon">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet"
        href="https://unpkg.com/bs-brain@2.0.4/components/calendars/calendar-1/assets/css/calendar-1.css">

    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="{{ route('admin.dashboard') }}" class="navbar-brand mx-4 mb-3">
                    <h5 class="text-primary">King Driving School</h5>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="{{ asset('img/22.png') }}" alt=""
                            style="width: 50px; height: 50px;">
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Fahad</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-item nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <i class="fa fa-tachometer-alt me-2"></i>Dashboard
                    </a>

                    <a href="{{ route('admin.allAdmissionForm') }}"
                        class="nav-item nav-link {{ Request::is('admin/admission-form*') ? 'active' : '' }}">
                        <i class="fa fa-file-alt me-2"></i>Admission
                    </a>


                    <a href="{{ route('admin.allStudents') }}"
                        class="nav-item nav-link {{ Request::is('admin/students*') ? 'active' : '' }}">
                        <i class="fa fa-users me-2"></i>Student
                    </a>

                    <a href="{{ route('admin.allInstructors') }}"
                        class="nav-item nav-link {{ Request::is('admin/instructors*') ? 'active' : '' }}">
                        <i class="fa fa-user me-2"></i>Instructor
                    </a>

                    <a href="{{ route('admin.allCourses') }}"
                        class="nav-item nav-link {{ Request::is('admin/courses*') ? 'active' : '' }}">
                        <i class="fa fa-book me-2"></i>Courses
                    </a>

                    <a href="{{ route('admin.allInvoices') }}"
                        class="nav-item nav-link {{ Request::is('admin/invoices') ? 'active' : '' }}">
                        <i class="fa fa-file-invoice me-2"></i>Invoices
                    </a>

                    <div class="nav-item dropdown">
                        <a href="#"
                            class="nav-link dropdown-toggle {{ Request::is('admin/attendance*') ? 'active' : '' }}"
                            data-bs-toggle="dropdown">
                            <i class="fa fa-calendar-check me-2"></i>Attendance
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('student.attendance.show') }}"
                                class="dropdown-item {{ Request::is('admin/attendance/student*') ? 'active' : '' }}">
                                <i class="ms-4 fa fa-user-graduate me-2"></i>Student
                            </a>
                            <a href="{{ route('instructor.attendance.show') }}"
                                class="dropdown-item {{ Request::is('admin/attendance/instructor*') ? 'active' : '' }}">
                                <i class="ms-4 fa fa-chalkboard-teacher me-2"></i>Instructor
                            </a>
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#"
                            class="nav-link dropdown-toggle {{ Request::is('admin/expense*') ? 'active' : '' }}"
                            data-bs-toggle="dropdown">
                            <i class="fa fa-book me-2"></i>Expense
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('admin.fixedExpenses') }}"
                                class="dropdown-item {{ Request::is('admin/expense/fixed*') ? 'active' : '' }}">
                                <i class="ms-4 fa fa-file-invoice-dollar me-2"></i>Fixed Expense
                            </a>
                            <a href="{{ route('admin.carExpenses') }}"
                                class="dropdown-item {{ Request::is('admin/expense/car*') ? 'active' : '' }}">
                                <i class="ms-4 fa fa-car me-2"></i>Car
                            </a>
                            <a href="{{ route('admin.dailyExpenses') }}"
                                class="dropdown-item {{ Request::is('admin/expense/daily*') ? 'active' : '' }}">
                                <i class="ms-4 fa fa-calendar-day me-2"></i>Daily
                            </a>
                        </div>
                    </div>


                    <a href="{{ route('admin.allSchedules') }}"
                        class="nav-item nav-link {{ Request::is('admin/schedules*') ? 'active' : '' }}">
                        <i class="fa fa-calendar me-2"></i>Class Schedule
                    </a>

                    <a href="{{ route('admin.allLeaves') }}"
                        class="nav-item nav-link {{ Request::is('admin/leaves*') ? 'active' : '' }}">
                        <i class="fa fa-calendar-check me-2"></i>Leave
                    </a>

                    <a href="{{ route('admin.allCars') }}"
                        class="nav-item nav-link {{ Request::is('admin/cars*') ? 'active' : '' }}">
                        <i class="fa fa-car me-2"></i>Cars
                    </a>
                    <a href="#" class="nav-item nav-link {{ Request::is('feedback*') ? 'active' : '' }}"><i
                            class="fa fa-comment me-2"></i>Feedback</a>

                    <a href="{{ route('admin.allEmployees') }}"
                        class="nav-item nav-link {{ Request::is('employee*') ? 'active' : '' }}"><i
                            class="fa fa-tags me-2"></i>Employee</a>

                    <a href="{{ route('admin.allCoupons') }}"
                        class="nav-item nav-link {{ Request::is('admin/allCoupons') ? 'active' : '' }}"><i
                            class="fa fa-ticket-alt me-2"></i>Coupons</a>

                    <a href="{{ route('admin.allContact') }}"
                        class="nav-item nav-link {{ Request::is('admin/contact') ? 'active' : '' }}">
                        <i class="fa fa-envelope me-2"></i>Inquiries
                    </a>

                </div>
            </nav>
        </div>

        <div class="content">
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="{{ route('admin.dashboard') }}" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notification</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6 <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="{{ asset('img/22.png') }}" alt=""
                                style="width: 50px; height: 50px;">
                            <span class="d-none d-lg-inline-flex">Fahad</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                data-bs-target="#logoutModal">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>

            @yield('page_content')

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">King Driving School</a>, All Right Reserved.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
            <i class="bi bi-arrow-up"></i>
        </a>
    </div>


    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Ready to Leave?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Select "Logout" below if you are ready to end your current session.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="{{ route('admin.logout') }}" class="btn btn-primary">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.9/index.global.min.js"></script>
    <script src="https://unpkg.com/bs-brain@2.0.4/components/calendars/calendar-1/assets/controller/calendar-1.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
