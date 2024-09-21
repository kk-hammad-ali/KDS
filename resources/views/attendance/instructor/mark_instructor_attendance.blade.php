@extends('layout.admin')

@section('page_content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4 shadow-sm">

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
                        <h5 class="text-info mb-3"><i class="fas fa-chalkboard-teacher"></i> Mark Instructor Attendance for
                            {{ $date }}</h5>
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-hover table-striped text-center align-middle attendance-table">
                                <thead class="bg-info text-white">
                                    <tr>
                                        <th class="text-start" style="min-width: 100px;">Instructor Name</th>
                                        <th>Present / Absent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($instructors as $instructor)
                                        @php
                                            // Check if attendance is already marked for the instructor on the given date
                                            $attendance = $instructor
                                                ->attendances()
                                                ->where('attendance_date', $date)
                                                ->first();
                                        @endphp
                                        <tr>
                                            <td class="text-start"><strong>{{ $instructor->employee->user->name }}</strong>
                                            </td>
                                            <!-- Align left using Bootstrap class -->
                                            <td>
                                                <label class="form-check-label me-2">
                                                    <input type="radio" class="form-check-input"
                                                        name="instructor_attendance[{{ $instructor->id }}][{{ $date }}]"
                                                        value="1"
                                                        {{ $attendance && $attendance->instructor_present ? 'checked' : '' }}>
                                                </label>
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input"
                                                        name="instructor_attendance[{{ $instructor->id }}][{{ $date }}]"
                                                        value="0"
                                                        {{ $attendance && !$attendance->instructor_present ? 'checked' : '' }}>
                                                </label>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="text-center mt-5">
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary w-75">Submit Attendance</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-check-input {
            cursor: pointer;
            transform: scale(1.3);
        }
    </style>
@endsection
