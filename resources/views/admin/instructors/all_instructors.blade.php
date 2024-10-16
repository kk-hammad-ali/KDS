@extends('layout.layout')

@section('content')
    <div class="dashboard-body">
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <!-- Breadcrumb Start -->
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('admin.dashboard') }}"
                            class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                    <li><span class="text-main-600 fw-normal text-15">Instructors</span></li>
                </ul>
            </div>
            <!-- Breadcrumb End -->

            <!-- Breadcrumb Right Start -->
            <div class="flex-align gap-8 flex-wrap">
                <a href="{{ route('admin.addInstructor') }}"
                    class="btn btn-main text-sm btn-sm px-24 py-12 d-flex align-items-center gap-8">
                    <i class="ph ph-user-plus d-flex text-xl"></i> Add Instructor
                </a>
            </div>

        </div>

        <!-- Instructor Table Start -->
        <div class="card overflow-hidden">
            <div class="card-body p-0 overflow-x-auto">
                <table id="instructorTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="fixed-width">
                                <div class="form-check">
                                    <input class="form-check-input border-gray-200 rounded-4" type="checkbox"
                                        id="selectAll">
                                </div>
                            </th>
                            <th class="h6 text-gray-300">#</th>
                            <th class="h6 text-gray-300">Profile Picture</th>
                            <th class="h6 text-gray-300">Name</th>
                            <th class="h6 text-gray-300">Phone Number</th>
                            <th class="h6 text-gray-300">License City</th>
                            <th class="h6 text-gray-300">License Number</th>
                            <th class="h6 text-gray-300">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($instructors as $instructor)
                            <tr>
                                <td class="fixed-width">
                                    <div class="form-check">
                                        <input class="form-check-input border-gray-200 rounded-4" type="checkbox">
                                    </div>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $loop->iteration }}</span>
                                </td>
                                <td>
                                    @if ($instructor->employee->picture)
                                        <img src="{{ asset('storage/' . $instructor->employee->picture) }}"
                                            class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
                                    @else
                                        <img src="{{ asset('storage/default-profile.png') }}"
                                            class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
                                    @endif
                                </td>
                                <td><span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ $instructor->employee->user->name }}</span>
                                </td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $instructor->employee->phone }}</span>
                                </td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $instructor->license_city }}</span>
                                </td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $instructor->license_number }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.editInstructor', $instructor->id) }}"
                                        class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">Edit</a>
                                    <button type="button"
                                        class="bg-danger text-white py-2 px-14 rounded-pill hover-bg-danger-600"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-instructor-id="{{ $instructor->id }}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer flex-between flex-wrap">
                <span class="text-gray-900">
                    Showing {{ $instructors->firstItem() }} to {{ $instructors->lastItem() }} of
                    {{ $instructors->total() }} entries
                </span>
                {{ $instructors->links() }}
            </div>
        </div>
        <!-- Instructor Table End -->

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this instructor?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form id="deleteInstructorForm" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script for passing instructor ID to delete form -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const instructorId = button.getAttribute('data-instructor-id');
                const deleteForm = document.getElementById('deleteInstructorForm');
                deleteForm.action = `/admin/instructors/delete/${instructorId}`;
            });
        });
    </script>
@endsection
