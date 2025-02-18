@extends('layout.layout')

@section('content')
    <div class="dashboard-body">

        <div class="breadcrumb mb-24 d-flex justify-content-between">
            <ul class="flex-align gap-4 mb-0">
                <li><a href="{{ route('admin.dashboard') }}"
                        class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                <li><span class="text-main-600 fw-normal text-15">Student Attendance</span></li>
            </ul>

            <!-- Bulk Attendance Button on the right -->
            <a href="{{ route('student.attendance.bulk') }}"
                class="btn btn-main rounded-pill py-9 d-flex align-items-center gap-2">
                <i class="ph ph-plus me-4"></i>
                Mark Bulk Attendance
            </a>
        </div>

        <!-- Date Picker and Student Name Filter -->
        <div class="card mt-24">
            <div class="card-body">
                <form action="{{ route('student.attendance.update') }}" method="GET" class="search-input-form">
                    <!-- Student Name Input -->
                    <input type="text" id="studentName" class="form-control h6 rounded-4 mb-0 py-6 px-8"
                        placeholder="Search by Student Name">

                    <!-- Date Picker for Attendance Date -->
                    <input type="date" id="attendance_date" name="date" value="{{ old('date', $date) }}"
                        class="form-control h6 rounded-4 mb-0 py-6 px-8 mt-3" placeholder="Select Attendance Date">

                    <!-- Search Button -->
                    <button type="submit" class="btn btn-main rounded-pill py-9 w-100 mt-3">Go</button>
                </form>
            </div>
        </div>
        <br>

        <!-- Attendance Form -->
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

                <form action="{{ route('student.attendance.store') }}" method="POST">
                    @csrf

                    <!-- Student Attendance Section -->
                    <h5 class="text-info mb-3"><i class="ph ph-user-graduate"></i> Mark Attendance for {{ $date }}
                    </h5>

                    <!-- Students Attendance Table -->
                    <div class="card overflow-hidden p-20">
                        <div class="card-body p-0 overflow-x-auto">
                            <table id="studentTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="h6 text-gray-300">Student Name</th>
                                        <th class="h6 text-gray-300">Instructor Name</th>
                                        <th class="h6 text-gray-300">Vehicle</th>
                                        <th class="h6 text-gray-300">Present / Absent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($students as $student)
                                        <tr>
                                            <td class="h6 text-gray-300">{{ $student->user->name }}</td>
                                            <td class="h6 text-gray-300">
                                                @if ($student->instructor && $student->instructor->employee)
                                                    {{ $student->instructor->employee->user->name }}
                                                @else
                                                    <span class="h6 text-gray-300">No Instructor Assigned</span>
                                                @endif
                                            </td>
                                            <td class="h6 text-gray-300">
                                                {{ $student->course->carModel->name ?? 'No Vehicle Assigned' }}
                                                ({{ $student->course->duration_days ?? 'N/A' }} days)
                                            </td>
                                            <td>
                                                <label class="h6 text-gray-300 me-2">
                                                    <input type="radio" class="form-check-input"
                                                        name="student_attendance[{{ $student->id }}][{{ $date }}]"
                                                        value="1"
                                                        {{ $student->attendances()->where('attendance_date', $date)->where('student_present', 1)->exists() ? 'checked' : '' }}>
                                                    Present
                                                </label>
                                                <label class="h6 text-gray-300">
                                                    <input type="radio" class="form-check-input"
                                                        name="student_attendance[{{ $student->id }}][{{ $date }}]"
                                                        value="0"
                                                        {{ $student->attendances()->where('attendance_date', $date)->where('student_present', 0)->exists() ? 'checked' : '' }}>
                                                    Absent
                                                </label>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="h6 text-gray-300" colspan="4">No students available for attendance
                                                on this date.</td>
                                        </tr>
                                    @endforelse
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
                        {{-- <a href="{{ route('student.attendance.mark', ['date' => \Carbon\Carbon::now()->format('Y-m-d')]) }}"
                            class="add-event btn btn-main text-sm btn-sm px-24 rounded-pill py-12 d-flex align-items-center gap-2">
                            <i class="ph ph-plus me-4"></i>
                            Today
                        </a> --}}
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

    <script>
        // Add event listener for live filtering by student name
        document.getElementById('studentName').addEventListener('input', filterAttendance);

        function filterAttendance() {
            const studentNameInput = document.getElementById('studentName').value.toLowerCase();
            const tableRows = document.querySelectorAll('#studentTable tbody tr');

            tableRows.forEach(function(row) {
                const studentName = row.cells[0].innerText.toLowerCase(); // Get student name from the first column

                // Show or hide the row based on the student name input
                if (studentName.includes(studentNameInput)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>

@endsection
