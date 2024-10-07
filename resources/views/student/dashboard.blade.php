@extends('layout.student-new')

@section('content')
    <div class="dashboard-body">
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

        {{-- <div class="card overflow-hidden">
            <div class="card-body p-0 overflow-x-auto">
                <table id="scheduleTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300">Class Start Date</th>
                            <th class="h6 text-gray-300">Class End Date</th>
                            <th class="h6 text-gray-300">Start Time</th>
                            <th class="h6 text-gray-300">End Time</th>
                            <th class="h6 text-gray-300">Instructor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedulesPaginated as $schedule)
                            <tr>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $schedule->class_date }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $schedule->class_end_date }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $schedule->start_time }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $schedule->end_time }}</span>
                                </td>
                                <td>
                                    <span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ $schedule->instructor->employee->user->name }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> --}}

        <br>

        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8 mt-5">
            <!-- Breadcrumb Start -->
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">

                    <li><span class="text-main-600 fw-normal text-15">MY LEAVES</span></li>
                </ul>
            </div>
            <!-- Breadcrumb End -->

            <a href="#addLeaveModal" class="btn btn-main text-sm btn-sm px-24 py-12 d-flex align-items-center gap-8"
                data-bs-toggle="modal" data-bs-target="#addLeaveModal">
                <i class="ph ph-calendar-blank d-flex text-xl"></i>
                Apply Leave
            </a>


        </div>

        <div class="card overflow-hidden">
            <div class="card-body p-0 overflow-x-auto">
                <table id="leaveTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="fixed-width">
                                <div class="form-check">
                                    <input class="form-check-input border-gray-200 rounded-4" type="checkbox"
                                        id="selectAll">
                                </div>
                            </th>
                            <th class="h6 text-gray-300">Start Date</th>
                            <th class="h6 text-gray-300">End Date</th>
                            <th class="h6 text-gray-300">Reason</th>
                            <th class="h6 text-gray-300">Status</th>
                            <th class="h6 text-gray-300">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaves as $leave)
                            <tr>
                                <td class="fixed-width">
                                    <div class="form-check">
                                        <input class="form-check-input border-gray-200 rounded-4" type="checkbox">
                                    </div>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $leave->start_date }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $leave->end_date }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $leave->leave_reason }}</span>
                                </td>
                                <td>
                                    <span
                                        class="text-13 py-2 px-8 bg-{{ $leave->status == 'approved' ? 'green' : ($leave->status == 'rejected' ? 'danger' : 'warning') }}-50 text-{{ $leave->status == 'approved' ? 'green' : ($leave->status == 'rejected' ? 'danger' : 'warning') }}-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                        <span
                                            class="w-6 h-6 bg-{{ $leave->status == 'approved' ? 'green' : ($leave->status == 'rejected' ? 'danger' : 'warning') }}-600 rounded-circle flex-shrink-0"></span>
                                        {{ ucfirst($leave->status) }}
                                    </span>
                                </td>
                                <td>
                                    @if ($leave->status === 'pending')
                                        <!-- Edit Button triggers the modal and passes the leave ID -->
                                        <button
                                            class="bg-warning text-white py-2 px-14 rounded-pill hover-bg-warning-600 hover-text-white"
                                            data-bs-toggle="modal" data-bs-target="#editLeaveModal"
                                            data-id="{{ $leave->id }}" data-start_date="{{ $leave->start_date }}"
                                            data-end_date="{{ $leave->end_date }}"
                                            data-leave_reason="{{ $leave->leave_reason }}">
                                            Edit
                                        </button>
                                        <button
                                            class="bg-danger text-white py-2 px-14 rounded-pill hover-bg-danger-600 hover-text-white"
                                            data-bs-toggle="modal" data-bs-target="#deleteLeaveModal"
                                            data-leave-id="{{ $leave->id }}">
                                            Delete
                                        </button>
                                    @else
                                        <span class="text-muted">Status updated</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer flex-between flex-wrap">
                <span class="text-gray-900">
                    Showing {{ $leaves->firstItem() }} to {{ $leaves->lastItem() }} of {{ $leaves->total() }} entries
                </span>

                <!-- Default pagination links -->
                {{ $leaves->links() }}
            </div>
        </div>
    </div>


    <!-- Add Leave Modal -->
    <div class="modal fade" id="addLeaveModal" tabindex="-1" aria-labelledby="addLeaveModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLeaveModalLabel">Apply for Leave</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for applying for leave -->
                    <form action="{{ route('student.leaves.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Start Date -->
                            <div class="col-sm-12 mb-3">
                                <label for="start_date" class="h5 mb-8 fw-semibold font-heading">Start Date <span
                                        class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                <input type="date" name="start_date"
                                    class="form-control @error('start_date') is-invalid @enderror"
                                    value="{{ old('start_date') }}" required>
                                @error('start_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- End Date -->
                            <div class="col-sm-12 mb-3">
                                <label for="end_date" class="h5 mb-8 fw-semibold font-heading">End Date <span
                                        class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                <input type="date" name="end_date"
                                    class="form-control @error('end_date') is-invalid @enderror"
                                    value="{{ old('end_date') }}" required>
                                @error('end_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Leave Reason -->
                            <div class="col-sm-12 mb-3">
                                <label for="leave_reason" class="h5 mb-8 fw-semibold font-heading">Reason <span
                                        class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                <textarea name="leave_reason" class="form-control @error('leave_reason') is-invalid @enderror" rows="3" required>{{ old('leave_reason') }}</textarea>
                                @error('leave_reason')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <br>
                        <!-- Submit Button -->
                        <div class="flex-align justify-content-end gap-8 mt-4">
                            <button type="submit" class="btn btn-main rounded-pill py-9">Apply Leave</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Leave Modal -->
    <div class="modal fade" id="editLeaveModal" tabindex="-1" aria-labelledby="editLeaveModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLeaveModalLabel">Edit Leave</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for editing leave -->
                    <form id="editLeaveForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <!-- Start Date -->
                            <div class="col-sm-12 mb-3">
                                <label for="edit_start_date" class="h5 mb-8 fw-semibold font-heading">Start Date <span
                                        class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                <input type="date" name="start_date" id="edit_start_date" class="form-control"
                                    required>
                            </div>

                            <!-- End Date -->
                            <div class="col-sm-12 mb-3">
                                <label for="edit_end_date" class="h5 mb-8 fw-semibold font-heading">End Date <span
                                        class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                <input type="date" name="end_date" id="edit_end_date" class="form-control" required>
                            </div>

                            <!-- Leave Reason -->
                            <div class="col-sm-12 mb-3">
                                <label for="edit_leave_reason" class="h5 mb-8 fw-semibold font-heading">Reason <span
                                        class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                <textarea name="leave_reason" id="edit_leave_reason" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>

                        <br>
                        <!-- Submit Button -->
                        <div class="flex-align justify-content-end gap-8 mt-4">
                            <button type="submit" class="btn btn-main rounded-pill py-9">Update Leave</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Delete Leave Modal -->
    <div class="modal fade" id="deleteLeaveModal" tabindex="-1" aria-labelledby="deleteLeaveModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteLeaveModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this leave?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteLeaveForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Edit Modal
            const editLeaveModal = document.getElementById('editLeaveModal');
            editLeaveModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget; // Button that triggered the modal
                const id = button.getAttribute('data-id');
                const startDate = button.getAttribute('data-start_date');
                const endDate = button.getAttribute('data-end_date');
                const reason = button.getAttribute('data-leave_reason');

                // Update the form action and populate fields
                const form = document.getElementById('editLeaveForm');
                form.action = `/student/leaves/${id}`;
                document.getElementById('edit_start_date').value = startDate;
                document.getElementById('edit_end_date').value = endDate;
                document.getElementById('edit_leave_reason').value = reason;
            });

            // Delete Modal
            const deleteLeaveModal = document.getElementById('deleteLeaveModal');
            deleteLeaveModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget; // Button that triggered the modal
                const leaveId = button.getAttribute('data-leave-id');

                const deleteForm = document.getElementById('deleteLeaveForm');
                deleteForm.action = `/student/leaves/delete/${leaveId}`;

            });
        });
    </script>
    <script>
        var events = @json($events);
    </script>
@endsection
