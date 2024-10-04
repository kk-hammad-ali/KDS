@extends('layout.admin')

@section('page_content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">Class Schedule</h4>
                    </div>

                    <!-- FullCalendar -->
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">All Schedules</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Instructor Name</th>
                                    <th scope="col">Vehicle</th>
                                    <th scope="col">Class Date</th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">End Time</th>
                                    <th scope="col">Course End Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $schedule)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $schedule->student->user->name }}</td>
                                        <td>{{ $schedule->instructor->employee->user->name }}</td>
                                        <td>{{ $schedule->vehicle->make }} {{ $schedule->vehicle->model }}</td>
                                        <td>{{ $schedule->class_date }}</td>
                                        <td>{{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}</td>
                                        <td>{{ $schedule->student->course_end_date }}</td>
                                        <td>
                                            <a href="" class="btn btn-warning mb-2">Edit</a>
                                            <button class="btn btn-danger" onclick="setDeleteRoute('')">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this schedule? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a id="deleteConfirmButton" class="btn btn-danger" href="#">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setDeleteRoute(route) {
            const deleteButton = document.getElementById('deleteConfirmButton');
            deleteButton.href = route;
            $('#deleteModal').modal('show');
        }
    </script>

    <!-- FullCalendar CSS and JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/main.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.9/index.global.min.js"></script>

    <style>
        /* Responsive styling */
        .fc {
            background-color: white;
            border: none;
            padding: 10px;
            max-width: 100%;
        }

        .fc-event {
            border: none;
            padding: 5px;
            border-radius: 5px;
            font-size: 0.85rem;
        }

        .fc-event-booked {
            background-color: black !important;
            color: white !important;
        }

        .fc-timegrid-slot {
            background-color: white !important;
            padding: 10px !important;
        }

        .fc-toolbar-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        /* Smaller font size for mobile */
        @media (max-width: 576px) {
            .fc-toolbar-title {
                font-size: 1rem;
            }

            .fc-event {
                font-size: 0.75rem;
            }

            .fc-timegrid-axis-cushion {
                font-size: 10px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridDay',
                slotMinTime: '08:00:00',
                slotMaxTime: '20:30:00',
                slotDuration: '00:30:00',
                slotLabelInterval: '00:30:00',
                forceEventDuration: true,
                defaultTimedEventDuration: '00:30:00',
                slotLabelFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    meridiem: 'short',
                    hour12: true
                },
                allDaySlot: false,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'timeGridDay,timeGridWeek'
                },
                titleFormat: {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                },
                buttonText: {
                    today: 'Today',
                    day: 'Day',
                    week: 'Week'
                },
                events: @json($events),
                eventDidMount: function(info) {
                    var tooltip = info.event.extendedProps.course_end_date;
                    var element = info.el.querySelector('.fc-event-title');
                    if (element && tooltip) {
                        element.innerHTML = `${info.event.title} | End Date: ${tooltip}`;
                    }

                    if (info.event.backgroundColor === '#ff0000') {
                        info.el.classList.add('fc-event-booked');
                    }
                },
                viewDidMount: function(view) {
                    if (view.view.type === 'timeGridWeek') {
                        calendar.setOption('allDaySlot', true);
                    } else {
                        calendar.setOption('allDaySlot', false);
                    }
                }
            });
            calendar.render();
        });
    </script>
@endsection
