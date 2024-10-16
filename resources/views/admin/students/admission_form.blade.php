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
                            <th class="fixed-width">
                                <div class="form-check">
                                    <input class="form-check-input border-gray-200 rounded-4" type="checkbox"
                                        id="selectAll">
                                </div>
                            </th>
                            <th class="h6 text-gray-300">#</th>
                            <th class="h6 text-gray-300">Name</th>
                            <th class="h6 text-gray-300">Father's/Husband's Name</th>
                            <th class="h6 text-gray-300">CNIC</th>
                            <th class="h6 text-gray-300">Pickup Address</th>
                            <th class="h6 text-gray-300">Phone Number</th>
                            <th class="h6 text-gray-300">Admission Date</th>
                            <th class="h6 text-gray-300">Course Enrolled</th>
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
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
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $student->user->name }}</span>
                                </td>
                                <td>
                                    <span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ $student->father_or_husband_name }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $student->cnic }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $student->address }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $student->phone }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $student->admission_date }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300"> {{ $student->course->car->make }}
                                        {{ $student->course->car->model }} -
                                        {{ $student->course->car->registration_number }} -
                                        ({{ $student->course->duration_days }} Days)
                                    </span>
                                </td>
                                <td>
                                    <button type="button"
                                        class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white"
                                        data-bs-toggle="modal" data-bs-target="#enrollModal" data-id="{{ $student->id }}"
                                        data-admission-date="{{ $student->admission_date }}"
                                        data-practical-driving-hours="{{ $student->practical_driving_hours }}"
                                        data-theory-classes="{{ $student->theory_classes }}"
                                        data-car-id="{{ $student->course->vehicle_id }}" onclick="populateModal(this)">
                                        Enroll
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer flex-between flex-wrap">
                <span class="text-gray-900">
                    Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of {{ $students->total() }}
                    entries
                </span>

                <!-- Default pagination links -->
                {{ $students->links() }}
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
                        <input type="hidden" name="vehicle_id" id="vehicle_id">

                        <div class="row"> <!-- Row for input grouping -->

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

                            <!-- Practical Driving Hours -->
                            <div class="col-sm-12 mb-3">
                                <label for="practicalDriving" class="h5 mb-8 fw-semibold font-heading">Practical Driving
                                    Days</label>
                                <input type="number"
                                    class="form-control @error('practical_driving_hours') is-invalid @enderror"
                                    id="practicalDriving" name="practical_driving_hours"
                                    placeholder="Enter Practical Driving Days" required>
                                @error('practical_driving_hours')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Theory Classes -->
                            <div class="col-sm-12 mb-3">
                                <label for="theoryClasses" class="h5 mb-8 fw-semibold font-heading">Theory Classes
                                    Days</label>
                                <input type="number" class="form-control @error('theory_classes') is-invalid @enderror"
                                    id="theoryClasses" name="theory_classes" placeholder="Enter Theory Classes Days"
                                    required>
                                @error('theory_classes')
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

                            <!-- Branch -->
                            <div class="col-sm-12 mb-3">
                                <label for="branch" class="h5 mb-8 fw-semibold font-heading">Branch <span
                                        class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                <input type="text" class="form-control @error('branch') is-invalid @enderror"
                                    id="branch" name="branch" placeholder="Enter Branch Name" required>
                                @error('branch')
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
        function populateModal(button) {
            // Get the student ID from the button's data attributes
            const studentId = button.getAttribute('data-id');
            const vehicleId = button.getAttribute('data-car-id'); // Get the associated car ID

            // Update the form action to include the student ID
            document.getElementById('enrollForm').action = `/admin/student/update/${studentId}`;

            // Set the hidden field for vehicle_id
            document.getElementById('vehicle_id').value = vehicleId;

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
