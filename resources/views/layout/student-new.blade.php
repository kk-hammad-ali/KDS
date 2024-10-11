<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>King Driving School | Admin Panel</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('public/images/logo.png') }}" type="image/png">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- File Upload -->
    <link rel="stylesheet" href="{{ asset('assets/css/file-upload.css') }}">
    <!-- Plyr -->
    <link rel="stylesheet" href="{{ asset('assets/css/plyr.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <!-- Full Calendar -->
    <link rel="stylesheet" href="{{ asset('assets/css/full-calendar.css') }}">
    <!-- jQuery UI -->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">
    <!-- Editor Quill UI -->
    <link rel="stylesheet" href="{{ asset('assets/css/editor-quill.css') }}">
    <!-- Apex Charts -->
    <link rel="stylesheet" href="{{ asset('assets/css/apexcharts.css') }}">
    <!-- Calendar CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/calendar.css') }}">
    <!-- jVector Map CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-jvectormap-2.0.5.css') }}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>

<body>

    <!--==================== Sidebar Overlay End ====================-->
    <div class="side-overlay"></div>
    <!--==================== Sidebar Overlay End ====================-->

    <!-- ============================ Sidebar Start ============================ -->
    <aside class="sidebar">
        <!-- sidebar close btn -->
        <button type="button"
            class="sidebar-close-btn text-gray-500 hover-text-white hover-bg-main-600 text-md w-24 h-24 border border-gray-100 hover-border-main-600 d-xl-none d-flex flex-center rounded-circle position-absolute">
            <i class="ph ph-x"></i></button>

        <!-- Logo -->
        <a href="index.html"
            class="sidebar__logo text-center p-20 position-sticky inset-block-start-0 bg-white w-100 z-1 pb-10">
            <img src="{{ asset('public/images/logo.png') }}" alt="Logo" style="width: 50px;">
        </a>

        <div class="sidebar-menu-wrapper overflow-y-auto scroll-sm">
            <div class="p-20 pt-10">
                <ul class="sidebar-menu">
                    <li class="sidebar-menu__item">
                        <a href="{{ route('student.dashboard') }}" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-squares-four"></i></span>
                            <span class="text">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-menu__item">
                        <a href="{{ route('download.certificate') }}" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-book"></i></span>
                            <span class="text">Certificate</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </aside>
    <!-- ============================ Sidebar End  ============================ -->

    <div class="dashboard-main-wrapper">
        <div class="top-navbar flex-between gap-16">
            <div class="flex-align gap-16">
                <!-- Toggle Button Start -->
                <button type="button" class="toggle-btn d-xl-none d-flex text-26 text-gray-500"><i
                        class="ph ph-list"></i></button>
                <!-- Toggle Button End -->

            </div>
            <div class="flex-align gap-16">
                <div class="flex-align gap-8">
                    <!-- Notification Start -->
                    <div class="dropdown">
                        <button
                            class="dropdown-btn shaking-animation text-gray-500 w-40 h-40 bg-main-50 hover-bg-main-100 transition-2 rounded-circle text-xl flex-center"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="position-relative">
                                <i class="ph ph-bell"></i>
                                <span class="alarm-notify position-absolute end-0"></span>
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu--lg border-0 bg-transparent p-0">
                            <div class="card border border-gray-100 rounded-12 box-shadow-custom p-0 overflow-hidden">
                                <div class="card-body p-0">
                                    <div class="py-8 px-24 bg-main-600">
                                        <div class="flex-between">
                                            <h5 class="text-xl fw-semibold text-white mb-0">Notifications</h5>
                                            <div class="flex-align gap-12">
                                                <button type="button"
                                                    class="bg-white rounded-6 text-sm px-8 py-2 hover-text-primary-600">
                                                    New </button>
                                                <button type="button"
                                                    class="close-dropdown hover-scale-1 text-xl text-white"><i
                                                        class="ph ph-x"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-24 max-h-270 overflow-y-auto scroll-sm">
                                        <div class="d-flex align-items-start gap-12">
                                            <img src="{{ asset('assets/images/thumbs/notification-img2.png') }}"
                                                alt="" class="w-48 h-48 rounded-circle object-fit-cover">
                                            <div class="">
                                                <a href="#"
                                                    class="fw-medium text-15 mb-0 text-gray-300 hover-text-main-600 text-line-2">Patrick
                                                    added a comment on Design Assets - Smart Tags file:</a>
                                                <span class="text-gray-200 text-13">2 mins ago</span>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#"
                                        class="py-13 px-24 fw-bold text-center d-block text-primary-600 border-top border-gray-100 hover-text-decoration-underline">
                                        View All </a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Notification Start -->
                </div>

                <!-- User Profile Start -->
                <div class="dropdown">
                    <button
                        class="users arrow-down-icon border border-gray-200 rounded-pill p-4 d-inline-block pe-40 position-relative"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="position-relative">
                            <img src="{{ asset('assets/images/thumbs/user-img.png') }}" alt="Image"
                                class="h-32 w-32 rounded-circle">
                            <span
                                class="activation-badge w-8 h-8 position-absolute inset-block-end-0 inset-inline-end-0"></span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu--lg border-0 bg-transparent p-0">
                        <div class="card border border-gray-100 rounded-12 box-shadow-custom">
                            <div class="card-body">
                                <div class="flex-align gap-8 mb-20 pb-20 border-bottom border-gray-100">
                                    <img src="{{ asset('assets/images/thumbs/user-img.png') }}" alt=""
                                        class="w-54 h-54 rounded-circle">
                                    <div class="">
                                        <h4 class="mb-0">{{ auth()->user()->name }}</h4>
                                        <p class="fw-medium text-13 text-gray-200">Student</p>
                                    </div>
                                </div>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal"
                                    class="py-12 text-15 px-20 hover-bg-danger-50 text-gray-300 hover-text-danger-600 rounded-8 flex-align gap-8 fw-medium text-15">
                                    <span class="text-2xl text-danger-600 d-flex"><i
                                            class="ph ph-sign-out"></i></span>
                                    <span class="text">Log Out</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @yield('content')

        <div class="dashboard-footer">
            <div class="flex-between flex-wrap gap-16">
                <p class="text-gray-300 text-13 fw-normal"> &copy; Copyright King Driving School 2024, All Right
                    Reserverd</p>
                <div class="flex-align flex-wrap gap-16">
                    <a href="https://www.goftechsolutions.com/" target="_blank"
                        class="text-gray-300 text-13 fw-normal hover-text-main-600 hover-text-decoration-underline">Developed
                        by GOFTECH</a>
                </div>
            </div>
        </div>

        <!-- Logout Modal -->
        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="logoutModalLabel">Ready to Leave?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure?
                    </div>
                    <div class="modal-footer">
                        <!-- Cancel Button -->
                        <div class="flex-align justify-content-end gap-8 mt-4">
                            <button type="button" class="btn btn-main rounded-pill py-9"
                                data-bs-dismiss="modal">Cancel</button>
                        </div>

                        <!-- Logout Link -->
                        <div class="flex-align justify-content-end gap-8 mt-4">
                            <a href="{{ route('student.logout') }}" class="btn btn-main rounded-pill py-9">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Jquery js -->
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <!-- Bootstrap Bundle Js -->
    <script src="{{ asset('assets\js\boostrap.bundle.min.js') }}"></script>
    <!-- Phosphor Js -->
    <script src="{{ asset('assets/js/phosphor-icon.js') }}"></script>
    <!-- File upload -->
    <script src="{{ asset('assets/js/file-upload.js') }}"></script>
    <!-- Plyr -->
    <script src="{{ asset('assets/js/plyr.js') }}"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <!-- Full Calendar -->
    <script src="{{ asset('assets/js/full-calendar.js') }}"></script>
    <!-- jQuery UI -->
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
    <!-- Editor Quill -->
    <script src="{{ asset('assets/js/editor-quill.js') }}"></script>
    <!-- Apex Charts -->
    <script src="{{ asset('assets/js/apexcharts.min.js') }}"></script>
    <!-- Calendar Js -->
    <script src="{{ asset('assets/js/calendar.js') }}"></script>
    <!-- jVectorMap -->
    <script src="{{ asset('assets/js/jquery-jvectormap-2.0.5.min.js') }}"></script>
    <!-- jVectorMap World -->
    <script src="{{ asset('assets/js/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- Main Js -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
