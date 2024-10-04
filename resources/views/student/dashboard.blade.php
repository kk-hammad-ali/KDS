@extends('layout.student')

@section('page_content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">My Schedule</h6>
                <a href="#">Show All</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Class Start Date</th>
                            <th scope="col">Class End Date</th>
                            <th scope="col">Start Time</th>
                            <th scope="col">End Time</th>
                            <th scope="col">Instructor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $schedule)
                            <tr>
                                <td>{{ $schedule->class_date }}</td>
                                <td>{{ $schedule->class_end_date }}</td>
                                <td>{{ $schedule->start_time }}</td>
                                <td>{{ $schedule->end_time }}</td>
                                <td>{{ $schedule->instructor->employee->user->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">All Leaves</h4>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#leaveModal">
                    <i class="fas fa-plus me-2"></i> Apply Leave
                </button>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaves as $leave)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $leave->start_date }}</td>
                                <td>{{ $leave->end_date }}</td>
                                <td>{{ $leave->leave_reason }}</td>
                                <td>
                                    @php
                                        $statusClass = match ($leave->status) {
                                            'pending' => 'btn-primary',
                                            'approved' => 'btn-success',
                                            'rejected' => 'btn-danger',
                                            default => 'btn-secondary',
                                        };
                                    @endphp
                                    <btn class="btn status-btn {{ $statusClass }}">
                                        {{ ucfirst($leave->status) }}
                                    </btn>
                                </td>
                                <td>
                                    @if ($leave->status === 'pending')
                                        <!-- Edit Button triggers the modal and passes the leave ID -->
                                        <button class="btn btn-warning"
                                            onclick="editLeaveModal({{ $leave->id }}, '{{ $leave->start_date }}', '{{ $leave->end_date }}', '{{ $leave->leave_reason }}')">
                                            Edit
                                        </button>
                                        <button class="btn btn-danger" onclick="triggerDeleteModal({{ $leave->id }})">
                                            Delete
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for Adding Leave -->
    <div class="modal fade" id="leaveModal" tabindex="-1" aria-labelledby="leaveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="leaveModalLabel">Apply for Leave</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('student.leaves.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                        id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                                    @error('start_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                        id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                                    @error('end_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="leave_reason" class="form-label">Reason</label>
                            <textarea class="form-control @error('leave_reason') is-invalid @enderror" id="leave_reason" name="leave_reason"
                                rows="3" placeholder="Enter the reason for leave" required>{{ old('leave_reason') }}</textarea>
                            @error('leave_reason')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary w-75">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal for Editing Leave -->
    <div class="modal fade" id="editLeaveModal" tabindex="-1" aria-labelledby="editLeaveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLeaveModalLabel">Edit Leave</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editLeaveForm" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="edit_start_date" class="form-label">Start Date</label>
                                    <input type="date" class="form-control" id="edit_start_date" name="start_date"
                                        required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="edit_end_date" class="form-label">End Date</label>
                                    <input type="date" class="form-control" id="edit_end_date" name="end_date"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="edit_leave_reason" class="form-label">Reason</label>
                            <textarea class="form-control" id="edit_leave_reason" name="leave_reason" rows="3" required></textarea>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary w-75">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Deleting Leave -->
    <div class="modal fade" id="deleteLeaveModal" tabindex="-1" aria-labelledby="deleteLeaveModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteLeaveModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this leave?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden Form for Deleting Leave -->
    <form id="deleteLeaveForm" action="" method="GET" style="display: none;">
        @csrf
    </form>




    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">My Certificate</h6>
                @if ($certificateAvailable)
                    <a href="{{ route('download.certificate') }}" class="btn btn-primary">Download PDF</a>
                @endif
            </div>
            <div class="certificate-container">
                @if (!$certificateAvailable)
                    <div class="alert alert-info">
                        Certificate is only available after course completion.
                    </div>
                @else
                    <div class="certificate">
                        <div class="certificate-header">
                            <img src="{{ asset('public/images/logo.png') }}" alt="King Driving School Logo" />
                        </div>
                        <div class="certificate-body">
                            <h1>Certificate of Completion</h1>
                            <p class="student-name">{{ $student->user->name }}</p>
                            <div class="certificate-content">
                                <p>has completed <strong>{{ $student->practical_driving_hours }}</strong> hours of driving
                                    training on
                                    <strong>{{ \Carbon\Carbon::parse($student->course_end_date)->format('F j, Y') }}</strong>.
                                </p>
                                <p>The course consists of {{ $student->practical_driving_hours }} hours and includes the
                                    following
                                    topics:</p>
                                <p class="topic-description">Traffic Laws - Defensive Driving - Safe Driving Practices -
                                    Road Signs -
                                    Vehicle Operation - Emergency Procedures</p>
                            </div>
                            <div class="certificate-footer">
                                <p>Instructor: {{ $student->instructor->employee->user->name }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <style>
        @page {
            margin: 20px;
            /* Reduce margins on all sides */
        }

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
            /* Ensure content is centered */
        }

        .certificate {
            border: 15px solid #FF8F1F;
            /* Reduced border size */
            padding: 20px;
            /* Reduced padding */
            width: 90%;
            /* Occupy more horizontal space */
            margin: 0 auto;
            /* Center the certificate */
            text-align: center;
        }

        .certificate-header {
            text-align: center;
            margin-bottom: 15px;
        }

        .certificate-header img {
            width: 100px;
            /* Adjust the image size */
            height: auto;
        }

        h1 {
            font-weight: 400;
            font-size: 28px;
            /* Reduced font size */
            color: #FF8F1F;
        }

        .student-name {
            font-size: 22px;
            margin: 15px 0;
        }

        .certificate-content {
            margin: 0 auto;
            width: 80%;
            text-align: center;
        }

        .topic-description {
            font-size: 12px;
            /* Reduced font size */
            color: #666;
        }

        .certificate-footer {
            margin-top: 20px;
        }
    </style>

    <script>
        // This function is triggered when the "Edit" button is clicked for a leave
        function editLeaveModal(id, startDate, endDate, reason) {
            // Set the form action to the leave edit route
            document.getElementById('editLeaveForm').action = '/student/leaves/' + id;

            // Populate the form fields with the leave data
            document.getElementById('edit_start_date').value = startDate;
            document.getElementById('edit_end_date').value = endDate;
            document.getElementById('edit_leave_reason').value = reason;

            // Show the modal
            var modal = new bootstrap.Modal(document.getElementById('editLeaveModal'));
            modal.show();
        }

        function triggerDeleteModal(leaveId) {
            // Set the action of the hidden delete form to the appropriate route
            document.getElementById('deleteLeaveForm').action = '/student/leaves/delete/' + leaveId;

            // Show the delete confirmation modal
            var modal = new bootstrap.Modal(document.getElementById('deleteLeaveModal'));
            modal.show();
        }

        function confirmDelete() {
            // Submit the form to delete the leave
            document.getElementById('deleteLeaveForm').submit();
        }
    </script>
@endsection
