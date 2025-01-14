@extends('layout.layout')

@section('content')
    <div class="dashboard-body">
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li><a href="{{ route('admin.dashboard') }}"
                        class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a>
                </li>
                <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                <li><span class="text-main-600 fw-normal text-15">All Submitted Forms</span></li>
            </ul>
        </div>
        <!-- Table Section Start -->
        <div class="card overflow-hidden">
            <div class="card-body p-0 overflow-x-auto">
                <table id="studentTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300">#</th>
                            <th class="h6 text-gray-300">Name</th>
                            <th class="h6 text-gray-300">Pickup Sector</th>
                            <th class="h6 text-gray-300">Phone</th>
                            <th class="h6 text-gray-300">Admission Date</th>
                            <th class="h6 text-gray-300">Course Enrolled</th>
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>
                                    <div class="flex-align gap-8">
                                        <span class="h6 mb-0 fw-medium text-gray-300">{{ $loop->iteration }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $student->user->name }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $student->pickup_sector }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $student->phone }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $student->admission_date }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">
                                        {{ $student->course->carModel->name }}
                                        ({{ ucfirst($student->course->carModel->transmission) }})
                                        -
                                        {{ $student->course->fees }} PKR -
                                        {{ $student->course->duration_days }} Days -
                                    </span>
                                </td>
                                <td>
                                    <button type="button"
                                        class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white"
                                        data-bs-toggle="modal" data-bs-target="#enrollModal" data-id="{{ $student->id }}"
                                        data-car-model-name="{{ $student->course->carModel->name }}"
                                        data-car-model-transmission="{{ $student->course->carModel->transmission }}"
                                        data-cars='@json($student->course->carModel->cars)'>
                                        Enroll
                                    </button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer flex-between flex-wrap">
                <span class="text-gray-900">Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of
                    {{ $students->total() }} entries</span>
                <ul class="pagination flex-align flex-wrap">
                    @if ($students->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">Prev</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
                                href="{{ $students->previousPageUrl() }}">Prev</a>
                        </li>
                    @endif

                    @foreach ($students->links()->elements[0] as $page => $url)
                        @if ($page == $students->currentPage())
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

                    @if ($students->hasMorePages())
                        <li class="page-item">
                            <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
                                href="{{ $students->nextPageUrl() }}">Next</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">Next</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- Table Section End -->
    </div>

    <div class="modal fade" id="enrollModal" tabindex="-1" aria-labelledby="enrollModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enrollModalLabel">Enroll Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="enrollForm" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="studentId">
                        <div class="row"> <!-- Row for input grouping -->

                            <!-- Car Model Dropdown (Non-editable) -->
                            <div class="mb-3">
                                <label for="car_model" class="form-label">Selected Car Model</label>
                                <select class="form-select" id="car_model" name="car_model" disabled>
                                    <!-- Dynamically populated -->
                                </select>
                            </div>

                            <!-- Cars Dropdown -->
                            <div class="mb-3">
                                <label for="car_id" class="form-label">Select Car</label>
                                <select class="form-select @error('car_id') is-invalid @enderror" id="car_id"
                                    name="car_id" required>
                                    <option value="" disabled selected>Select Car</option>
                                    <!-- Dynamically populated -->
                                </select>
                                @error('car_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Admission Date -->
                            <div class="col-sm-12 mb-3">
                                <label for="admission_date" class="h5 mb-8 fw-semibold font-heading">Admission Date <span
                                        class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                <input type="date" class="form-control @error('admission_date') is-invalid @enderror"
                                    id="admission_date" name="admission_date" placeholder="Select Admission Date" required>
                                @error('admission_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Instructor Dropdown -->
                            <div class="col-sm-12 mb-3">
                                <label for="instructor" class="h5 mb-8 fw-semibold font-heading">Select Instructor <span
                                        class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                <select class="form-select @error('instructor_id') is-invalid @enderror" id="instructor"
                                    name="instructor_id" required>
                                    <option value="" disabled selected>Select Instructor</option>
                                    @foreach ($instructors as $instructor)
                                        <option value="{{ $instructor->id }}">{{ $instructor->employee->user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('instructor_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Class Start Time Dropdown -->
                            <div class="col-sm-12 mb-3">
                                <label for="class_start_time" class="h5 mb-8 fw-semibold font-heading">Class Start Time
                                    <span class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                <select class="form-select @error('class_start_time') is-invalid @enderror"
                                    id="class_start_time" name="class_start_time" required>
                                    <!-- Time slots will be populated dynamically -->
                                </select>
                                @error('class_start_time')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Class Duration -->
                            <div class="col-sm-12 mb-3">
                                <label for="class_duration" class="h5 mb-8 fw-semibold font-heading">Class Duration (in
                                    minutes) <span class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                <input type="number" class="form-control @error('class_duration') is-invalid @enderror"
                                    id="class_duration" name="class_duration" placeholder="Enter Class Duration"
                                    required>
                                @error('class_duration')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Invoice Date -->
                            <div class="col-sm-12 mb-3">
                                <label for="invoice_date" class="h5 mb-8 fw-semibold font-heading">Invoice Date <span
                                        class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                <input type="date" class="form-control @error('invoice_date') is-invalid @enderror"
                                    id="invoice_date" name="invoice_date" placeholder="Select Invoice Date" required>
                                @error('invoice_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Amount Received -->
                            <div class="col-sm-12 mb-3">
                                <label for="amount_received" class="h5 mb-8 fw-semibold font-heading">Total Amount
                                    <span class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                <input type="number" class="form-control @error('amount_received') is-invalid @enderror"
                                    id="amount_received" name="amount_received" placeholder="Enter Amount Received"
                                    required>
                                @error('amount_received')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Balance -->
                            <div class="col-sm-12 mb-3">
                                <label for="balance" class="h5 mb-8 fw-semibold font-heading">Advance <span
                                        class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                <input type="number" step="0.01"
                                    class="form-control @error('balance') is-invalid @enderror" id="balance"
                                    name="balance" placeholder="Advance Amount" required>
                                @error('balance')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Branch Dropdown -->
                            <div class="col-sm-12 mb-3">
                                <label for="branch_id" class="h5 mb-8 fw-semibold font-heading">Branch <span
                                        class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                <select class="form-select @error('branch_id') is-invalid @enderror" id="branch_id"
                                    name="branch_id" required>
                                    <option value="">Select Branch</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                                @error('branch_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Paid By -->
                            <div class="col-sm-12 mb-3">
                                <label for="paid_by" class="h5 mb-8 fw-semibold font-heading">Paid By <span
                                        class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                <input type="text" class="form-control @error('paid_by') is-invalid @enderror"
                                    id="paid_by" name="paid_by" placeholder="Enter Payee Name" required>
                                @error('paid_by')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Amount in Words -->
                            <div class="col-sm-12 mb-3">
                                <label for="amount_in_english" class="h5 mb-8 fw-semibold font-heading">Amount in Words
                                    (English) <span class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                <input type="text"
                                    class="form-control @error('amount_in_english') is-invalid @enderror"
                                    id="amount_in_english" name="amount_in_english" placeholder="Enter Amount in Words"
                                    required>
                                @error('amount_in_english')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div> <!-- End of row -->

                        <br>
                        <!-- Submit Button -->
                        <div class="flex-align justify-content-end gap-8 mt-4">
                            <button type="submit" class="btn btn-main rounded-pill py-9">Enroll</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carModelDropdown = document.getElementById('car_model');
            const carDropdown = document.getElementById('car_id');

            function populateModal(button) {
                const studentId = button.getAttribute('data-id');
                const carModelName = button.getAttribute('data-car-model-name');
                const carModelTransmission = button.getAttribute('data-car-model-transmission');
                const cars = JSON.parse(button.getAttribute('data-cars')); // JSON string of cars for the model

                // Set the form action URL
                document.getElementById('enrollForm').action = `/admin/student/update/${studentId}`;

                // Populate the car model dropdown
                carModelDropdown.innerHTML = `
                    <option value="">Select Car Model</option>
                    <option value="${carModelName}" selected>
                        ${carModelName} (${carModelTransmission})
                    </option>
                `;

                // Populate the cars dropdown
                carDropdown.innerHTML = '<option value="" disabled selected>Select Car</option>';
                cars.forEach(car => {
                    const option = document.createElement('option');
                    option.value = car.id;
                    option.textContent = car.registration_number;
                    carDropdown.appendChild(option);
                });
            }

            // Attach event listener to the modal show event
            const enrollModal = document.getElementById('enrollModal');
            enrollModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget; // Button that triggered the modal
                populateModal(button);
            });
        });
    </script>

    <script>
        function populateModal(button) {
            // Get the student ID from the button's data attributes
            const studentId = button.getAttribute('data-id');
            const vehicleId = button.getAttribute('data-car-id'); // Get the associated car ID

            // Update the form action to include the student ID
            document.getElementById('enrollForm').action = `/admin/student/update/${studentId}`;

            // Set admission date
            document.getElementById('admission_date').value = button.getAttribute('data-admission-date');

            // Reset the selected index of the instructor dropdown
            document.getElementById('instructor').selectedIndex = 0;

            // Trigger fetching booked times
            fetchBookedTimes();
        }

        function fetchBookedTimes() {
            const selectedDate = document.getElementById('admission_date').value;
            const selectedInstructor = document.getElementById('instructor').value;
            const selectedVehicle = document.getElementById('vehicle_id').value;

            const classStartTimeSelect = document.getElementById('class_start_time');

            if (selectedDate || selectedInstructor || selectedVehicle) {
                let url = `/admin/schedules/booked-times?`;

                if (selectedDate) url += `date=${selectedDate}&`;
                if (selectedInstructor) url += `instructor=${selectedInstructor}&`;
                if (selectedVehicle) url += `vehicle=${selectedVehicle}`;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        const bookedTimes = data.booked_times;
                        classStartTimeSelect.innerHTML = '';

                        for (let hour = 8; hour <= 19; hour++) {
                            let time1 = `${hour.toString().padStart(2, '0')}:00`;
                            let time2 = `${hour.toString().padStart(2, '0')}:30`;

                            if (!bookedTimes.includes(time1)) {
                                classStartTimeSelect.innerHTML +=
                                    `<option value="${time1}">${formatTime(time1)}</option>`;
                            }
                            if (!bookedTimes.includes(time2)) {
                                classStartTimeSelect.innerHTML +=
                                    `<option value="${time2}">${formatTime(time2)}</option>`;
                            }
                        }
                    })
                    .catch(error => console.error('Error fetching booked times:', error));
            }
        }

        function formatTime(time24) {
            const [hours, minutes] = time24.split(':');
            let hours12 = (hours % 12) || 12;
            let period = hours < 12 ? 'AM' : 'PM';
            return `${hours12}:${minutes} ${period}`;
        }

        document.getElementById('admission_date').addEventListener('change', fetchBookedTimes);
        document.getElementById('instructor').addEventListener('change', fetchBookedTimes);
    </script>

@endsection
