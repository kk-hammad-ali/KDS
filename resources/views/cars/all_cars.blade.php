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
                    <li><span class="text-main-600 fw-normal text-15">Cars</span></li>
                </ul>
            </div>
            <!-- Breadcrumb End -->

            <!-- Breadcrumb Right Start -->
            <div class="flex-align gap-8 flex-wrap">
                <button class="btn btn-main text-sm btn-sm px-24 py-12 d-flex align-items-center gap-8"
                    data-bs-toggle="modal" data-bs-target="#addCarModal">
                    <i class="ph ph-car d-flex text-xl"></i> Add Car
                </button>
            </div>

        </div>

        <!-- Car Table Start -->
        <div class="card overflow-hidden">
            <div class="card-body p-0 overflow-x-auto">
                <table id="carsTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="fixed-width">
                                <div class="form-check">
                                    <input class="form-check-input border-gray-200 rounded-4" type="checkbox"
                                        id="selectAll">
                                </div>
                            </th>
                            <th class="h6 text-gray-300">#</th>
                            <th class="h6 text-gray-300">Make</th>
                            <th class="h6 text-gray-300">Model</th>
                            <th class="h6 text-gray-300">Registration Number</th>
                            <th class="h6 text-gray-300">Transmission</th>
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cars as $car)
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
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $car->make }}</span></td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $car->model }}</span></td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $car->registration_number }}</span>
                                </td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ ucfirst($car->transmission) }}</span>
                                </td>
                                <td>
                                    <button
                                        class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white"
                                        data-bs-toggle="modal" data-bs-target="#editCarModal" data-id="{{ $car->id }}"
                                        data-make="{{ $car->make }}" data-model="{{ $car->model }}"
                                        data-registration_number="{{ $car->registration_number }}"
                                        data-transmission="{{ $car->transmission }}">Edit</button>
                                    <button type="button"
                                        class="bg-danger text-white py-2 px-14 rounded-pill hover-bg-danger-600"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-car-id="{{ $car->id }}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer flex-between flex-wrap">
                <span class="text-gray-900">Showing {{ $cars->firstItem() }} to {{ $cars->lastItem() }} of
                    {{ $cars->total() }} entries</span>
                {{ $cars->links() }}
            </div>
        </div>
        <!-- Car Table End -->

        <!-- Add Car Modal -->
        <div class="modal fade" id="addCarModal" tabindex="-1" aria-labelledby="addCarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCarModalLabel">Add New Car</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.cars.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="make" class="form-label">Make</label>
                                <input type="text" class="form-control" id="make" name="make" required>
                            </div>

                            <div class="mb-3">
                                <label for="model" class="form-label">Model</label>
                                <input type="text" class="form-control" id="model" name="model" required>
                            </div>

                            <div class="mb-3">
                                <label for="registration_number" class="form-label">Registration Number</label>
                                <input type="text" class="form-control" id="registration_number"
                                    name="registration_number" required>
                            </div>

                            <div class="mb-3">
                                <label for="transmission" class="form-label">Transmission</label>
                                <select class="form-select" id="transmission" name="transmission" required>
                                    <option value="automatic">Automatic</option>
                                    <option value="manual">Manual</option>
                                </select>
                            </div>

                            <br>
                            <!-- Submit Button -->
                            <div class="flex-align justify-content-end gap-8 mt-4">
                                <button type="submit" class="btn btn-main rounded-pill py-9">Add Car</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Add Car Modal -->

        <!-- Edit Car Modal -->
        <div class="modal fade" id="editCarModal" tabindex="-1" aria-labelledby="editCarModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCarModalLabel">Edit Car</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editCarForm" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="edit_make" class="form-label">Make</label>
                                <input type="text" class="form-control" id="edit_make" name="make" required>
                            </div>

                            <div class="mb-3">
                                <label for="edit_model" class="form-label">Model</label>
                                <input type="text" class="form-control" id="edit_model" name="model" required>
                            </div>

                            <div class="mb-3">
                                <label for="edit_registration_number" class="form-label">Registration Number</label>
                                <input type="text" class="form-control" id="edit_registration_number"
                                    name="registration_number" required>
                            </div>

                            <div class="mb-3">
                                <label for="edit_transmission" class="form-label">Transmission</label>
                                <select class="form-select" id="edit_transmission" name="transmission" required>
                                    <option value="automatic">Automatic</option>
                                    <option value="manual">Manual</option>
                                </select>
                            </div>

                            <br>
                            <!-- Submit Button -->
                            <div class="flex-align justify-content-end gap-8 mt-4">
                                <button type="submit" class="btn btn-main rounded-pill py-9">Update Car</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Edit Car Modal -->

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this car?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form id="deleteCarForm" method="GET" action="">
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Delete Confirmation Modal -->

    </div>

    <!-- Script for handling Edit and Delete modals -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handling Edit Modal
            const editCarModal = document.getElementById('editCarModal');
            editCarModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const carId = button.getAttribute('data-id');
                const make = button.getAttribute('data-make');
                const model = button.getAttribute('data-model');
                const registrationNumber = button.getAttribute('data-registration_number');
                const transmission = button.getAttribute('data-transmission');

                // Fill form fields with existing data
                document.getElementById('edit_make').value = make;
                document.getElementById('edit_model').value = model;
                document.getElementById('edit_registration_number').value = registrationNumber;
                document.getElementById('edit_transmission').value = transmission;

                // Set form action
                const form = document.getElementById('editCarForm');
                form.action = `/admin/cars/${carId}`;
            });

            // Handling Delete Modal
            const deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const carId = button.getAttribute('data-car-id');
                const deleteForm = document.getElementById('deleteCarForm');
                deleteForm.action = `/admin/cars/delete/${carId}`;
            });
        });
    </script>
@endsection
