@extends('layout.admin')

@section('page_content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">Instructor Attendance Calendar</h4>
                        <a href="{{ route('instructor.attendance.mark', ['date' => \Carbon\Carbon::now()->format('Y-m-d')]) }}"
                            class="btn btn-primary">
                            Mark Today's Attendance
                        </a>
                    </div>


                    <!-- FullCalendar -->
                    <div id="attendanceCalendar"></div>
                </div>
            </div>
        </div>
    </div>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />

    <style>
        /* General Calendar Styling */
        .fc {
            background-color: white;
            /* Change overall background color to white */
            border: none;
            padding: 20px;
        }

        .fc-toolbar-title {
            font-size: 24px;
            font-weight: bold;
        }

        .fc-event {
            border: none;
            /* Remove border */
            padding: 5px;
            /* Add padding for a cleaner look */
            border-radius: 5px;
            /* Slightly round the edges */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Add subtle shadow for depth */
        }

        .fc-event-booked {
            background-color: #ffcccb !important;
            /* Light coral color */
            color: #000;
            /* Darker text for contrast */
        }

        .fc-event-present {
            background-color: #28a745 !important;
            /* Green for present */
            color: white;
            /* White text for contrast */
        }

        .fc-event-absent {
            background-color: #dc3545 !important;
            /* Red for absent */
            color: white;
            /* White text for contrast */
        }

        .fc-event-title {
            font-weight: bold;
            font-size: 12px;
        }

        /* Remove underline from the day name */
        .fc-col-header-cell a {
            text-decoration: none;
        }

        .fc-button-primary {
            background-color: #007bff;
            border-color: #007bff;
            text-transform: capitalize;
        }

        .fc-button-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .fc-toolbar-title {
            font-size: 1.5rem;
            color: #333;
        }

        .fc-timegrid-axis-cushion {
            font-weight: bold;
            font-size: 12px;
            text-align: center;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('attendanceCalendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth', // Monthly grid view
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'timeGridWeek,dayGridMonth'
                },
                buttonText: {
                    today: 'Today',
                    month: 'Month',
                    week: 'Week'
                },
                events: @json($attendanceEvents), // Load events from backend
                eventDidMount: function(info) {
                    var attendance = info.event.extendedProps.attendance;
                    var element = info.el.querySelector('.fc-event-title');

                    // Append tick or cross icon based on attendance status
                    if (element) {
                        if (attendance === 'present') {
                            element.innerHTML =
                                `<i class="fas fa-check-circle"></i> ${info.event.title}`;
                            info.el.classList.add('fc-event-present'); // Add class for styling
                        } else if (attendance === 'absent') {
                            element.innerHTML =
                                `<i class="fas fa-times-circle"></i> ${info.event.title}`;
                            info.el.classList.add('fc-event-absent'); // Add class for styling
                        }
                    }
                },
            });

            calendar.render();
        });
    </script>
@endsection
