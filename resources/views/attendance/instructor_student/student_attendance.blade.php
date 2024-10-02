@extends('layout.instructor')

@section('page_content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">Student Attendance Calendar</h4>
                        <a href="{{ route('instructor.student.attendance.mark', ['date' => \Carbon\Carbon::now()->format('Y-m-d')]) }}"
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
        .fc {
            background-color: white;
            border: none;
            padding: 20px;
        }

        .fc-event-present {
            background-color: #28a745 !important;
            color: white;
        }

        .fc-event-absent {
            background-color: #dc3545 !important;
            color: white;
        }

        .fc-event-title {
            font-weight: bold;
            font-size: 12px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('attendanceCalendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'timeGridWeek,dayGridMonth'
                },
                events: @json($attendanceEvents),
                eventDidMount: function(info) {
                    var attendance = info.event.extendedProps.attendance;
                    var element = info.el.querySelector('.fc-event-title');

                    if (element) {
                        if (attendance === 'present') {
                            element.innerHTML =
                                `<i class="fas fa-check-circle"></i> ${info.event.title}`;
                            info.el.classList.add('fc-event-present');
                        } else if (attendance === 'absent') {
                            element.innerHTML =
                                `<i class="fas fa-times-circle"></i> ${info.event.title}`;
                            info.el.classList.add('fc-event-absent');
                        }
                    }
                },
            });

            calendar.render();
        });
    </script>
@endsection
