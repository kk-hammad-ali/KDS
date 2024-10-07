@extends('layout.instructor-new')

@section('content')
    <div class="dashboard-body">
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li><a href="{{ route('admin.dashboard') }}"
                        class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                <li><span class="text-main-600 fw-normal text-15">Student Attendance</span></li>
            </ul>
        </div>

        <!-- Calendar Section Start -->
        <div class="card mt-24 bg-transparent">
            <div class="card-body p-0">
                <div id='wrap'>
                    <div id='calendar' class="position-relative" data-events='@json($events)'>
                        <a href="{{ route('instructor.student.attendance.mark', ['date' => \Carbon\Carbon::now()->format('Y-m-d')]) }}"
                            class="add-event btn btn-main text-sm btn-sm px-24 rounded-pill py-12 d-flex align-items-center gap-2">
                            <i class="ph ph-plus me-4"></i>
                            Today
                        </a>
                    </div>
                    <div style='clear:both'></div>
                </div>
            </div>
        </div>
        <!-- Calendar Section End -->
    </div>

    <script>
        var events = @json($events);
    </script>
@endsection
