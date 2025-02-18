@extends('layout.layout')

@section('content')
    <div class="dashboard-body">
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li><a href="{{ route('admin.dashboard') }}"
                        class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                <h5 class="text-info mb-3"><i class="ph ph-user-graduate"></i> Update Attendance for {{ $selectedDate }}</h5>
            </ul>
        </div>


        <!-- Student Name Filter Form -->
        <div class="card mt-24 bg-transparent">
            <div class="card-body p-4">
                <form class="search-input-form">
                    <!-- Student Name Input -->
                    <input type="text" id="studentName" class="form-control h6 rounded-4 mb-0 py-6 px-8"
                        placeholder="Enter Student Name">

                    <button type="button" class="btn btn-main rounded-pill py-9 w-100 mt-3" onclick="filterAttendance()">
                        Search
                    </button>
                </form>
            </div>
        </div>


        <!-- Attendance Update Form -->
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

                <form action="{{ route('student.attendance.store.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="date" value="{{ $selectedDate }}">

                    <div class="card overflow-hidden p-20">
                        <div class="card-body p-0 overflow-x-auto">
                            <table id="studentTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="h6 text-gray-300">Student Name</th>
                                        <th class="h6 text-gray-300">Present / Absent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendanceRecords as $record)
                                        <tr>
                                            <td class="h6 text-gray-300">{{ $record['student']->user->name }}</td>
                                            <td>
                                                <label class="h6 text-gray-300 me-2">
                                                    <input type="radio" class="form-check-input"
                                                        name="attendance_update[{{ $record['student']->id }}][present]"
                                                        value="1"
                                                        {{ $record['attendance'] && $record['attendance']->student_present ? 'checked' : '' }}>
                                                    Present
                                                </label>
                                                <label class="h6 text-gray-300">
                                                    <input type="radio" class="form-check-input"
                                                        name="attendance_update[{{ $record['student']->id }}][present]"
                                                        value="0"
                                                        {{ !$record['attendance'] || !$record['attendance']->student_present ? 'checked' : '' }}>
                                                    Absent
                                                </label>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end m-10">
                            <button type="submit"
                                class="btn btn-main text-sm btn-sm px-24 py-12 d-flex align-items-center gap-2">
                                Update Attendance
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
