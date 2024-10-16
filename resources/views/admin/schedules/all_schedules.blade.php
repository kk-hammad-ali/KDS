@extends('layout.layout')

@section('content')
    <div class="dashboard-body">
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li><a href="{{ route('admin.dashboard') }}"
                        class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                <li><span class="text-main-600 fw-normal text-15">Schedule</span></li>
            </ul>
        </div>

        <!-- Calendar Section Start -->
        <div class="card mt-24 bg-transparent">
            <div class="card-body p-0">
                <div id='wrap'>
                    <div id='calendar' class="position-relative">
                    </div>
                    <div style='clear:both'></div>
                </div>
            </div>
        </div>
        <!-- Calendar Section End -->

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
        <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
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
    </div>
    <script>
        var events = @json($events);
        console.log(events);
    </script>
@endsection
