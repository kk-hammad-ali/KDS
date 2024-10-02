@extends('layout.instructor')

@section('page_content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4 shadow-sm">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('instructor.student.attendance.store') }}" method="POST">
                        @csrf

                        <h5 class="text-info mb-3"><i class="fas fa-user-graduate"></i> Mark Student Attendance for
                            {{ $date }}</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped text-center align-middle">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Present / Absent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($students as $student)
                                        <tr>
                                            <td>{{ $student->user->name }}</td>
                                            <td>
                                                <label>
                                                    <input type="radio"
                                                        name="student_attendance[{{ $student->id }}][{{ $date }}]"
                                                        value="1"
                                                        {{ $student->attendances()->where('attendance_date', $date)->where('student_present', 1)->exists() ? 'checked' : '' }}>
                                                    Present
                                                </label>
                                                <label>
                                                    <input type="radio"
                                                        name="student_attendance[{{ $student->id }}][{{ $date }}]"
                                                        value="0"
                                                        {{ $student->attendances()->where('attendance_date', $date)->where('student_present', 0)->exists() ? 'checked' : '' }}>
                                                    Absent
                                                </label>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2">No students available for attendance on this date.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="text-center mt-5">
                            <button type="submit" class="btn btn-primary w-75">Submit Attendance</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
