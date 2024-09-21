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

                    <form action="{{ route('student.attendance.store') }}" method="POST">
                        @csrf

                        <!-- Student Attendance Section -->
                        <h5 class="text-info mb-3"><i class="fas fa-user-graduate"></i> Mark Student Attendance for
                            {{ $date }}</h5>
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-hover table-striped text-center align-middle attendance-table">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th class="text-start" style="min-width: 100px;">Student Name</th>
                                        <th class="text-start" style="min-width: 100px;">Instructor Name</th>
                                        <th class="text-start" style="min-width: 100px;">Car</th>
                                        <th>Present / Absent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($students as $student)
                                        <tr>
                                            <td class="text-start"><strong>{{ $student->user->name }}</strong></td>
                                            <td class="text-start">
                                                <strong>{{ $student->instructor->employee->user->name }}</strong>
                                            </td>
                                            <td class="text-start"><strong>{{ $student->vehicle->make }}</strong></td>
                                            <td>
                                                <label class="form-check-label me-2">
                                                    <input type="radio" class="form-check-input"
                                                        name="student_attendance[{{ $student->id }}][{{ $date }}]"
                                                        value="1"
                                                        {{ $student->attendances()->where('attendance_date', $date)->where('student_present', 1)->exists() ? 'checked' : '' }}>
                                                </label>
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input"
                                                        name="student_attendance[{{ $student->id }}][{{ $date }}]"
                                                        value="0"
                                                        {{ $student->attendances()->where('attendance_date', $date)->where('student_present', 0)->exists() ? 'checked' : '' }}>
                                                </label>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">No students available for attendance on this date.</td>
                                        </tr>
                                    @endforelse
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

        .table th,
        .table td {
            vertical-align: middle;
        }
    </style>
@endsection
