<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>King Driving School | Admin Panel</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}">
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

    <!-- Custom CSS for Mobile View -->
    <style>
        /* Hide the navbar links on small screens (max-width: 767px) */
        @media (max-width: 767px) {
            .top-navbar .sidebar-menu__link {
                display: none;
            }
        }

        /* Show the links in the sidebar on mobile */
        @media (max-width: 767px) {
            .sidebar-menu__item.d-lg-none {
                display: block;
            }
        }

        /* Hide the sidebar links on larger screens to avoid duplication */
        @media (min-width: 768px) {
            .sidebar-menu__item.d-lg-none {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!--==================== Preloader Start ====================-->
    <div class="preloader">
        <div class="loader"></div>
    </div>
    <!--==================== Preloader End ====================-->

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
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-squares-four"></i></span>
                            <span class="text">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-menu__item">
                        <a href="{{ route('admin.allStudents') }}" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-users-three"></i></span>
                            <span class="text">Students</span>
                        </a>
                    </li>
                    <li class="sidebar-menu__item">
                        <a href="{{ route('admin.allInstructors') }}" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-users"></i></span>
                            <span class="text">Instructors</span>
                        </a>
                    </li>
                    <li class="sidebar-menu__item">
                        <a href="{{ route('admin.allCourses') }}" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-book"></i></span>
                            <span class="text">Courses</span>
                        </a>
                    </li>
                    <li class="sidebar-menu__item has-dropdown">
                        <a href="javascript:void(0)" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-calendar-check"></i></span>
                            <span class="text">Attendance</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li class="sidebar-submenu__item">
                                <a href="{{ route('student.attendance.show') }}" class="sidebar-submenu__link">Student
                                    Attendance</a>
                            </li>
                            <li class="sidebar-submenu__item">
                                <a href="{{ route('instructor.attendance.show') }}"
                                    class="sidebar-submenu__link">Instructor Attendance</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-menu__item has-dropdown">
                        <a href="javascript:void(0)" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-coins"></i></span>
                            <span class="text">Expenses</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li class="sidebar-submenu__item">
                                <a href="{{ route('admin.fixedExpenses') }}" class="sidebar-submenu__link">Fixed
                                    Expenses</a>
                            </li>
                            <li class="sidebar-submenu__item">
                                <a href="{{ route('admin.carExpenses') }}" class="sidebar-submenu__link">Car
                                    Expenses</a>
                            </li>
                            <li class="sidebar-submenu__item">
                                <a href="{{ route('admin.dailyExpenses') }}" class="sidebar-submenu__link">Daily
                                    Expenses</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-menu__item">
                        <a href="{{ route('admin.allSchedules') }}" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-calendar"></i></span>
                            <span class="text">Class Schedule</span>
                        </a>
                    </li>
                    <li class="sidebar-menu__item">
                        <a href="{{ route('admin.allLeaves') }}" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-calendar-plus"></i></span>
                            <span class="text">Leaves</span>
                        </a>
                    </li>
                    <li class="sidebar-menu__item">
                        <a href="{{ route('admin.allCars') }}" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-car"></i></span>
                            <span class="text">Cars</span>
                        </a>
                    </li>
                    <li class="sidebar-menu__item">
                        <a href="{{ route('admin.allEmployees') }}" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-user"></i></span>
                            <span class="text">Employees</span>
                        </a>
                    </li>

                    <!-- Sidebar links for mobile view -->
                    <li class="sidebar-menu__item d-lg-none">
                        <a href="{{ route('admin.allAdmissionForm') }}" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-file-text"></i></span>
                            <span class="text">Admission</span>
                        </a>
                    </li>
                    <li class="sidebar-menu__item d-lg-none">
                        <a href="{{ route('admin.allInvoices') }}" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-receipt"></i></span>
                            <span class="text">Invoices</span>
                        </a>
                    </li>
                    <li class="sidebar-menu__item d-lg-none">
                        <a href="{{ route('admin.allContact') }}" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-envelope"></i></span>
                            <span class="text">Inquiries</span>
                        </a>
                    </li>

                    <a href="{{ route('admin.allCoupons') }}" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-ticket"></i></span>
                        <span class="text">Coupons</span>
                    </a>
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

                <!-- Links in Navbar for Desktop View -->
                <a href="{{ route('admin.allAdmissionForm') }}" class="sidebar-menu__link">
                    <span class="icon"><i class="ph ph-file-text"></i></span>
                    <span class="text">Admission</span>
                </a>
                <a href="{{ route('admin.allInvoices') }}" class="sidebar-menu__link">
                    <span class="icon"><i class="ph ph-receipt"></i></span>
                    <span class="text">Invoices</span>
                </a>
                <a href="{{ route('admin.allContact') }}" class="sidebar-menu__link">
                    <span class="icon"><i class="ph ph-envelope"></i></span>
                    <span class="text">Inquiries</span>
                </a>
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
                                        <p class="fw-medium text-13 text-gray-200">Admin</p>
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
                    <a href="#"
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
                        Select "Logout" below if you are ready to end your current session.
                    </div>
                    <div class="modal-footer">
                        <!-- Cancel Button -->
                        <div class="flex-align justify-content-end gap-8 mt-4">
                            <button type="button" class="btn btn-main rounded-pill py-9"
                                data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <!-- Logout Link -->
                        <div class="flex-align justify-content-end gap-8 mt-4">
                            <a href="{{ route('admin.logout') }}" class="btn btn-main rounded-pill py-9">Logout</a>
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

    <script>
        function createChart(chartId, chartColor) {

            let currentYear = new Date().getFullYear();

            var options = {
                series: [{
                    name: 'series1',
                    data: [18, 25, 22, 40, 34, 55, 50, 60, 55, 65],
                }],
                chart: {
                    type: 'area',
                    width: 80,
                    height: 42,
                    sparkline: {
                        enabled: true // Remove whitespace
                    },
                    toolbar: {
                        show: false
                    },
                    padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: 0
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 1,
                    colors: [chartColor],
                    lineCap: 'round'
                },
                grid: {
                    show: true,
                    borderColor: 'transparent',
                    strokeDashArray: 0,
                    position: 'back',
                    xaxis: {
                        lines: {
                            show: false
                        }
                    },
                    yaxis: {
                        lines: {
                            show: false
                        }
                    },
                    row: {
                        colors: undefined,
                        opacity: 0.5
                    },
                    column: {
                        colors: undefined,
                        opacity: 0.5
                    },
                    padding: {
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: 0
                    },
                },
                fill: {
                    type: 'gradient',
                    colors: [chartColor], // Set the starting color (top color) here
                    gradient: {
                        shade: 'light',
                        type: 'vertical',
                        shadeIntensity: 0.5,
                        gradientToColors: [`${chartColor}00`],
                        inverseColors: false,
                        opacityFrom: .5,
                        opacityTo: 0.3,
                        stops: [0, 100],
                    },
                },
                markers: {
                    colors: [chartColor],
                    strokeWidth: 2,
                    size: 0,
                    hover: {
                        size: 8
                    }
                },
                xaxis: {
                    labels: {
                        show: false
                    },
                    categories: [`Jan ${currentYear}`, `Feb ${currentYear}`, `Mar ${currentYear}`, `Apr ${currentYear}`,
                        `May ${currentYear}`, `Jun ${currentYear}`, `Jul ${currentYear}`, `Aug ${currentYear}`,
                        `Sep ${currentYear}`, `Oct ${currentYear}`, `Nov ${currentYear}`, `Dec ${currentYear}`
                    ],
                    tooltip: {
                        enabled: false,
                    },
                },
                yaxis: {
                    labels: {
                        show: false
                    }
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                },
            };

            var chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
            chart.render();
        }

        // Call the function for each chart with the desired ID and color
        createChart('students-count', '#2FB2AB');
        createChart('instructors-count', '#27CFA7');
        createChart('cars-count', '#6142FF');
        createChart('today-expense', '#FA902F');
        createChart('yearly-expense', '#FF4A4A');
        createChart('monthly-expense', '#FFBC42');
        createChart('submitted-forms-count', '#6BCEFF');
        createChart('todays-classes-count', '#AA47BC');
        createChart('daily-sales', '#FF5733');
        createChart('monthly-sales', '#33FF57');
        createChart('yearly-sales', '#3357FF');

        // =========================== Single Line Chart End ===============================

        // =========================== Double Line Chart Start ===============================
        function createLineChart(chartId, monthlyExpenseData, monthlySalesData) {
            var options = {
                series: [{
                        name: 'Expenses',
                        data: monthlyExpenseData, // Use real expense data
                    },
                    {
                        name: 'Sales',
                        data: monthlySalesData, // Use real sales data
                    },
                ],
                chart: {
                    type: 'area',
                    width: '100%',
                    height: 300,
                    sparkline: {
                        enabled: false
                    },
                    toolbar: {
                        show: false
                    },
                    dropShadow: {
                        enabled: true,
                        color: '#000',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.2
                    },
                },
                colors: ['#3D7FF9', '#27CFA7'], // Colors for expenses and sales
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.5,
                        opacityTo: 0.1,
                        stops: [0, 90, 100]
                    }
                },
                grid: {
                    show: true,
                    borderColor: '#E6E6E6',
                    strokeDashArray: 3,
                },
                markers: {
                    size: 5,
                    colors: ['#3D7FF9', '#27CFA7'],
                    strokeWidth: 2,
                    hover: {
                        size: 8
                    }
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    labels: {
                        style: {
                            fontSize: "14px",
                        },
                    },
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                },
                yaxis: {
                    labels: {
                        formatter: function(value) {
                            return Math.round(value / 1000) + "K"; // Convert to K
                        },
                        style: {
                            fontSize: "10px"
                        }
                    },
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                },
                tooltip: {
                    theme: 'light',
                    marker: {
                        show: true,
                    },
                    x: {
                        show: true
                    },
                    y: {
                        formatter: function(value) {
                            return "RS " + Math.round(value / 1000) + "K"; // Format the tooltip
                        },
                    }
                },
                legend: {
                    show: true,
                    position: 'top',
                    horizontalAlign: 'right',
                    offsetX: -10,
                },
            };

            var chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
            chart.render();
        }

        // Call the function to render the chart using real data
        createLineChart('doubleLineChart', monthlyExpenseData, monthlySalesData);

        // =========================== Double Line Chart End ===============================


        // ================================= Multiple Radial Bar Chart Start =============================
        var options = {
            series: [100, 60, 25],
            chart: {
                height: 172,
                type: 'radialBar',
            },
            colors: ['#3D7FF9', '#27CFA7', '#020203'],
            stroke: {
                lineCap: 'round',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '30%', // Adjust this value to control the bar width
                    },
                    dataLabels: {
                        name: {
                            fontSize: '16px',
                        },
                        value: {
                            fontSize: '16px',
                        },
                        total: {
                            show: true,
                            formatter: function(w) {
                                return '82%'
                            }
                        }
                    }
                }
            },
            labels: ['Completed', 'In Progress', 'Not Started'],
        };

        var chart = new ApexCharts(document.querySelector("#radialMultipleBar"), options);
        chart.render();
        // ================================= Multiple Radial Bar Chart End =============================

        // ========================== Export Js Start ==============================
        document.getElementById('exportOptions').addEventListener('change', function() {
            const format = this.value;
            const table = document.getElementById('studentTable');
            let data = [];
            const headers = [];

            // Get the table headers
            table.querySelectorAll('thead th').forEach(th => {
                headers.push(th.innerText.trim());
            });

            // Get the table rows
            table.querySelectorAll('tbody tr').forEach(tr => {
                const row = {};
                tr.querySelectorAll('td').forEach((td, index) => {
                    row[headers[index]] = td.innerText.trim();
                });
                data.push(row);
            });

            if (format === 'csv') {
                downloadCSV(data);
            } else if (format === 'json') {
                downloadJSON(data);
            }
        });

        function downloadCSV(data) {
            const csv = data.map(row => Object.values(row).join(',')).join('\n');
            const blob = new Blob([csv], {
                type: 'text/csv'
            });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'students.csv';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }

        function downloadJSON(data) {
            const json = JSON.stringify(data, null, 2);
            const blob = new Blob([json], {
                type: 'application/json'
            });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'students.json';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }
        // ========================== Export Js End ==============================
    </script>

</body>

</html>
