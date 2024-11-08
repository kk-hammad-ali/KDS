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
                    <li><span class="text-main-600 fw-normal text-15">Branches</span></li>
                </ul>
            </div>
            <!-- Breadcrumb End -->

            <!-- Breadcrumb Right Start -->
            <div class="flex-align gap-8 flex-wrap">
                <button type="button" class="btn btn-main text-sm btn-sm px-24 py-12 d-flex align-items-center gap-8"
                    data-bs-toggle="modal" data-bs-target="#addBranchModal">
                    <i class="ph ph-plus-circle text-xl"></i> Add Branch
                </button>
            </div>
        </div>

        <!-- Card with table -->
        <div class="card overflow-hidden">
            <div class="card-body p-0 overflow-x-auto">
                <table id="branchTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300">Branch Name</th>
                            <th class="h6 text-gray-300">Address</th>
                            {{-- <th class="h6 text-gray-300">Manager</th> --}}
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($branches as $branch)
                            <tr>
                                <td class="h6 mb-0 fw-medium text-gray-300">{{ $branch->name }}</td>
                                <td class="h6 mb-0 fw-medium text-gray-300">{{ $branch->address }}</td>
                                {{-- <td class="h6 mb-0 fw-medium text-gray-300">{{ $branch->manager->name }}</td> --}}
                                <td>
                                    <!-- Edit and Delete buttons -->
                                    <button type="button"
                                        class="bg-warning text-white py-2 px-14 rounded-pill hover-bg-warning-600"
                                        data-bs-toggle="modal" data-bs-target="#editBranchModal"
                                        data-id="{{ $branch->id }}" data-name="{{ $branch->name }}"
                                        data-address="{{ $branch->address }}"
                                        data-manager="{{ $branch->manager_id }}">Edit</button>

                                    <button type="button"
                                        class="bg-danger text-white py-2 px-14 rounded-pill hover-bg-danger-600"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-branch-id="{{ $branch->id }}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
                        Are you sure you want to delete this branch?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form id="deleteBranchForm" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Branch Modal -->
        <div class="modal fade" id="addBranchModal" tabindex="-1" aria-labelledby="addBranchModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addBranchModalLabel">Add Branch</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form for adding a branch -->
                        <form action="{{ route('admin.branches.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <!-- Branch Name -->
                                <div class="col-sm-12 mb-3">
                                    <label for="name" class="h5 mb-8 fw-semibold font-heading">Branch Name <span
                                            class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Address -->
                                <div class="col-sm-12 mb-3">
                                    <label for="address" class="h5 mb-8 fw-semibold font-heading">Address <span
                                            class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <input type="text" name="address"
                                        class="form-control @error('address') is-invalid @enderror" required>
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- <!-- Manager -->
                                <div class="col-sm-12 mb-3">
                                    <label for="manager_id" class="h5 mb-8 fw-semibold font-heading">Assign Manager <span
                                            class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <select name="manager_id"
                                        class="form-select @error('manager_id') is-invalid @enderror" required>
                                        @foreach ($managers as $manager)
                                            <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('manager_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div> --}}
                            </div>
                            <br>
                            <!-- Submit Button -->
                            <div class="flex-align justify-content-end gap-8 mt-4">
                                <button type="submit" class="btn btn-main rounded-pill py-9">Add Branch</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Branch Modal -->
        <div class="modal fade" id="editBranchModal" tabindex="-1" aria-labelledby="editBranchModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBranchModalLabel">Edit Branch</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form for editing a branch -->
                        <form id="editBranchForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <!-- Branch Name -->
                                <div class="col-sm-12 mb-3">
                                    <label for="editName" class="h5 mb-8 fw-semibold font-heading">Branch Name <span
                                            class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <input type="text" name="name" id="editName"
                                        class="form-control @error('name') is-invalid @enderror" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Address -->
                                <div class="col-sm-12 mb-3">
                                    <label for="editAddress" class="h5 mb-8 fw-semibold font-heading">Address <span
                                            class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <input type="text" name="address" id="editAddress"
                                        class="form-control @error('address') is-invalid @enderror" required>
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- <!-- Manager -->
                                <div class="col-sm-12 mb-3">
                                    <label for="editManager" class="h5 mb-8 fw-semibold font-heading">Assign Manager <span
                                            class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <select name="manager_id" id="editManager"
                                        class="form-select @error('manager_id') is-invalid @enderror" required>
                                        @foreach ($managers as $manager)
                                            <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('manager_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div> --}}
                            </div>
                            <br>
                            <!-- Submit Button -->
                            <div class="flex-align justify-content-end gap-8 mt-4">
                                <button type="submit" class="btn btn-main rounded-pill py-9">Update Branch</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Script to handle Edit and Delete Modals -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const editBranchModal = document.getElementById('editBranchModal');
                const deleteModal = document.getElementById('deleteModal');

                // Edit modal
                editBranchModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const id = button.getAttribute('data-id');
                    const name = button.getAttribute('data-name');
                    const address = button.getAttribute('data-address');
                    // const manager = button.getAttribute('data-manager');

                    const form = document.getElementById('editBranchForm');
                    form.action = `/admin/branch/update/${id}`;

                    document.getElementById('editName').value = name;
                    document.getElementById('editAddress').value = address;
                    // document.getElementById('editManager').value = manager;
                });

                // Delete modal
                deleteModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const branchId = button.getAttribute('data-branch-id');
                    const deleteForm = document.getElementById('deleteBranchForm');
                    deleteForm.action = `/admin/branch/delete/${branchId}`;
                });
            });
        </script>
    </div>
@endsection
