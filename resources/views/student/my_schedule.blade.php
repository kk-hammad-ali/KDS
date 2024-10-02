@extends('layout.student')

@section('page_content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">My Class Schedule</h4>
                    </div>
                    <!-- FullCalendar -->
                    <div id="calendar"></div>
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

        /* Add padding between the time slots for a less congested look */
        .fc-timegrid-slot {
            background-color: white !important;
            /* Ensure slots have white background */
            padding: 10px !important;
            /* Add padding to the slots */
        }

        .fc-event-title {
            font-weight: bold;
            font-size: 12px;
        }

        /* Styling for Booked Slots */
        .fc-event-booked {
            background-color: #ffcccb !important;
            /* Light coral color */
            color: #000;
            /* Darker text for contrast */
        }

        /* Remove underline from the day name */
        .fc-col-header-cell a {
            text-decoration: none;
        }

        /* Update header navigation button colors */
        .fc-button-primary {
            background-color: #007bff;
            border-color: #007bff;
            text-transform: capitalize;
            /* Capitalize buttons */
        }

        .fc-button-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        /* Update calendar title styling */
        .fc-toolbar-title {
            font-size: 1.5rem;
            color: #333;
        }

        /* Ensure time is formatted correctly */
        .fc-timegrid-axis-cushion {
            font-weight: bold;
            font-size: 12px;
            text-align: center;
            /* Center align times */
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridDay', // Use time-based view (day view)
                slotMinTime: '08:00:00', // Start time at 8 AM
                slotMaxTime: '20:30:00', // End time at 8:30 PM, to ensure 8:00 PM slot is fully visible
                slotDuration: '00:30:00', // Ensure each slot is 30 minutes
                slotLabelInterval: '00:30:00', // Ensure time labels appear at 30-minute intervals
                forceEventDuration: true, // Ensure events have a duration
                defaultTimedEventDuration: '00:30:00', // Default duration if event has no end time
                slotLabelFormat: { // Custom time formatting for slots
                    hour: 'numeric',
                    minute: '2-digit',
                    meridiem: 'short', // AM/PM
                    hour12: true
                },
                allDaySlot: false, // Disable all-day slot for day view by default
                headerToolbar: {
                    left: 'prev,next today',
                    right: 'timeGridDay,timeGridWeek'
                },
                buttonText: {
                    today: 'Today', // Capitalize 'today'
                    day: 'Day', // Capitalize 'day'
                    week: 'Week' // Capitalize 'week'
                },
                events: @json($events),
                eventDidMount: function(info) {
                    // Append the course_end_date to the title
                    var tooltip = info.event.extendedProps.course_end_date;
                    var element = info.el.querySelector('.fc-event-title');
                    if (element && tooltip) {
                        element.innerHTML = `${info.event.title} | End Date: ${tooltip}`;
                    }

                    // Apply specific class for booked events
                    if (info.event.backgroundColor ===
                        '#ff0000') { // Assuming booked events are red in the backend
                        info.el.classList.add('fc-event-booked');
                    }
                },
                viewDidMount: function(view) {
                    // Show all-day slot only in week view
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
