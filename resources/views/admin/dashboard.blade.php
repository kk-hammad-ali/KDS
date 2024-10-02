@extends('layout.admin')

@section('page_content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-2">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <div class="ms-3">
                        <p class="mb-2">Today Sale</p>
                        <h6 class="mb-0">$1234</h6> <!-- Replace with actual sales data -->
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-2">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <div class="ms-3">
                        <p class="mb-2">Today Expense</p>
                        <h6 class="mb-0">${{ number_format($todayExpense, 2) }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-2">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <div class="ms-3">
                        <p class="mb-2">Monthly Sale</p>
                        <h6 class="mb-0">$12345</h6> <!-- Replace with actual monthly sales data -->
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-2">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <div class="ms-3">
                        <p class="mb-2">Monthy Expense</p>
                        <h6 class="mb-0">${{ number_format($monthlyExpense, 2) }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-2">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <div class="ms-3">
                        <p class="mb-2">Year Sale</p>
                        <h6 class="mb-0">$123456</h6> <!-- Replace with actual yearly sales data -->
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-2">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <div class="ms-3">
                        <p class="mb-2">Year Expense</p>
                        <h6 class="mb-0">${{ number_format($yearlyExpense, 2) }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->

    {{--
    <!-- Sales Chart Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Worldwide Sales</h6>
                        <a href="">Show All</a>
                    </div>
                    <canvas id="worldwide-sales"></canvas>
                </div>
            </div>
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Salse & Revenue</h6>
                        <a href="">Show All</a>
                    </div>
                    <canvas id="salse-revenue"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- Sales Chart End --> --}}

    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Schedule Availability for {{ \Carbon\Carbon::parse($class_date)->format('d M Y') }}</h6>
            </div>

            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Instructor</th>
                            @for ($hour = 8; $hour <= 19; $hour++)
                                <th scope="col">{{ \Carbon\Carbon::createFromTime($hour, 0)->format('h:i A') }}</th>
                                <th scope="col">{{ \Carbon\Carbon::createFromTime($hour, 30)->format('h:i A') }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($availableSlots))
                            @foreach ($availableSlots as $instructorName => $slots)
                                <tr>
                                    <td>{{ $instructorName }}</td>
                                    @foreach ($slots as $slot)
                                        <td class="{{ $slot['status'] == 'Available' ? 'bg-success' : 'bg-danger' }}">
                                            @if ($slot['status'] == 'Available')
                                                {{ $slot['status'] }}
                                            @else
                                                <a class="btn btn-sm btn-danger booked-slot" href="#"
                                                    data-start-time="{{ \Carbon\Carbon::parse($slot['start_time'])->format('h:i A') }}"
                                                    data-end-time="{{ \Carbon\Carbon::parse($slot['end_time'])->format('h:i A') }}"
                                                    data-class-date="{{ \Carbon\Carbon::parse($slot['class_date'])->format('d M Y') }}"
                                                    data-course-end-date="{{ \Carbon\Carbon::parse($slot['course_end_date'])->format('d M Y') }}">
                                                    {{ $slot['status'] }}
                                                </a>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="26" class="text-center">No availability data found for the selected date.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for showing booked slot details -->
    <div class="modal fade" id="bookedSlotModal" tabindex="-1" aria-labelledby="bookedSlotModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookedSlotModalLabel">Slot Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="slotDetails"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Car Schedule Availability for {{ \Carbon\Carbon::now()->format('d M Y') }}</h6>
            </div>

            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th>Car</th>
                            <th>Number</th>
                            @for ($hour = 8; $hour <= 19; $hour++)
                                <th>{{ \Carbon\Carbon::createFromTime($hour, 0)->format('h:i A') }}</th>
                                <th>{{ \Carbon\Carbon::createFromTime($hour, 30)->format('h:i A') }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($availableCarSlots as $carIdentifier => $slots)
                            @php
                                // Extracting car make, model, and registration number
                                $carDetails = explode(' ', $carIdentifier, 3); // Assume identifier is formatted as "Make Model Registration"
                                $carMakeModel = $carDetails[0] . ' ' . $carDetails[1];
                                $registration = $carDetails[2];
                            @endphp
                            <tr>
                                <td>{{ $carMakeModel }}</td>
                                <td>{{ $registration }}</td>
                                @foreach ($slots as $slot)
                                    <td class="{{ $slot['status'] == 'Available' ? 'bg-success' : 'bg-danger' }}">
                                        @if ($slot['status'] == 'Available')
                                            {{ $slot['status'] }}
                                        @else
                                            <a class="btn btn-sm btn-danger booked-slot" href="#"
                                                data-start-time="{{ \Carbon\Carbon::parse($slot['start_time'])->format('h:i A') }}"
                                                data-end-time="{{ \Carbon\Carbon::parse($slot['end_time'])->format('h:i A') }}"
                                                data-class-date="{{ \Carbon\Carbon::parse($slot['class_date'])->format('d M Y') }}"
                                                data-course-end-date="{{ \Carbon\Carbon::parse($slot['course_end_date'])->format('d M Y') }}">
                                                {{ $slot['status'] }}
                                            </a>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for showing booked slot details -->
    <div class="modal fade" id="bookedSlotModal" tabindex="-1" aria-labelledby="bookedSlotModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookedSlotModalLabel">Slot Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="slotDetails"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.booked-slot').forEach(function(button) {
            button.addEventListener('click', function() {
                const startTime = this.getAttribute('data-start-time');
                const endTime = this.getAttribute('data-end-time');
                const classDate = this.getAttribute('data-class-date');
                const courseEndDate = this.getAttribute('data-course-end-date');

                const slotDetails =
                    `This slot is booked from ${startTime} to ${endTime} on ${classDate}, booked until ${courseEndDate}.`;
                document.getElementById('slotDetails').textContent = slotDetails;

                const bookedSlotModal = new bootstrap.Modal(document.getElementById(
                    'bookedSlotModal'));
                bookedSlotModal.show();
            });
        });
    </script>


    <!-- Widgets Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="h-100 bg-light rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="mb-0">Messages</h6>
                        <a href="">Show All</a>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-3">
                        <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt=""
                            style="width: 40px; height: 40px;">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">Jhon Doe</h6>
                                <small>15 minutes ago</small>
                            </div>
                            <span>Short message goes here...</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-3">
                        <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt=""
                            style="width: 40px; height: 40px;">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">Jhon Doe</h6>
                                <small>15 minutes ago</small>
                            </div>
                            <span>Short message goes here...</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-3">
                        <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt=""
                            style="width: 40px; height: 40px;">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">Jhon Doe</h6>
                                <small>15 minutes ago</small>
                            </div>
                            <span>Short message goes here...</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center pt-3">
                        <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt=""
                            style="width: 40px; height: 40px;">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">Jhon Doe</h6>
                                <small>15 minutes ago</small>
                            </div>
                            <span>Short message goes here...</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="h-100 bg-light rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Calender</h6>
                        <a href="">Show All</a>
                    </div>
                    <div id="calender"></div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="h-100 bg-light rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">To Do List</h6>
                        <a href="">Show All</a>
                    </div>
                    <div class="d-flex mb-2">
                        <input class="form-control bg-transparent" type="text" placeholder="Enter task">
                        <button type="button" class="btn btn-primary ms-2">Add</button>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-2">
                        <input class="form-check-input m-0" type="checkbox">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <span>Short task goes here...</span>
                                <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-2">
                        <input class="form-check-input m-0" type="checkbox">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <span>Short task goes here...</span>
                                <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-2">
                        <input class="form-check-input m-0" type="checkbox" checked>
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <span><del>Short task goes here...</del></span>
                                <button class="btn btn-sm text-primary"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-2">
                        <input class="form-check-input m-0" type="checkbox">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <span>Short task goes here...</span>
                                <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center pt-2">
                        <input class="form-check-input m-0" type="checkbox">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <span>Short task goes here...</span>
                                <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Widgets End -->
@endsection
