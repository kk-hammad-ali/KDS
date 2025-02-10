@extends('layout.layout')

@section('content')
    <div class="dashboard-body">
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li><a href="{{ route('admin.dashboard') }}"
                        class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                <h5 class="text-info mb-3"><i class="ph ph-chalkboard-teacher"></i> Update Attendance for {{ $selectedDate }}
                </h5>
            </ul>
        </div>

        <!-- Instructor Attendance Update Form -->
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

                <form action="{{ route('instructor.attendance.store.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="date" value="{{ $selectedDate }}">

                    <h5 class="text-info mb-3"><i class="ph ph-chalkboard-teacher"></i> Update Attendance for
                        {{ $selectedDate }}</h5>

                    <div class="card overflow-hidden p-20">
                        <div class="card-body p-0 overflow-x-auto">
                            <table id="instructorTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="h6 text-gray-300">Instructor Name</th>
                                        <th class="h6 text-gray-300">Present / Absent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendanceRecords as $record)
                                        <tr>
                                            <td class="h6 text-gray-300">{{ $record['instructor']->employee->user->name }}
                                            </td>
                                            <td>
                                                <label class="h6 text-gray-300 me-2">
                                                    <input type="radio" class="form-check-input"
                                                        name="attendance_update[{{ $record['instructor']->id }}][present]"
                                                        value="1"
                                                        {{ $record['attendance'] && $record['attendance']->instructor_present ? 'checked' : '' }}>
                                                    Present
                                                </label>
                                                <label class="h6 text-gray-300">
                                                    <input type="radio" class="form-check-input"
                                                        name="attendance_update[{{ $record['instructor']->id }}][present]"
                                                        value="0"
                                                        {{ !$record['attendance'] || !$record['attendance']->instructor_present ? 'checked' : '' }}>
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
@endsection
