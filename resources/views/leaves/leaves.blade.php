@extends('layout.admin-new')

@section('content')
    <div class="dashboard-body">
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <!-- Breadcrumb Start -->
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('admin.dashboard') }}"
                            class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                    <li><span class="text-main-600 fw-normal text-15">Leaves</span></li>
                </ul>
            </div>
            <!-- Breadcrumb End -->
        </div>

        <div class="card overflow-hidden">
            <div class="card-body p-0">
                <table id="leaveTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="fixed-width">
                                <div class="form-check">
                                    <input class="form-check-input border-gray-200 rounded-4" type="checkbox"
                                        id="selectAll">
                                </div>
                            </th>
                            <th class="h6 text-gray-300">User Name</th>
                            <th class="h6 text-gray-300">Role</th>
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
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $leave->user->name }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">
                                        @if ($leave->user->role == 2)
                                            Student
                                        @else
                                            Employee
                                        @endif
                                    </span>
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
                                    @if ($leave->status == 'pending')
                                        <form action="{{ route('admin.updateLeaveStatus') }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            <input type="hidden" name="leave_id" id="leave_id_{{ $leave->id }}">
                                            <button type="button"
                                                class="bg-success-50 text-success-600 py-2 px-14 rounded-pill hover-bg-success-600 hover-text-white"
                                                onclick="confirmApprove('{{ $leave->id }}')">Approve</button>
                                            <button type="button"
                                                class="bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-danger-600 hover-text-white"
                                                onclick="confirmReject('{{ $leave->id }}')">Reject</button>
                                        </form>
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
                <span class="text-gray-900">Showing {{ $leaves->firstItem() }} to {{ $leaves->lastItem() }} of
                    {{ $leaves->total() }} entries</span>
                {{ $leaves->links() }}
            </div>
        </div>

        <!-- Approve Confirmation Modal -->
        <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="approveModalLabel">Confirm Approval</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to approve this leave request?
                    </div>
                    <div class="modal-footer">
                        <form id="approveForm" method="POST" action="{{ route('admin.updateLeaveStatus') }}">
                            @csrf
                            <input type="hidden" name="leave_id" id="approve_leave_id">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="status" value="approved" class="btn btn-success">Approve</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reject Confirmation Modal -->
        <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rejectModalLabel">Confirm Rejection</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to reject this leave request?
                    </div>
                    <div class="modal-footer">
                        <form id="rejectForm" method="POST" action="{{ route('admin.updateLeaveStatus') }}">
                            @csrf
                            <input type="hidden" name="leave_id" id="reject_leave_id">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="status" value="rejected"
                                class="btn btn-danger">Reject</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        function confirmApprove(leaveId) {
            document.getElementById('approve_leave_id').value = leaveId;
            var approveModal = new bootstrap.Modal(document.getElementById('approveModal'));
            approveModal.show();
        }

        function confirmReject(leaveId) {
            document.getElementById('reject_leave_id').value = leaveId;
            var rejectModal = new bootstrap.Modal(document.getElementById('rejectModal'));
            rejectModal.show();
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success_approved'))
                var approveModal = new bootstrap.Modal(document.getElementById('approveSuccessModal'));
                approveModal.show();
            @endif

            @if (session('success_rejected'))
                var rejectModal = new bootstrap.Modal(document.getElementById('rejectSuccessModal'));
                rejectModal.show();
            @endif
        });
    </script>
@endsection
