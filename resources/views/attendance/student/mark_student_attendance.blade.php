@extends('layout.admin-new')

@section('content')
    <div class="dashboard-body">
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li><a href="{{ route('admin.dashboard') }}"
                        class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                <li><span class="text-main-600 fw-normal text-15">Mark Student Attendance</span></li>
            </ul>
        </div>

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
                    <div class="card overflow-hidden">
                        <div class="card-body p-0 overflow-x-auto">
                            <table id="studentTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="fixed-width">
                                            <div class="form-check">
                                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox"
                                                    id="selectAll">
                                            </div>
                                        </th>
                                        <th class="h6 text-gray-300">Student Name</th>
                                        <th class="h6 text-gray-300">Instructor Name</th>
                                        <th class="h6 text-gray-300">Vehicle</th>
                                        <th class="h6 text-gray-300">Present / Absent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($students as $student)
                                        <tr>
                                            <td class="fixed-width">
                                                <div class="form-check">
                                                    <input class="form-check-input border-gray-200 rounded-4"
                                                        type="checkbox">
                                                </div>
                                            </td>
                                            <td class="h6 text-gray-300">{{ $student->user->name }}</td>
                                            <td class="h6 text-gray-300">
                                                @if ($student->instructor && $student->instructor->employee)
                                                    {{ $student->instructor->employee->user->name }}
                                                @else
                                                    <span class="h6 text-gray-300">No Instructor Assigned</span>
                                                @endif
                                            </td>
                                            <td class="h6 text-gray-300">
                                                {{ $student->vehicle->make ?? 'No Vehicle Assigned' }}
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
                                            <td colspan="4">No students available for attendance on this date.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Submit Button Section -->
                        <div class="d-flex justify-content-center mt-5 mb-5">
                            <button type="submit"
                                class="btn btn-main text-sm btn-sm px-24 py-12 d-flex align-items-center gap-2">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
