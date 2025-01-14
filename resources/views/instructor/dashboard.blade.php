@extends('layout.layout')

@section('content')
    <div class="dashboard-body">
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <!-- Breadcrumb Start -->
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">

                    <li><span class="text-main-600 fw-normal text-15">MY STUDENTS</span></li>
                </ul>
            </div>
            <!-- Breadcrumb End -->
        </div>

        <div class="card overflow-hidden">
            <div class="card-body p-0 overflow-x-auto">
                <table id="scheduleTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300">Student Name</th>
                            <th class="h6 text-gray-300">Email</th>
                            <th class="h6 text-gray-300">Phone</th>
                            <th class="h6 text-gray-300">Class Duration</th>
                            <th class="h6 text-gray-300">Admission Date</th>
                            <th class="h6 text-gray-300">Course Enrolled</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $index => $student)
                            <tr>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $student->user->name }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $student->email ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $student->phone }}</span>
                                </td>
                                <td>
                                    <span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ $student->course->duration_days }}</span>
                                </td>
                                <td>
                                    <span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ \Carbon\Carbon::parse($student->admission_date)->format('d-m-Y') }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">
                                        {{-- {{ $student->course->carModel->cars->first()->name ?? 'N/A' }} --}}
                                        {{-- ({{ ucfirst($student->course->carModel->transmission ?? 'N/A') }}) --}}
                                        -
                                        {{-- {{ $student->course->carModel->cars->first()->registration_number ?? 'N/A' }} --}}
                                        -
                                        {{-- ({{ $student->course->duration_days ?? 'N/A' }} Days) --}}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <br>

        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <!-- Breadcrumb Start -->
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">

                    <li><span class="text-main-600 fw-normal text-15">MY SCHEDULES</span></li>
                </ul>
            </div>
            <!-- Breadcrumb End -->
        </div>

        <!-- Calendar Section Start -->
        <div class="card mt-24 bg-transparent">
            <div class="card-body p-0">
                <div id='wrap'>
                    <div id='calendar' class="position-relative">
                        {{-- <button type="button"
                        class="add-event btn btn-main text-sm btn-sm px-24 rounded-pill py-12 d-flex align-items-center gap-2"
                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="ph ph-plus me-4"></i>
                        Add Event
                    </button> --}}
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
