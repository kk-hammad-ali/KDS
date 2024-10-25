@extends('layout.layout')

@section('content')
    <div class="dashboard-body">
        <div class="row gy-4">

            <!-- Dummy Text to Test Branch Switch -->
            <div class="alert alert-info mt-3">
                @if (auth()->user()->current_branch_id && auth()->user()->currentBranch)
                    <strong>Current Branch:</strong> {{ auth()->user()->currentBranch->name }}
                @endif
            </div>

            <div class="row g-4">
                <!-- Total Students Card -->
                <div class="col-xxl-3 col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-2">{{ $totalStudentsCount }}</h4>
                            <span class="text-gray-600">Total Students</span>
                            <div class="flex-between gap-8 mt-16">
                                <span
                                    class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-600 text-white text-2xl">
                                    <i class="ph-fill ph-users"></i>
                                </span>
                                <div id="students-count" class="remove-tooltip-title rounded-tooltip-value">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Today's Classes Count -->
                <div class="col-xxl-3 col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-2">{{ $todaysClassesCount }}</h4>
                            <span class="text-gray-600">Today's Classes</span>
                            <div class="flex-between gap-8 mt-16">
                                <span
                                    class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-600 text-white text-2xl">
                                    <i class="ph-fill ph-calendar"></i>
                                </span>
                                <div id="todays-classes-count" class="remove-tooltip-title rounded-tooltip-value">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Today's Expense Card -->
                <div class="col-xxl-3 col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-2">{{ number_format($todayExpense, 2) }}</h4>
                            <span class="text-gray-600">Today's Expense</span>
                            <div class="flex-between gap-8 mt-16">
                                <span
                                    class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-600 text-white text-2xl">
                                    <i class="ph-fill ph-currency-dollar"></i>
                                </span>
                                <div id="today-expense" class="remove-tooltip-title rounded-tooltip-value">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Today's Sales Card -->
                <div class="col-xxl-3 col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-2">{{ number_format($todaySales, 2) }}</h4>
                            <span class="text-gray-600">Today's Sales</span>
                            <div class="flex-between gap-8 mt-16">
                                <span
                                    class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-500 text-white text-2xl">
                                    <i class="ph-fill ph-currency-dollar-simple"></i>
                                </span>
                                <div id="today-sales" class="remove-tooltip-title rounded-tooltip-value"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row gy-4">
            <div class="col-lg-9">
                <!-- Today's Classes Table -->
                <div class="card overflow-hidden mt-24 p-20">
                    <div class="card-body p-0 overflow-x-auto">
                        <h5 class="mb-20">Today's Classes</h5>
                        <table id="todaysClassesTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="h6 text-gray-300">#</th>
                                    <th class="h6 text-gray-300">Student</th>
                                    <th class="h6 text-gray-300">Instructor</th>
                                    <th class="h6 text-gray-300">Car</th>
                                    <th class="h6 text-gray-300">Pickup Address</th>
                                    <th class="h6 text-gray-300">Start Time</th>
                                    <th class="h6 text-gray-300">End Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todaysClasses as $class)
                                    <tr>
                                        <td>
                                            <span class="h6 mb-0 fw-medium text-gray-300">{{ $loop->iteration }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="h6 mb-0 fw-medium text-gray-300">{{ $class->student->user->name }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="h6 mb-0 fw-medium text-gray-300">{{ $class->instructor->employee->user->name }}</span>
                                        </td>
                                        <td>
                                            <span class="h6 mb-0 fw-medium text-gray-300">{{ $class->vehicle->make }}
                                                {{ $class->vehicle->model }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="h6 mb-0 fw-medium text-gray-300">{{ $class->student->address }}</span>
                                        </td>
                                        <td>
                                            <span class="h6 mb-0 fw-medium text-gray-300">{{ $class->start_time }}</span>
                                        </td>
                                        <td>
                                            <span class="h6 mb-0 fw-medium text-gray-300">{{ $class->end_time }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <!-- Calendar Start -->
                <div class="card mt-24">
                    <div class="card-body">
                        <div class="calendar">
                            <div class="calendar__header">
                                <button type="button" class="calendar__arrow left"><i
                                        class="ph ph-caret-left"></i></button>
                                <p class="display h6 mb-0">""</p>
                                <button type="button" class="calendar__arrow right"><i
                                        class="ph ph-caret-right"></i></button>
                            </div>

                            <div class="calendar__week week">
                                <div class="calendar__week-text">Su</div>
                                <div class="calendar__week-text">Mo</div>
                                <div class="calendar__week-text">Tu</div>
                                <div class="calendar__week-text">We</div>
                                <div class="calendar__week-text">Th</div>
                                <div class="calendar__week-text">Fr</div>
                                <div class="calendar__week-text">Sa</div>
                            </div>
                            <div class="days"></div>
                        </div>
                    </div>
                </div>
                <!-- Calendar End -->
            </div>
        </div>

        <div class="row gy-4 ">
            <div class="col-lg-12">
                <div class="card overflow-hidden mt-24 p-20">
                    <div class="card-body p-0 overflow-x-auto">
                        <h5 class="mb-20">Car Schedules for {{ $today }}</h5>
                        <div style="max-height: 500px; overflow-y: auto; overflow-x: scroll;">
                            <table id="carSchedulesTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="h6 text-gray-300">Car</th>
                                        @for ($i = 8; $i < 20; $i++)
                                            <th class="h6 text-gray-300">{{ $i }}:00</th>
                                            <th class="h6 text-gray-300">{{ $i }}:30</th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carSchedules as $carSchedule)
                                        <tr>
                                            <td class="h6 text-gray-300">{{ $carSchedule['car'] }}</td>
                                            @foreach ($carSchedule['timeSlots'] as $slot)
                                                @if ($slot['status'] == 'booked')
                                                    <td data-student-name="{{ $slot['student_name'] }}"
                                                        data-instructor-name="{{ $slot['instructor_name'] }}"
                                                        data-class-date="{{ $slot['class_date'] }}"
                                                        data-end-date="{{ $slot['end_date'] }}"
                                                        data-pickup-address="{{ $slot['address'] }}"
                                                        style="cursor: pointer;">
                                                        <!-- Add pointer cursor -->
                                                        <span
                                                            style="background-color: var(--bs-warning); border-radius:10px; padding: 4px;"
                                                            class="h6 text-dark">B</span>
                                                    </td>
                                                @else
                                                    <td>
                                                        <span class="h6 text-dark">A</span>
                                                    </td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal to show booking details -->
        <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailsModalLabel">Booking Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Student Name:</strong> <span id="modal-student-name"></span></p>
                        <p><strong>Instructor Name:</strong> <span id="modal-instructor-name"></span></p>
                        <p><strong>Class Date:</strong> <span id="modal-class-date"></span></p>
                        <p><strong>End Date:</strong> <span id="modal-end-date"></span></p>
                        <p><strong>Pickup Address:</strong> <span id="modal-pickup-address"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gy-4">
            <div class="col-lg-12">
                <div class="card overflow-hidden mt-24 p-20">
                    <div class="card-body p-0 overflow-x-auto">
                        <h5 class="mb-20">Instructor Schedules for {{ $today }}</h5>
                        <div style="max-height: 500px; overflow-y: auto; overflow-x: scroll;">
                            <table id="instructorSchedulesTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="h6 text-gray-300">Instructor</th>
                                        @for ($i = 8; $i < 20; $i++)
                                            <th class="h6 text-gray-300">{{ $i }}:00</th>
                                            <th class="h6 text-gray-300">{{ $i }}:30</th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($instructorSchedules as $instructorSchedule)
                                        <tr>
                                            <td class="h6 text-gray-300">{{ $instructorSchedule['instructor'] }}</td>
                                            @foreach ($instructorSchedule['timeSlots'] as $slot)
                                                @if ($slot['status'] == 'booked')
                                                    <td data-student-name="{{ $slot['student_name'] }}"
                                                        data-class-date="{{ $slot['class_date'] }}"
                                                        data-end-date="{{ $slot['end_date'] }}"
                                                        data-vehicle-details="{{ $slot['vehicle_details'] }}"
                                                        style="cursor: pointer;" data-bs-toggle="modal"
                                                        data-bs-target="#detailsModal">
                                                        <span
                                                            style="background-color: var(--bs-warning); border-radius:10px; padding: 4px;"
                                                            class="h6 text-dark">B</span>
                                                    </td>
                                                @else
                                                    <td>
                                                        <span class="h6 text-dark">A</span>
                                                    </td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal to show booking details for instructors -->
        <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailsModalLabel">Booking Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Student Name:</strong> <span id="modal-student-name"></span></p>
                        <p><strong>Class Date:</strong> <span id="modal-class-date"></span></p>
                        <p><strong>End Date:</strong> <span id="modal-end-date"></span></p>
                        <p><strong>Vehicle Details:</strong> <span id="modal-vehicle-details"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtering Form -->
        <div class="card mt-24">
            <div class="card-body">
                <form class="search-input-form">
                    <!-- Cars Dropdown -->
                    <select id="carSelect" class="form-control form-select h6 rounded-4 mb-0 py-6 px-8">
                        <option value="" selected disabled>Cars</option>
                        @foreach ($all_cars as $car)
                            <option value="{{ $car->id }}" data-make="{{ $car->make }}"
                                data-registration="{{ $car->registration_number }}">
                                {{ $car->make }} {{ $car->registration_number }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Instructors Dropdown -->
                    <select id="instructorSelect" class="form-control form-select h6 rounded-4 mb-0 py-6 px-8">
                        <option value="" selected disabled>Instructor</option>
                        @foreach ($instructors as $instructor)
                            <option value="{{ $instructor->id }}" data-name="{{ $instructor->employee->user->name }}">
                                {{ $instructor->employee->user->name }}
                            </option>
                        @endforeach
                    </select>

                    <button type="button" class="btn btn-main rounded-pill py-9 w-100"
                        onclick="filterData()">Search</button>
                </form>
            </div>
        </div>

        <!-- Available Slots Table -->
        <div class="card mt-24" id="slotsTableContainer" style="display: none;">
            <div class="card-body">
                <h4 class="mb-0">Available Slots</h4>
                <div class="card overflow-hidden">
                    <div class="card-body p-0 overflow-x-auto">
                        <table id="slotsTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="h6 text-gray-300">Time Slot</th>
                                    <th class="h6 text-gray-300">Instructor Name</th>
                                    <th class="h6 text-gray-300">Car</th>
                                    <th class="h6 text-gray-300">Status</th>
                                </tr>
                            </thead>
                            <tbody id="slotsBody">
                                @foreach ($timeSlots as $slot)
                                    @php
                                        $isBooked = false;
                                        $scheduleForSlot = null;

                                        // Check if today's date is between class_date and class_end_date for each schedule
foreach ($schedules as $schedule) {
    // Use the fully qualified class name for Carbon
    if (
        \Carbon\Carbon::today()->between(
            $schedule->class_date,
            $schedule->class_end_date,
        ) &&
        \Carbon\Carbon::parse($schedule->start_time)->format('H:i') <=
            $slot['value'] &&
        \Carbon\Carbon::parse($schedule->end_time)->format('H:i') >
            $slot['value']
                                            ) {
                                                $isBooked = true;
                                                $scheduleForSlot = $schedule;
                                                break; // No need to check further once booked
                                            }
                                        }
                                    @endphp
                                    <tr class="slot-row"
                                        data-car="{{ $scheduleForSlot ? $scheduleForSlot->vehicle_id : '' }}"
                                        data-instructor="{{ $scheduleForSlot ? $scheduleForSlot->instructor_id : '' }}"
                                        data-timeslot="{{ $slot['value'] }}">

                                        <!-- Time Slot Column -->
                                        <td>
                                            <div class="flex-align gap-8">
                                                <span
                                                    class="h6 mb-0 fw-medium text-gray-300">{{ $slot['display'] }}</span>
                                            </div>
                                        </td>

                                        <!-- Instructor Name or N/A -->
                                        <td>
                                            <div class="flex-align gap-8">
                                                @if ($isBooked && $scheduleForSlot)
                                                    <span
                                                        class="h6 mb-0 fw-medium text-gray-300">{{ $scheduleForSlot->instructor->employee->user->name }}</span>
                                                @else
                                                    <span class="h6 mb-0 fw-medium text-gray-300">N/A</span>
                                                @endif
                                            </div>
                                        </td>

                                        <!-- Car Model or N/A -->
                                        <td>
                                            <div class="flex-align gap-8">
                                                @if ($isBooked && $scheduleForSlot)
                                                    <span
                                                        class="h6 mb-0 fw-medium text-gray-300">{{ $scheduleForSlot->vehicle->make }}
                                                        {{ $scheduleForSlot->vehicle->registration_number }}</span>
                                                @else
                                                    <span class="h6 mb-0 fw-medium text-gray-300">N/A</span>
                                                @endif
                                            </div>
                                        </td>

                                        <!-- Status (Booked/Available) -->
                                        <td>
                                            <div class="flex-align gap-8">
                                                @if ($isBooked)
                                                    <span class="badge bg-danger">Booked</span>
                                                @else
                                                    <span class="badge bg-success">Available</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row gy-4">
            <div class="col-lg-9">
                <!-- Top Course Start -->
                <div class="card mt-24">
                    <div class="card-body">
                        <div class="mb-20 flex-between flex-wrap gap-8">
                            <h4 class="mb-0">Expense and Sales Statistics</h4>
                            <div class="flex-align gap-16 flex-wrap">
                                <div class="flex-align flex-wrap gap-16">
                                    <div class="flex-align flex-wrap gap-8">
                                        <span class="w-8 h-8 rounded-circle bg-main-600"></span>
                                        <span class="text-13 text-gray-600">Expenses</span>
                                    </div>
                                    <div class="flex-align flex-wrap gap-8">
                                        <span class="w-8 h-8 rounded-circle bg-main-two-600"></span>
                                        <span class="text-13 text-gray-600">Sales</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="doubleLineChart" class="tooltip-style y-value-left"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <!-- Progress Bar Start -->
                <div class="card mt-24">
                    <div class="card-header border-bottom border-gray-100">
                        <h5 class="mb-0">My Progress</h5>
                    </div>
                    <div class="card-body">
                        <div id="radialMultipleBar"></div>

                        <div class="">
                            <h6 class="text-lg mb-16 text-center"> <span class="text-gray-400">Total hour:</span>
                                6h 32 min</h6>
                            <div class="flex-between gap-8 flex-wrap">
                                <div class="flex-align flex-column">
                                    <h6 class="mb-6">60/60</h6>
                                    <span class="w-30 h-3 rounded-pill bg-main-600"></span>
                                    <span class="text-13 mt-6 text-gray-600">Completed</span>
                                </div>
                                <div class="flex-align flex-column">
                                    <h6 class="mb-6">60/60</h6>
                                    <span class="w-30 h-3 rounded-pill bg-main-two-600"></span>
                                    <span class="text-13 mt-6 text-gray-600">Completed</span>
                                </div>
                                <div class="flex-align flex-column">
                                    <h6 class="mb-6">60/60</h6>
                                    <span class="w-30 h-3 rounded-pill bg-gray-500"></span>
                                    <span class="text-13 mt-6 text-gray-600">Completed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Progress bar end -->
            </div>

            <div class="row gy-4">
                <div class="row g-4">
                    <!-- Total Instructors Card -->
                    <div class="col-xxl-3 col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-2">{{ $totalInstructorsCount }}</h4>
                                <span class="text-gray-600">Total Instructors</span>
                                <div class="flex-between gap-8 mt-16">
                                    <span
                                        class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-600 text-white text-2xl">
                                        <i class="ph-fill ph-chalkboard-teacher"></i>
                                    </span>
                                    <div id="instructors-count" class="remove-tooltip-title rounded-tooltip-value">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Cars Card -->
                    <div class="col-xxl-3 col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-2">{{ $totalCarsCount }}</h4>
                                <span class="text-gray-600">Total Cars</span>
                                <div class="flex-between gap-8 mt-16">
                                    <span
                                        class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-600 text-white text-2xl">
                                        <i class="ph-fill ph-car"></i>
                                    </span>
                                    <div id="cars-count" class="remove-tooltip-title rounded-tooltip-value">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submitted Forms Card -->
                    <div class="col-xxl-3 col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-2">{{ $submittedFormsCount }}</h4>
                                <span class="text-gray-600">Submitted Forms</span>
                                <div class="flex-between gap-8 mt-16">
                                    <span
                                        class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-600 text-white text-2xl">
                                        <i class="ph-fill ph-file-text"></i>
                                    </span>
                                    <div id="submitted-forms-count" class="remove-tooltip-title rounded-tooltip-value">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Expense Card -->
                    <div class="col-xxl-3 col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-2">{{ number_format($monthlyExpense, 2) }}</h4>
                                <span class="text-gray-600">Monthly Expense</span>
                                <div class="flex-between gap-8 mt-16">
                                    <span
                                        class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-600 text-white text-2xl">
                                        <i class="ph-fill ph-currency-dollar"></i>
                                    </span>
                                    <div id="monthly-expense" class="remove-tooltip-title rounded-tooltip-value">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Yearly Expense Card -->
                    <div class="col-xxl-3 col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-2">{{ number_format($yearlyExpense, 2) }}</h4>
                                <span class="text-gray-600">Yearly Expense</span>
                                <div class="flex-between gap-8 mt-16">
                                    <span
                                        class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-600 text-white text-2xl">
                                        <i class="ph-fill ph-currency-dollar"></i>
                                    </span>
                                    <div id="yearly-expense" class="remove-tooltip-title rounded-tooltip-value">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Monthly Sales Card -->
                    <div class="col-xxl-3 col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-2">{{ number_format($monthlySales, 2) }}</h4>
                                <span class="text-gray-600">Monthly Sales</span>
                                <div class="flex-between gap-8 mt-16">
                                    <span
                                        class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-600 text-white text-2xl">
                                        <i class="ph-fill ph-currency-dollar-simple"></i>
                                    </span>
                                    <div id="monthly-sales" class="remove-tooltip-title rounded-tooltip-value">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Yearly Sales Card -->
                    <div class="col-xxl-3 col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-2">{{ number_format($yearlySales, 2) }}</h4>
                                <span class="text-gray-600">Yearly Sales</span>
                                <div class="flex-between gap-8 mt-16">
                                    <span
                                        class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-700 text-white text-2xl">
                                        <i class="ph-fill ph-currency-dollar-simple"></i>
                                    </span>
                                    <div id="yearly-sales" class="remove-tooltip-title rounded-tooltip-value">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Fuel Card -->
                    <div class="col-xxl-3 col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-2">{{ number_format($monthlyFuelExpense, 2) }}</h4>
                                <span class="text-gray-600">Monthly Fuel Expense</span>
                                <div class="flex-between gap-8 mt-16">
                                    <span
                                        class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-700 text-white text-2xl">
                                        <i class="ph-fill ph-currency-dollar-simple"></i>
                                    </span>
                                    <div id="montly-fuel-expense" class="remove-tooltip-title rounded-tooltip-value">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Widgets End -->
        </div>
        <br>
        <!-- Script for Filtering Data -->
        <script>
            function filterData() {
                let carSelect = document.getElementById('carSelect');
                let instructorSelect = document.getElementById('instructorSelect');
                let carId = carSelect.value;
                let instructorId = instructorSelect.value;

                let carOption = carSelect.options[carSelect.selectedIndex];
                let instructorOption = instructorSelect.options[instructorSelect.selectedIndex];

                let carMake = carOption ? carOption.getAttribute('data-make') : '';
                let carReg = carOption ? carOption.getAttribute('data-registration') : '';
                let instructorName = instructorOption ? instructorOption.getAttribute('data-name') : '';

                let rows = document.querySelectorAll('.slot-row');

                // Show or hide the table based on selection
                let slotsTableContainer = document.getElementById('slotsTableContainer');
                if (carId || instructorId) {
                    slotsTableContainer.style.display = 'block'; // Show the table
                } else {
                    slotsTableContainer.style.display = 'none'; // Hide the table
                    return; // No filtering if nothing is selected
                }

                rows.forEach(row => {
                    let rowCar = row.getAttribute('data-car');
                    let rowInstructor = row.getAttribute('data-instructor');
                    let carInfo = row.querySelector('.car-info');
                    let instructorNameCell = row.querySelector('.instructor-name');

                    // Always show all rows by default
                    row.style.display = '';

                    // If a car is selected, show the selected car details
                    if (carId) {
                        carInfo.innerHTML = `<span class="h6 mb-0 fw-medium text-gray-300">${carMake} ${carReg}</span>`;
                        instructorNameCell.innerHTML = '<span class="h6 mb-0 fw-medium text-gray-300">N/A</span>';
                    }

                    // If an instructor is selected, show the selected instructor's name
                    if (instructorId) {
                        instructorNameCell.innerHTML =
                            `<span class="h6 mb-0 fw-medium text-gray-300">${instructorName}</span>`;
                        carInfo.innerHTML = '<span class="h6 mb-0 fw-medium text-gray-300">N/A</span>';
                    }
                });
            }
        </script>
        <script>
            // Listen for click events on booked time slots
            document.querySelectorAll('td[data-student-name]').forEach(td => {
                td.addEventListener('click', function() {
                    const studentName = this.getAttribute('data-student-name');
                    const instructorName = this.getAttribute('data-instructor-name');
                    const classDate = this.getAttribute('data-class-date');
                    const endDate = this.getAttribute('data-end-date');
                    const pickupAddress = this.getAttribute('data-pickup-address');

                    // Set the modal content with student, instructor names, class date, and end date
                    document.getElementById('modal-student-name').textContent = studentName;
                    document.getElementById('modal-instructor-name').textContent = instructorName;
                    document.getElementById('modal-class-date').textContent = classDate;
                    document.getElementById('modal-end-date').textContent = endDate;
                    document.getElementById('modal-pickup-address').textContent = pickupAddress;

                    // Show the modal
                    var detailsModal = new bootstrap.Modal(document.getElementById('detailsModal'));
                    detailsModal.show();
                });
            });
        </script>
        <script>
            const monthlyExpenseData = @json($monthlyExpenseData);
            const monthlySalesData = @json($monthlySalesData);
        </script>
    @endsection
