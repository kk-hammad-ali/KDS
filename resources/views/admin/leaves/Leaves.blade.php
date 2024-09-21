@extends('layout.admin')

@section('page_content')
    <style>
        td {
            min-width: 120px;
        }

        .status-btn {
            border: none;
            padding: 5px 10px;
            color: white;
            border-radius: 4px;
            font-weight: bold;
        }
    </style>
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">All Leaves</h4>
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
                                            @if ($leave->status == 'pending')
                                                <form action="{{ route('admin.updateLeaveStatus') }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    <input type="hidden" name="leave_id" id="leave_id_{{ $leave->id }}">
                                                    <button type="button" class="btn btn-success"
                                                        onclick="confirmApprove('{{ $leave->id }}')">Approve</button>
                                                    <button type="button" class="btn btn-danger"
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
                </div>
            </div>
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
                        <button type="submit" name="status" value="rejected" class="btn btn-danger">Reject</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="approveSuccessModal" tabindex="-1" role="dialog"
        aria-labelledby="approveSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveSuccessModalLabel">Leave Approved</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (session('success_approved'))
                        <div class="alert alert-success">
                            {{ session('success_approved') }}
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rejectSuccessModal" tabindex="-1" role="dialog"
        aria-labelledby="rejectSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectSuccessModalLabel">Leave Rejected</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (session('success_rejected'))
                        <div class="alert alert-danger">
                            {{ session('success_rejected') }}
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
