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
                    <li><span class="text-main-600 fw-normal text-15">Courses</span></li>
                </ul>
            </div>
            <!-- Breadcrumb End -->

            <!-- Breadcrumb Right Start -->
            <div class="flex-align gap-8 flex-wrap">
                <button class="btn btn-main text-sm btn-sm px-24 py-12 d-flex align-items-center gap-8"
                    data-bs-toggle="modal" data-bs-target="#addCourseModal">
                    <i class="ph ph-book-open d-flex text-xl"></i> Add Course
                </button>
            </div>
        </div>

        <!-- Courses Table Start -->
        <div class="card overflow-hidden">
            <div class="card-body p-0 overflow-x-auto">
                <table id="coursesTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="fixed-width">
                                <div class="form-check">
                                    <input class="form-check-input border-gray-200 rounded-4" type="checkbox"
                                        id="selectAll">
                                </div>
                            </th>
                            <th class="h6 text-gray-300">#</th>
                            <th class="h6 text-gray-300">Car Details</th> <!-- Combined Column -->
                            <th class="h6 text-gray-300">Duration (Days)</th>
                            <th class="h6 text-gray-300">Duration (Minutes)</th>
                            <th class="h6 text-gray-300">Fees</th>
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
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
                                    <span class="h6 mb-0 fw-medium text-gray-300">
                                        {{ $course->car ? $course->car->make . ' - ' . $course->car->registration_number : 'N/A' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $course->duration_days }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $course->duration_minutes }}</span>
                                </td>
                                <td>
                                    <span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ number_format($course->fees, 2) }}</span>
                                </td>
                                <td>
                                    <button
                                        class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white"
                                        data-bs-toggle="modal" data-bs-target="#editCourseModal"
                                        data-id="{{ $course->id }}" data-car-id="{{ $course->car->id }}"
                                        data-transmission="{{ $course->car->transmission }}"
                                        data-make="{{ $course->car->make }}" data-model="{{ $course->car->model }}"
                                        data-registration="{{ $course->car->registration_number }}"
                                        data-duration_days="{{ $course->duration_days }}"
                                        data-duration_minutes="{{ $course->duration_minutes }}"
                                        data-fees="{{ $course->fees }}">
                                        Edit
                                    </button>

                                    <button type="button"
                                        class="bg-danger text-white py-2 px-14 rounded-pill hover-bg-danger-600"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-course-id="{{ $course->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer flex-between flex-wrap">
            <span class="text-gray-900">Showing {{ $courses->firstItem() }} to {{ $courses->lastItem() }} of
                {{ $courses->total() }} entries</span>
            {{ $courses->links() }}
        </div>
    </div>
    <!-- Courses Table End -->

    <!-- Add Course Modal -->
    <div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCourseModalLabel">Add New Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.courses.store') }}" method="POST">
                        @csrf
                        <!-- Transmission Selection -->
                        <div class="mb-3">
                            <label for="transmission" class="form-label">Transmission</label>
                            <select class="form-select" id="transmission" required>
                                <option value="">Select Transmission</option>
                                <option value="automatic">Automatic</option>
                                <option value="manual">Manual</option>
                            </select>
                        </div>

                        <!-- Make Selection -->
                        <div class="mb-3">
                            <label for="make" class="form-label">Make</label>
                            <select class="form-select" id="make" required>
                                <option value="">Select Make</option>
                                <!-- Options will be populated dynamically -->
                            </select>
                        </div>

                        <!-- Car Selection -->
                        <div class="mb-3">
                            <label for="car_id" class="form-label">Select Car</label>
                            <select class="form-select" id="car_id" name="car_id" required>
                                <option value="">Select Car</option>
                                <!-- Filtered options will appear here -->
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="duration_days" class="form-label">Duration (Days)</label>
                            <input type="number" class="form-control" id="duration_days" name="duration_days" required>
                        </div>

                        <div class="mb-3">
                            <label for="duration_minutes" class="form-label">Duration (Minutes)</label>
                            <input type="number" class="form-control" id="duration_minutes" name="duration_minutes"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="fees" class="form-label">Fees</label>
                            <input type="number" class="form-control" id="fees" name="fees" step="0.01"
                                required>
                        </div>

                        <div class="flex-align justify-content-end gap-8 mt-4">
                            <button type="submit" class="btn btn-main rounded-pill py-9">Add Course</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add Course Modal -->


    <!-- Edit Course Modal -->
    <div class="modal fade" id="editCourseModal" tabindex="-1" aria-labelledby="editCourseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCourseModalLabel">Edit Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editCourseForm" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Transmission Selection -->
                        <div class="mb-3">
                            <label for="edit_transmission" class="form-label">Transmission</label>
                            <select class="form-select" id="edit_transmission" required>
                                <option value="">Select Transmission</option>
                                <option value="automatic">Automatic</option>
                                <option value="manual">Manual</option>
                            </select>
                        </div>

                        <!-- Make Selection -->
                        <div class="mb-3">
                            <label for="edit_make" class="form-label">Make</label>
                            <select class="form-select" id="edit_make" required>
                                <option value="">Select Make</option>
                                <!-- Options will be populated dynamically -->
                            </select>
                        </div>

                        <!-- Car Selection -->
                        <div class="mb-3">
                            <label for="edit_car_id" class="form-label">Select Car</label>
                            <select class="form-select" id="edit_car_id" name="car_id" required>
                                <option value="">Select Car</option>
                                <!-- Filtered options will appear here -->
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="edit_duration_days" class="form-label">Duration (Days)</label>
                            <input type="number" class="form-control" id="edit_duration_days" name="duration_days"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_duration_minutes" class="form-label">Duration (Minutes)</label>
                            <input type="number" class="form-control" id="edit_duration_minutes"
                                name="duration_minutes" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_fees" class="form-label">Fees</label>
                            <input type="number" class="form-control" id="edit_fees" name="fees" step="0.01"
                                required>
                        </div>

                        <div class="flex-align justify-content-end gap-8 mt-4">
                            <button type="submit" class="btn btn-main rounded-pill py-9">Update Course</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Edit Course Modal -->



    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this course?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteCourseForm" method="GET" action="">
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
            const cars = @json($cars); // Pass the cars data from the server to JavaScript

            // Get elements for Add Modal
            const transmissionSelect = document.getElementById('transmission');
            const makeSelect = document.getElementById('make');
            const carSelect = document.getElementById('car_id');

            // Get elements for Edit Modal
            const editTransmissionSelect = document.getElementById('edit_transmission');
            const editMakeSelect = document.getElementById('edit_make');
            const editCarSelect = document.getElementById('edit_car_id');

            // Populate dropdowns in the Add Modal
            transmissionSelect.addEventListener('change', function() {
                filterMakes(transmissionSelect, makeSelect, carSelect);
            });
            makeSelect.addEventListener('change', function() {
                filterCars(transmissionSelect, makeSelect, carSelect);
            });

            document.getElementById('editCourseModal').addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const carId = button.getAttribute('data-car-id');
                const transmission = button.getAttribute('data-transmission');
                const make = button.getAttribute('data-make');
                const durationDays = button.getAttribute('data-duration_days');
                const durationMinutes = button.getAttribute('data-duration_minutes');
                const fees = button.getAttribute('data-fees');

                // Fill form fields with existing data
                document.getElementById('edit_duration_days').value = durationDays;
                document.getElementById('edit_duration_minutes').value = durationMinutes;
                document.getElementById('edit_fees').value = fees;

                // Set the transmission value and populate the make dropdown
                editTransmissionSelect.value = transmission;
                console.log("Transmission set to:", transmission);

                filterMakes(editTransmissionSelect, editMakeSelect, editCarSelect, make);
            });

            function filterMakes(transmissionElem, makeElem, carElem, selectedMake = null) {
                const selectedTransmission = transmissionElem.value;
                console.log("Filtering makes for transmission:", selectedTransmission);

                const uniqueMakes = [...new Set(cars
                    .filter(car => car.transmission === selectedTransmission)
                    .map(car => car.make))];

                makeElem.innerHTML = '<option value="">Select Make</option>';
                uniqueMakes.forEach(make => {
                    const option = document.createElement('option');
                    option.value = make;
                    option.textContent = make;
                    if (make === selectedMake) {
                        option.selected = true; // Set the existing make as selected
                    }
                    makeElem.appendChild(option);
                });

                console.log("Available makes:", uniqueMakes);

                // Trigger the car filter after setting the make if selectedMake exists
                if (selectedMake) {
                    makeElem.value = selectedMake;
                    filterCars(transmissionElem, makeElem, carElem, selectedCarId);
                }
            }

            function filterCars(transmissionElem, makeElem, carElem, selectedCarId = null) {
                const selectedTransmission = transmissionElem.value;
                const selectedMake = makeElem.value;

                console.log("Filtering cars for transmission:", selectedTransmission, "and make:", selectedMake);

                // Filter cars based on selected transmission and make
                const filteredCars = cars.filter(car =>
                    car.transmission === selectedTransmission && car.make === selectedMake
                );

                // Populate the car dropdown with model and registration number
                carElem.innerHTML = '<option value="">Select Car</option>';
                filteredCars.forEach(car => {
                    const option = document.createElement('option');
                    option.value = car.id;
                    option.textContent =
                        `${car.model || car.make} - ${car.registration_number || 'N/A'}`; // Display model or make with registration number
                    if (car.id == selectedCarId) {
                        option.selected = true; // Set the existing car as selected
                    }
                    carElem.appendChild(option);
                });

                console.log("Available cars for selection:", filteredCars);
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handling Delete Modal
            const deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const courseId = button.getAttribute('data-course-id');
                const deleteForm = document.getElementById('deleteCourseForm');
                deleteForm.action = `/admin/courses/delete/${courseId}`;
            });
        });
    </script>
@endsection
