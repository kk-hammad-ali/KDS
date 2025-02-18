@extends('layout.layout')

@section('content')
    <div class="dashboard-body">
        <div class="row gy-4">

            {{-- <!-- Dummy Text to Test Branch Switch -->
            <div class="alert alert-info mt-3">
                @if (auth()->user()->current_branch_id && auth()->user()->currentBranch)
                    <strong>Current Branch:</strong> {{ auth()->user()->currentBranch->name }}
                @endif
            </div> --}}



            <!-- Date Picker for Student Attendance -->
            <div class="d-flex justify-content-end">
                <div class="card w-75">
                    <div class="card-body">
                        <form action="{{ route('admin.dashboard') }}" method="GET"
                            class="d-flex justify-content-end align-items-center">
                            <!-- Date Picker for Date Before -->
                            <div class="col-4 me-3">
                                <input type="date" id="dateBefore" name="dateBefore" value="{{ old('dateBefore') }}"
                                    class="form-control h6 rounded-4 mb-0 py-6 px-8" placeholder="Select Date Before">
                            </div>

                            <!-- Date Picker for Date After -->
                            <div class="col-4 me-3">
                                <input type="date" id="dateAfter" name="dateAfter" value="{{ old('dateAfter') }}"
                                    class="form-control h6 rounded-4 mb-0 py-6 px-8" placeholder="Select Date After">
                            </div>

                            <!-- Buttons (Stacked vertically) -->
                            <div class="d-flex flex-column col-4">
                                <!-- Search Button -->
                                <button type="submit" class="btn btn-main rounded-pill py-9 px-4 mb-3">Go</button>

                                <!-- Reset Button -->
                                <button type="button" onclick="resetForm()"
                                    class="btn btn-secondary rounded-pill py-9 px-4">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                function resetForm() {
                    // Clear the date inputs and submit the form with default values
                    document.getElementById('dateBefore').value = '';
                    document.getElementById('dateAfter').value = '';
                    // Submit the form with no date filters
                    window.location.href = '{{ route('admin.dashboard') }}'; // Redirect to the dashboard without date filters
                }
            </script>


            <div class="row g-4">
                <!-- Total Students Card -->
                <div class="col-xxl-3 col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-2">{{ $totalStudentsCount }}</h4>
                            <span class="text-gray-600">Students</span>
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
                            <span class="text-gray-600">Classes</span>
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
                <div class="col-xxl-3 col-sm-3" data-bs-toggle="modal" data-bs-target="#expenseModal">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-2">{{ number_format($todayExpense, 2) }}</h4>
                            <span class="text-gray-600">Expenses</span>
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
                <div class="col-xxl-3 col-sm-3" data-bs-toggle="modal" data-bs-target="#salesModal">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-2">{{ number_format($todaySales, 2) }}</h4>
                            <span class="text-gray-600">Sales</span>
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

        <!-- Today's Expense Modal -->
        <div class="modal fade" id="expenseModal" tabindex="-1" aria-labelledby="expenseModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="expenseModalLabel">Today's Expenses</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="h6 text-gray-300">Expense Type</th>
                                    <th class="h6 text-gray-300">Description</th>
                                    <th class="h6 text-gray-300">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todayExpenseDetails as $expense)
                                    <tr>
                                        <td class="h6 mb-0 fw-medium text-gray-300">
                                            {{ $expense instanceof DailyExpense ? 'Daily Expense' : ($expense instanceof FixedExpense ? 'Fixed Expense' : 'Car Expense') }}
                                        </td>
                                        <td class="h6 mb-0 fw-medium text-gray-300">{{ $expense->description }}</td>
                                        <td class="h6 mb-0 fw-medium text-gray-300">
                                            {{ number_format($expense->amount, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Today's Sales Modal -->
        <div class="modal fade" id="salesModal" tabindex="-1" aria-labelledby="salesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="salesModalLabel">Today's Sales</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="h6 text-gray-300">Student Name</th>
                                    <th class="h6 text-gray-300">Course Name</th>
                                    <th class="h6 text-gray-300">Fee</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todaySalesDetails as $student)
                                    <tr>
                                        <td class="h6 mb-0 fw-medium text-gray-300">{{ $student->user->name }}</td>
                                        <td class="h6 mb-0 fw-medium text-gray-300">{{ $student->course->duration_days }}
                                            - Days
                                            {{ $student->course->carModel->name }}
                                        </td>
                                        <td class="h6 mb-0 fw-medium text-gray-300">
                                            {{ number_format($student->course->fees, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Initialize Bootstrap modal on click
            var expenseModal = new bootstrap.Modal(document.getElementById('expenseModal'));
            var salesModal = new bootstrap.Modal(document.getElementById('salesModal'));
        </script>



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
                                            <span
                                                class="h6 mb-0 fw-medium text-gray-300">{{ $class->student->course->carModel->name }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="h6 mb-0 fw-medium text-gray-300">{{ $class->student->address }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="h6 mb-0 fw-medium text-gray-300">{{ \Carbon\Carbon::parse($class->start_time)->format('h:i A') }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="h6 mb-0 fw-medium text-gray-300">{{ \Carbon\Carbon::parse($class->end_time)->format('h:i A') }}</span>
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


        <div class="row gy-4">
            <div class="col-lg-12">
                <div class="card overflow-hidden mt-24 p-20">
                    <div class="card-body p-0 overflow-x-auto">
                        <div class="d-flex justify-content-between align-items-center mb-20">
                            <h5 class="mb-0">Instructor Schedules for {{ $today }}</h5>

                            <!-- Dropdown for Gender Selection with col-4 -->
                            <div class="col-3">
                                <select id="genderSelect" class="form-select" onchange="filterSchedules()">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>

                            <!-- Dropdown for Instructor Selection with col-4 -->
                            <div class="col-3">
                                <select id="instructorSelect" class="form-select" onchange="filterSchedules()">
                                    <option value="">Select Instructor</option>
                                    @foreach ($instructorSchedules as $instructorSchedule)
                                        <option value="{{ $instructorSchedule['instructor'] }}">
                                            {{ $instructorSchedule['instructor'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div style="max-height: 500px; overflow-y: auto; overflow-x: scroll;">
                            <table id="instructorSchedulesTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="h6 text-gray-300">Instructor</th>
                                        @for ($i = 8; $i < 20; $i++)
                                            <th class="h6 text-gray-300">
                                                {{ \Carbon\Carbon::createFromTime($i, 0)->format('h:i') }}</th>
                                            <th class="h6 text-gray-300">
                                                {{ \Carbon\Carbon::createFromTime($i, 30)->format('h:i') }}</th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($instructorSchedules as $instructorSchedule)
                                        <tr class="schedule-row"
                                            data-instructor="{{ $instructorSchedule['instructor'] }}"
                                            data-gender="{{ $instructorSchedule['gender'] }}">
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
                                                            class="h6 text-dark">
                                                            {{ $slot['pickup_sector'] ?? 'B' }}
                                                            ({{ \Carbon\Carbon::parse($slot['end_date'])->format('d') }})
                                                        </span>
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

        <script>
            function filterSchedules() {
                var selectedInstructor = document.getElementById('instructorSelect').value;
                var selectedGender = document.getElementById('genderSelect').value;
                var rows = document.querySelectorAll('.schedule-row');

                rows.forEach(function(row) {
                    var instructorName = row.getAttribute('data-instructor');
                    var gender = row.getAttribute('data-gender');

                    // Filter by Instructor and Gender
                    if ((selectedInstructor === '' || instructorName === selectedInstructor) &&
                        (selectedGender === '' || gender === selectedGender)) {
                        row.style.display = ''; // Show the row
                    } else {
                        row.style.display = 'none'; // Hide the row
                    }
                });
            }
        </script>

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


        <div class="row gy-4">
            <div class="col-lg-12">
                <div class="card overflow-hidden mt-24 p-20">
                    <div class="card-body p-0 overflow-x-auto">
                        <div class="d-flex justify-content-between align-items-center mb-20">
                            <h5 class="mb-0">Car Schedules for {{ $today }}</h5>
                            <!-- Dropdown for Car Selection with col-4 -->
                            <div class="col-3">
                                <select id="carSelect" class="form-select" onchange="filterCarSchedules()">
                                    <option value="">Select Car</option>
                                    @foreach ($carSchedules as $carSchedule)
                                        <option value="{{ $carSchedule['car'] }}">
                                            {{ $carSchedule['car'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Dropdown for Transmission Selection -->
                            <div class="col-3">
                                <select id="transmissionSelect" class="form-select" onchange="filterCarSchedules()">
                                    <option value="">Select Transmission</option>
                                    <option value="automatic">Automatic</option>
                                    <option value="manual">Manual</option>
                                </select>
                            </div>
                        </div>

                        <div style="max-height: 500px; overflow-y: auto; overflow-x: scroll;">
                            <table id="carSchedulesTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="h6 text-gray-300">Car</th>
                                        @for ($i = 8; $i < 20; $i++)
                                            <th class="h6 text-gray-300">
                                                {{ \Carbon\Carbon::createFromTime($i, 0)->format('h:i') }}</th>
                                            <th class="h6 text-gray-300">
                                                {{ \Carbon\Carbon::createFromTime($i, 30)->format('h:i') }}</th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carSchedules as $carSchedule)
                                        <tr class="car-schedule-row" data-car="{{ $carSchedule['car'] }}"
                                            data-transmission="{{ $carSchedule['transmission'] }}">
                                            <td class="h6 text-gray-300">{{ $carSchedule['car'] }}</td>
                                            @foreach ($carSchedule['timeSlots'] as $slot)
                                                @if ($slot['status'] == 'booked')
                                                    <td data-student-name="{{ $slot['student_name'] }}"
                                                        data-instructor-name="{{ $slot['instructor_name'] }}"
                                                        data-class-date="{{ $slot['class_date'] }}"
                                                        data-end-date="{{ $slot['end_date'] }}"
                                                        data-pickup-address="{{ $slot['address'] }}"
                                                        style="cursor: pointer;">
                                                        <span
                                                            style="background-color: var(--bs-warning); border-radius:10px; padding: 4px;"
                                                            class="h6 text-dark">
                                                            {{ $slot['pickup_sector'] ?? 'B' }}
                                                            ({{ \Carbon\Carbon::parse($slot['end_date'])->format('d') }})
                                                        </span>
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

        <script>
            function filterCarSchedules() {
                var selectedCar = document.getElementById('carSelect').value;
                var selectedTransmission = document.getElementById('transmissionSelect').value;

                var rows = document.querySelectorAll('.car-schedule-row');

                rows.forEach(function(row) {
                    var carName = row.getAttribute('data-car');
                    var carTransmission = row.getAttribute('data-transmission');

                    if ((selectedCar === '' || carName === selectedCar) &&
                        (selectedTransmission === '' || carTransmission === selectedTransmission)) {
                        row.style.display = ''; // Show the row
                    } else {
                        row.style.display = 'none'; // Hide the row
                    }
                });
            }
        </script>

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
                <!-- Today's New Classes Table -->
                <div class="card overflow-hidden mt-24 p-20">
                    <div class="card-body p-0 overflow-x-auto">
                        <h5 class="mb-20">Tomorrow New Classes</h5>
                        <table id="todaysNewClassesTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="h6 text-gray-300">#</th>
                                    <th class="h6 text-gray-300">Student</th>
                                    <th class="h6 text-gray-300">Instructor</th>
                                    <th class="h6 text-gray-300">Car</th>
                                    <th class="h6 text-gray-300">Pickup Sector</th>
                                    <th class="h6 text-gray-300">Start Time</th>
                                    <th class="h6 text-gray-300">End Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todayAdmissions as $admission)
                                    @foreach ($admission->schedules as $class)
                                        <tr>
                                            <td>
                                                <span
                                                    class="h6 mb-0 fw-medium text-gray-300">{{ $loop->iteration }}</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="h6 mb-0 fw-medium text-gray-300">{{ $admission->user->name ?? 'N/A' }}</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="h6 mb-0 fw-medium text-gray-300">{{ $class->instructor->employee->user->name ?? 'N/A' }}</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="h6 mb-0 fw-medium text-gray-300">{{ $class->vehicle->make ?? 'N/A' }}
                                                    {{ $class->vehicle->model ?? 'N/A' }}</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="h6 mb-0 fw-medium text-gray-300">{{ $admission->pickup_sector ?? 'N/A' }}</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="h6 mb-0 fw-medium text-gray-300">{{ $class->start_time ?? 'N/A' }}</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="h6 mb-0 fw-medium text-gray-300">{{ $class->end_time ?? 'N/A' }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gy-4">
            <div class="col-lg-12">
                <!-- Today's Admissions Table -->
                <div class="card overflow-hidden mt-24 p-20">
                    <div class="card-body p-0 overflow-x-auto">
                        <h5 class="mb-20">Today's Admissions</h5>
                        <table id="todaysAdmissionsTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="h6 text-gray-300">#</th>
                                    <th class="h6 text-gray-300">Student</th>
                                    <th class="h6 text-gray-300">CNIC</th>
                                    <th class="h6 text-gray-300">Class Start Date</th>
                                    <th class="h6 text-gray-300">Total</th>
                                    <th class="h6 text-gray-300">Advance</th>
                                    <th class="h6 text-gray-300">Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todayCreatedStudents as $student)
                                    <tr>
                                        <td>
                                            <span class="h6 mb-0 fw-medium text-gray-300">{{ $loop->iteration }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="h6 mb-0 fw-medium text-gray-300">{{ $student->user->name }}</span>
                                        </td>
                                        <td>
                                            <span class="h6 mb-0 fw-medium text-gray-300">{{ $student->cnic }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="h6 mb-0 fw-medium text-gray-300">{{ $student->admission_date }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="h6 mb-0 fw-medium text-gray-300">{{ $student->invoice->amount_received }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="h6 mb-0 fw-medium text-gray-300">{{ $student->invoice->balance }}</span>
                                        </td>
                                        <td>
                                            <span class="h6 mb-0 fw-medium text-gray-300">
                                                @php
                                                    $invoice = $student->invoice; // Assuming each student has one invoice
                                                    $amountReceived = $invoice ? $invoice->amount_received : 0;
                                                    $balance = $invoice ? $invoice->balance : 0;
                                                    $remainingBalance = $amountReceived - $balance; // Calculate remaining balance
                                                @endphp
                                                {{ $remainingBalance }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtering Form -->
        <div class="card mt-24">
            <div class="card-body">
                <form class="search-input-form">
                    <!-- Cars Dropdown -->
                    <select id="carSelect2" class="form-control form-select h6 rounded-4 mb-0 py-6 px-8">
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

                    <!-- Gender Dropdown -->
                    <select id="genderSelect" class="form-control form-select h6 rounded-4 mb-0 py-6 px-8">
                        <option value="" selected disabled>Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>

                    <!-- Date Picker -->
                    <input type="date" id="dateSelect" class="form-control h6 rounded-4 mb-0 py-6 px-8">

                    <!-- Time Slot Dropdown -->
                    <select id="timeSlotSelect" class="form-control form-select h6 rounded-4 mb-0 py-6 px-8">
                        <option value="" selected disabled>Time Slot</option>
                        @foreach ($timeSlots as $slot)
                            <option value="{{ $slot['value'] }}">{{ $slot['display'] }}</option>
                        @endforeach
                    </select>

                    <!-- Pickup Sector Dropdown -->
                    <select id="pickupSectorSelect" class="form-control form-select h6 rounded-4 mb-0 py-6 px-8">
                        <option value="" selected disabled>Pickup Sector</option>
                        @foreach ($allPickupSectors as $sector)
                            <option value="{{ $sector }}">{{ $sector }}</option>
                        @endforeach
                    </select>

                    <div class="row mt-3">
                        <div class="col-12 mb-2">
                            <button type="button" class="btn btn-main rounded-pill py-9 w-100"
                                onclick="filterData()">Search</button>
                        </div>
                        <div class="col-12">
                            <button type="button" class="btn btn-secondary rounded-pill py-9 w-100"
                                onclick="resetFilters()">Reset</button>
                        </div>
                    </div>
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
                                    <tr class="slot-row" data-timeslot="{{ $slot['value'] }}"
                                        data-display-time="{{ $slot['display'] }}">

                                        <!-- Time Slot Column -->
                                        <td>
                                            <span class="h6 mb-0 fw-medium text-gray-300">{{ $slot['display'] }}</span>
                                        </td>

                                        <!-- Instructor Name -->
                                        <td class="instructor-name h6 mb-0 fw-medium text-gray-300">N/A</td>

                                        <!-- Car Model -->
                                        <td class="car-info h6 mb-0 fw-medium text-gray-300">N/A</td>

                                        <!-- Status -->
                                        <td class="status-cell">
                                            <span class="badge bg-success">Available</span>
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
                            {{-- <div class="flex-align gap-16 flex-wrap">
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
                            </div> --}}
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

        <!-- Script for Filtering and Displaying Available/Booked Slots -->
        <script>
            const schedules = @json($schedules); // Schedule data from server

            function filterData() {
                let carSelect = document.getElementById('carSelect2').value;
                let instructorSelect = document.getElementById('instructorSelect').value;
                let pickupSectorSelect = document.getElementById('pickupSectorSelect').value;
                let genderSelect = document.getElementById('genderSelect').value;
                let dateSelect = document.getElementById('dateSelect').value;
                let timeSlotSelect = document.getElementById('timeSlotSelect').value;

                let rows = document.querySelectorAll('.slot-row');
                let slotsTableContainer = document.getElementById('slotsTableContainer');

                if (carSelect || instructorSelect || pickupSectorSelect || genderSelect || dateSelect || timeSlotSelect) {
                    slotsTableContainer.style.display = 'block';
                } else {
                    slotsTableContainer.style.display = 'none';
                    return;
                }

                rows.forEach(row => {
                    let timeSlotValue = row.getAttribute('data-timeslot');
                    let instructorNameCell = row.querySelector('.instructor-name');
                    let carInfoCell = row.querySelector('.car-info');
                    let statusCell = row.querySelector('.status-cell');

                    // Reset row to "Available" state
                    instructorNameCell.textContent = 'N/A';
                    carInfoCell.textContent = 'N/A';
                    statusCell.innerHTML = '<span class="badge bg-success">Available</span>';
                    row.style.display = '';

                    // Check if the time slot is booked
                    let isBooked = false;
                    schedules.forEach(schedule => {
                        if (schedule.start_time <= timeSlotValue && schedule.end_time > timeSlotValue) {
                            // Check if filters match
                            if ((carSelect && schedule.vehicle_id != carSelect) ||
                                (instructorSelect && schedule.instructor_id != instructorSelect) ||
                                (pickupSectorSelect && schedule.student.pickup_sector != pickupSectorSelect) ||
                                (genderSelect && schedule.instructor.employee.gender != genderSelect) ||
                                (dateSelect && schedule.class_date != dateSelect)) {
                                row.style.display = 'none';
                                return;
                            }

                            // Mark as booked if conditions are met
                            isBooked = true;
                            instructorNameCell.textContent = schedule.instructor.employee.user.name;
                            carInfoCell.textContent = schedule.vehicle.make + ' ' + schedule.vehicle
                                .registration_number;
                            statusCell.innerHTML = '<span class="badge bg-danger">Booked</span>';
                        }
                    });

                    // If filtering by time slot and it doesn't match, hide the row
                    if (timeSlotSelect && timeSlotValue !== timeSlotSelect) {
                        row.style.display = 'none';
                    }
                });
            }

            function resetFilters() {
                document.getElementById('carSelect2').value = '';
                document.getElementById('instructorSelect').value = '';
                document.getElementById('pickupSectorSelect').value = '';
                document.getElementById('genderSelect').value = '';
                document.getElementById('dateSelect').value = '';
                document.getElementById('timeSlotSelect').value = '';

                let rows = document.querySelectorAll('.slot-row');
                rows.forEach(row => row.style.display = '');

                document.getElementById('slotsTableContainer').style.display = 'none';
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
