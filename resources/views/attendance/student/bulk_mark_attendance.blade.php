@extends('layout.layout')

@section('content')
    <div class="dashboard-body">
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li><a href="{{ route('admin.dashboard') }}"
                        class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                <li><span class="text-main-600 fw-normal text-15">Bulk Mark Attendance</span></li>
            </ul>
        </div>

        <!-- Bulk Attendance Form -->
        <div class="card mt-24">
            <div class="card-body">
                <form action="{{ route('student.attendance.bulk.store') }}" method="POST">
                    @csrf

                    <!-- Select Multiple Students -->
                    <h5>Select Students</h5>
                    <div class="d-flex flex-wrap gap-4 mb-4">
                        @foreach ($students as $student)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="students[]"
                                    value="{{ $student->id }}" id="student{{ $student->id }}">
                                <label class="form-check-label" for="student{{ $student->id }}">
                                    {{ $student->user->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <!-- Select Date Range for Attendance -->
                    <h5>Select Attendance Date Range</h5>
                    <div class="mb-4">
                        <div class="d-flex gap-4">
                            <input type="date" name="attendance_start_date" class="form-control" required>
                            <input type="date" name="attendance_end_date" class="form-control" required>
                        </div>
                    </div>

                    <!-- Select Attendance Status -->
                    <h5>Select Attendance Status</h5>
                    <div class="d-flex gap-4 mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="attendance_status" value="1"
                                id="present" checked>
                            <label class="form-check-label" for="present">
                                Present
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="attendance_status" value="0"
                                id="absent">
                            <label class="form-check-label" for="absent">
                                Absent
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-main rounded-pill py-9">Mark Attendance</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
