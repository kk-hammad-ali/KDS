@extends('layout.admin')

@section('page_content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h3 class="mb-4">Attendance for {{ $attendance_date }}</h3>

                    <form action="{{ route('attendance.index') }}" method="GET" class="mb-4">
                        <label for="attendance_date" class="form-label">Select Date</label>
                        <input type="date" name="date" id="attendance_date" value="{{ $attendance_date }}"
                            class="form-control w-25 d-inline-block">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>

                    @if ($attendances->count() > 0)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Instructor Name</th>
                                    <th>Class Start Time</th>
                                    <th>Student Present</th>
                                    <th>Instructor Present</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendances as $attendance)
                                    <tr>
                                        {{-- <td>{{ $attendance->student->user->name }}</td>
                                        <td>{{ $attendance->instructor->user->name }}</td> --}}
                                        <td>{{ $attendance->class_start_time }}</td>
                                        <td>{{ $attendance->student_present ? 'Yes' : 'No' }}</td>
                                        <td>{{ $attendance->instructor_present ? 'Yes' : 'No' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No attendance records found for {{ $attendance_date }}.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
