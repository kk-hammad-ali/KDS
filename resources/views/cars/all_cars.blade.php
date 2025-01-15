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
                    <li><span class="text-main-600 fw-normal text-15">Car</span></li>
                </ul>
            </div>
            <!-- Breadcrumb End -->

            <!-- Breadcrumb Right Start -->
            <div class="flex-align gap-8 flex-wrap">
                <button class="btn btn-main text-sm btn-sm px-24 py-12 d-flex align-items-center gap-8"
                    data-bs-toggle="modal" data-bs-target="#addCarModelModal">
                    <i class="ph ph-car-simple d-flex text-xl"></i> Add Car Model
                </button>
                <button class="btn btn-main text-sm btn-sm px-24 py-12 d-flex align-items-center gap-8"
                    data-bs-toggle="modal" data-bs-target="#addCarModal">
                    <i class="ph ph-car d-flex text-xl"></i> Add Car
                </button>
            </div>
        </div>

        <!-- Car Models Table Start -->
        <div class="card overflow-hidden">
            <div class="card-body p-0 overflow-x-auto">
                <table id="carModelsTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300">#</th>
                            <th class="h6 text-gray-300">Name</th>
                            <th class="h6 text-gray-300">Transmission</th>
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carModels as $carModel)
                            <tr>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $loop->iteration }}</span></td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $carModel->name }}</span></td>
                                <td><span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ ucfirst($carModel->transmission) }}</span>
                                </td>
                                <td>
                                    <button
                                        class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white"
                                        data-bs-toggle="modal" data-bs-target="#editCarModelModal"
                                        data-id="{{ $carModel->id }}" data-name="{{ $carModel->name }}"
                                        data-transmission="{{ $carModel->transmission }}">Edit</button>
                                    <button type="button"
                                        class="bg-danger text-white py-2 px-14 rounded-pill hover-bg-danger-600"
                                        data-bs-toggle="modal" data-bs-target="#deleteCarModelModal"
                                        data-car-model-id="{{ $carModel->id }}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer flex-between flex-wrap">
                <span class="text-gray-900">Showing {{ $carModels->firstItem() }} to {{ $carModels->lastItem() }} of
                    {{ $carModels->total() }} entries</span>
                <ul class="pagination flex-align flex-wrap">
                    @if ($carModels->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">Prev</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
                                href="{{ $carModels->previousPageUrl() }}">Prev</a>
                        </li>
                    @endif

                    @foreach ($carModels->links()->elements[0] as $page => $url)
                        @if ($page == $carModels->currentPage())
                            <li class="page-item active">
                                <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
                                    href="#">{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
                                    href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach

                    @if ($carModels->hasMorePages())
                        <li class="page-item">
                            <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
                                href="{{ $carModels->nextPageUrl() }}">Next</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">Next</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- Car Models Table End -->

        <!-- Add Car Model Modal -->
        <div class="modal fade" id="addCarModelModal" tabindex="-1" aria-labelledby="addCarModelModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCarModelModalLabel">Add New Car Model</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.carModels.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
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
                                <button type="submit" class="btn btn-main rounded-pill py-9">Add Car Model</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Add Car Model Modal -->

        <!-- Edit Car Model Modal -->
        <div class="modal fade" id="editCarModelModal" tabindex="-1" aria-labelledby="editCarModelModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCarModelModalLabel">Edit Car Model</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editCarModelForm" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="edit_name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="edit_name" name="name" required>
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
                                <button type="submit" class="btn btn-main rounded-pill py-9">Update Car Model</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Edit Car Model Modal -->


        <!-- Car Table Start -->
        <div class="card overflow-hidden mt-20">
            <div class="card-body p-0 overflow-x-auto">
                <table id="carsTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300">#</th>
                            <th class="h6 text-gray-300">Car Model</th>
                            <th class="h6 text-gray-300">Registration Number</th>
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cars as $car)
                            <tr>
                                <td>
                                    <div class="flex-align gap-8">
                                        <span class="h6 mb-0 fw-medium text-gray-300">{{ $loop->iteration }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $car->carModel->name }}
                                        ({{ ucfirst($car->carModel->transmission) }})
                                    </span>
                                </td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $car->registration_number }}</span>
                                </td>
                                <td>
                                    <button
                                        class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white"
                                        data-bs-toggle="modal" data-bs-target="#editCarModal"
                                        data-id="{{ $car->id }}" data-car_model_id="{{ $car->car_model_id }}"
                                        data-registration_number="{{ $car->registration_number }}">Edit</button>
                                    <button type="button"
                                        class="bg-danger text-white py-2 px-14 rounded-pill hover-bg-danger-600"
                                        data-bs-toggle="modal" data-bs-target="#deleteCarModal"
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
                <ul class="pagination flex-align flex-wrap">
                    @if ($cars->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">Prev</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
                                href="{{ $cars->previousPageUrl() }}">Prev</a>
                        </li>
                    @endif

                    @foreach ($cars->links()->elements[0] as $page => $url)
                        @if ($page == $cars->currentPage())
                            <li class="page-item active">
                                <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
                                    href="#">{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
                                    href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach

                    @if ($cars->hasMorePages())
                        <li class="page-item">
                            <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
                                href="{{ $cars->nextPageUrl() }}">Next</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">Next</a>
                        </li>
                    @endif
                </ul>
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
                                <label for="car_model_id" class="form-label">Car Model</label>
                                <select class="form-select" id="car_model_id" name="car_model_id" required>
                                    @foreach ($carModels as $carModel)
                                        <option value="{{ $carModel->id }}">{{ $carModel->name }}
                                            ({{ ucfirst($carModel->transmission) }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="registration_number" class="form-label">Registration Number</label>
                                <input type="text" class="form-control" id="registration_number"
                                    name="registration_number" required>
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
                                <label for="edit_car_model_id" class="form-label">Car Model</label>
                                <select class="form-select" id="edit_car_model_id" name="car_model_id" required>
                                    @foreach ($carModels as $carModel)
                                        <option value="{{ $carModel->id }}">{{ $carModel->name }}
                                            ({{ ucfirst($carModel->transmission) }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="edit_registration_number" class="form-label">Registration Number</label>
                                <input type="text" class="form-control" id="edit_registration_number"
                                    name="registration_number" required>
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

        <!-- Delete Car Model Confirmation Modal -->
        <div class="modal fade" id="deleteCarModelModal" tabindex="-1" aria-labelledby="deleteCarModelModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteCarModelModalLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this car model?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form id="deleteCarModelForm" method="GET" action="">
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Delete Car Model Confirmation Modal -->

        <!-- Delete Car Confirmation Modal -->
        <div class="modal fade" id="deleteCarModal" tabindex="-1" aria-labelledby="deleteCarModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteCarModalLabel">Confirm Delete</h5>
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
        <!-- End Delete Car Confirmation Modal -->

    </div>

    <!-- Script for handling Edit and Delete modals -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handling Edit Modal
            const editCarModelModal = document.getElementById('editCarModelModal');
            editCarModelModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const carModelId = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const transmission = button.getAttribute('data-transmission');

                // Fill form fields with existing data
                document.getElementById('edit_name').value = name;
                document.getElementById('edit_transmission').value = transmission;

                // Set form action
                const form = document.getElementById('editCarModelForm');
                form.action = `/admin/car-models/${carModelId}`;
            });
        });
    </script>

    <!-- Script for handling Edit and Delete modals -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handling Edit Modal
            const editCarModal = document.getElementById('editCarModal');
            editCarModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const carId = button.getAttribute('data-id');
                const carModelId = button.getAttribute('data-car_model_id');
                const registrationNumber = button.getAttribute('data-registration_number');

                // Fill form fields with existing data
                document.getElementById('edit_car_model_id').value = carModelId;
                document.getElementById('edit_registration_number').value = registrationNumber;

                // Set form action
                const form = document.getElementById('editCarForm');
                form.action = `/admin/cars/${carId}`;
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handling Delete Car Model Modal
            const deleteCarModelModal = document.getElementById('deleteCarModelModal');
            deleteCarModelModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const carModelId = button.getAttribute('data-car-model-id');
                const deleteForm = document.getElementById('deleteCarModelForm');
                deleteForm.action = `/admin/car-models/delete/${carModelId}`;
            });

            // Handling Delete Car Modal
            const deleteCarModal = document.getElementById('deleteCarModal');
            deleteCarModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const carId = button.getAttribute('data-car-id');
                const deleteForm = document.getElementById('deleteCarForm');
                deleteForm.action = `/admin/cars/delete/${carId}`;
            });
        });
    </script>
@endsection
