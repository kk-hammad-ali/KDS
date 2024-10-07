@extends('layout.instructor-new')

@section('content')
    <div class="dashboard-body">
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <!-- Breadcrumb Start -->
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('instructor.dashboard') }}"
                            class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                    <li><span class="text-main-600 fw-normal text-15">Leaves</span></li>
                </ul>
            </div>
            <!-- Breadcrumb End -->

            <!-- Breadcrumb Right Start -->
            <div class="flex-align gap-8 flex-wrap">
                <a href="{{ route('instructor.addLeaves') }}"
                    class="btn btn-main text-sm btn-sm px-24 py-12 d-flex align-items-center gap-8">
                    <i class="ph ph-plus d-flex text-xl"></i> <!-- Changed icon to a more relevant one -->
                    Apply Leave
                </a>
            </div>
        </div>

        <div class="card overflow-hidden">
            <div class="card-body p-0 overflow-x-auto">
                <table id="leavesTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="fixed-width">
                                <div class="form-check">
                                    <input class="form-check-input border-gray-200 rounded-4" type="checkbox"
                                        id="selectAll">
                                </div>
                            </th>
                            <th class="h6 text-gray-300">#</th>
                            <th class="h6 text-gray-300">Start Date</th>
                            <th class="h6 text-gray-300">End Date</th>
                            <th class="h6 text-gray-300">Reason</th>
                            <th class="h6 text-gray-300">Status</th>
                            <th class="h6 text-gray-300">Actions</th>
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
                                    <div class="flex-align gap-8">
                                        <span class="h6 mb-0 fw-medium text-gray-300">{{ $loop->iteration }}</span>
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
                                    @php
                                        $statusClass = match ($leave->status) {
                                            'pending' => 'bg-warning text-white',
                                            'approved' => 'bg-success text-white',
                                            'rejected' => 'bg-danger text-white',
                                            default => 'bg-secondary text-white',
                                        };
                                    @endphp
                                    <span class="h6 mb-0 fw-medium py-2 px-14 rounded-pill {{ $statusClass }}">
                                        {{ ucfirst($leave->status) }}
                                    </span>
                                </td>
                                <td>
                                    @if ($leave->status === 'pending')
                                        <a href="{{ route('instructor.editLeave', $leave) }}"
                                            class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">Edit</a>

                                        <button type="button"
                                            class="bg-danger text-white py-2 px-14 rounded-pill hover-bg-danger-600"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            data-leave-id="{{ $leave->id }}">Delete</button>
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

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this leave?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form id="deleteLeaveForm" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
