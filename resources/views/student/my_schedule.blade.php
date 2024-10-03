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
            border: none;
            padding: 20px;
        }

        .fc-toolbar-title {
            font-size: 24px;
            font-weight: bold;
        }

        .fc-event {
            border: none;
            padding: 5px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .fc-timegrid-slot {
            background-color: white !important;
            padding: 10px !important;
        }

        .fc-event-title {
            font-weight: bold;
            font-size: 12px;
        }

        .fc-event-booked {
            background-color: #ffcccb !important;
            color: #000;
        }

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
                    right: 'timeGridDay,timeGridWeek'
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
