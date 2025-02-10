@extends('layout.layout')

@section('content')
    <div class="dashboard-body">
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li><a href="{{ route('admin.dashboard') }}"
                        class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                <li><span class="text-main-600 fw-normal text-15">Instructor Attendance</span></li>
            </ul>
        </div>

        <!-- Date Picker for Instructor Attendance -->
        <div class="card mt-24">
            <div class="card-body">
                <form action="{{ route('instructor.attendance.update') }}" method="GET" class="search-input-form">
                    <!-- Date Picker for Attendance Date -->
                    <input type="date" id="attendance_date" name="date" value="{{ old('date', $date) }}"
                        class="form-control h6 rounded-4 mb-0 py-6 px-8" placeholder="Select Attendance Date">

                    <!-- Search Button -->
                    <button type="submit" class="btn btn-main rounded-pill py-9 w-100 mt-3">Go</button>
                </form>
            </div>
        </div>


        <!-- Instructor Attendance Form -->
        <div class="card mt-24 bg-transparent">
            <div class="card-body p-4">
                {{-- Display errors if any --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Display success message --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('instructor.attendance.store') }}" method="POST">
                    @csrf

                    <!-- Instructor Attendance Section -->
                    <h5 class="text-info mb-3"><i class="ph ph-chalkboard-teacher"></i> Mark Attendance for
                        {{ $date }}</h5>

                    <!-- Instructors Attendance Table -->
                    <div class="card overflow-hidden pt-20">
                        <div class="card-body p-0 overflow-x-auto">
                            <table id="instructorTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="fixed-width">
                                            <div class="form-check">
                                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox"
                                                    id="selectAll">
                                            </div>
                                        </th>
                                        <th class="h6 text-gray-300">Instructor Name</th>
                                        <th class="h6 text-gray-300">Present / Absent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($instructors as $instructor)
                                        @php
                                            $attendance = $instructor
                                                ->attendances()
                                                ->where('attendance_date', $date)
                                                ->first();
                                        @endphp
                                        <tr>
                                            <td class="fixed-width">
                                                <div class="form-check">
                                                    <input class="form-check-input border-gray-200 rounded-4"
                                                        type="checkbox">
                                                </div>
                                            </td>
                                            <td class="h6 text-gray-300">{{ $instructor->employee->user->name }}</td>
                                            <td>
                                                <label class="form-check-label me-2 h6 text-gray-300">
                                                    <input type="radio" class="form-check-input"
                                                        name="instructor_attendance[{{ $instructor->id }}][{{ $date }}]"
                                                        value="1"
                                                        {{ $attendance && $attendance->instructor_present ? 'checked' : '' }}>
                                                    Present
                                                </label>
                                                <label class="form-check-label h6 text-gray-300">
                                                    <input type="radio" class="form-check-input"
                                                        name="instructor_attendance[{{ $instructor->id }}][{{ $date }}]"
                                                        value="0"
                                                        {{ $attendance && !$attendance->instructor_present ? 'checked' : '' }}>
                                                    Absent
                                                </label>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Submit Button Section -->
                        <div class="d-flex justify-content-end m-10">
                            <button type="submit"
                                class="btn btn-main text-sm btn-sm px-24 py-12 d-flex align-items-center gap-2">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Calendar Section Start -->
        <div class="card mt-24 bg-transparent">
            <div class="card-body p-0">
                <div id='wrap'>
                    <div id='calendar' class="position-relative" data-events='@json($events)'>
                        {{-- You can uncomment and implement the button to navigate to today's attendance --}}
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
