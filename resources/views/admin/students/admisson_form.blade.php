@extends('layout.admin')

@section('page_content')
    <style>
        td {
            min-width: 140px;
        }
    </style>
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">All Submitted Forms</h4>
                    </div>
                    <div class="table-responsive">
                        @if ($students->isEmpty())
                            <p>No admission forms have been submitted yet.</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Father's/Husband's Name</th>
                                        <th scope="col">CNIC</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Optional Phone</th>
                                        <th scope="col">Admission Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $student->user->name }}</td>
                                            <td>{{ $student->father_or_husband_name }}</td>
                                            <td>{{ $student->cnic }}</td>
                                            <td>{{ $student->address }}</td>
                                            <td>{{ $student->phone }}</td>
                                            <td>{{ $student->optional_phone }}</td>
                                            <td>{{ $student->admission_date }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#enrollModal" data-id="{{ $student->id }}"
                                                    data-name="{{ $student->user->name }}"
                                                    data-father-name="{{ $student->father_or_husband_name }}"
                                                    data-cnic="{{ $student->cnic }}"
                                                    data-address="{{ $student->address }}"
                                                    data-phone="{{ $student->phone }}"
                                                    data-optional-phone="{{ $student->optional_phone }}"
                                                    data-admission-date="{{ $student->admission_date }}"
                                                    data-course-id="{{ $student->course_id }}"
                                                    data-course-name="{{ $student->course->duration_days }}"
                                                    data-fees="{{ $student->fees }}"
                                                    data-duration="{{ $student->course_duration }}"
                                                    data-practical-driving-hours="{{ $student->practical_driving_hours }}"
                                                    data-theory-classes="{{ $student->theory_classes }}"
                                                    data-transmission="{{ $student->transmission }}"
                                                    data-email="{{ $student->email }}" onclick="populateModal(this)">
                                                    Enroll
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enrollment Modal -->
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
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="father_husband_name" class="form-label">Father's/Husband's Name</label>
                            <input type="text" class="form-control" id="father_husband_name" name="father_husband_name"
                                required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="cnic" class="form-label">CNIC</label>
                            <input type="text" class="form-control" id="cnic" name="cnic" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="optional_phone" class="form-label">Optional Phone</label>
                            <input type="text" class="form-control" id="optional_phone" name="optional_phone"
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label for="admission_date" class="form-label">Admission Date</label>
                            <input type="date" class="form-control" id="admission_date" name="admission_date"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email (Optional)</label>
                            <input type="email" class="form-control" id="email" name="email" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="practical_driving_hours" class="form-label">Practical Driving (No. of
                                Hours)</label>
                            <input type="number" class="form-control" id="practical_driving_hours"
                                name="practical_driving_hours" required>
                        </div>
                        <div class="mb-3">
                            <label for="theory_classes" class="form-label">Theory Classes (No. of Classes)</label>
                            <input type="number" class="form-control" id="theory_classes" name="theory_classes"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="course_name" class="form-label">Course</label>
                            <input type="text" class="form-control" id="course_name" name="course_name" required
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label for="fees" class="form-label">Fees</label>
                            <input type="number" class="form-control" id="fees" name="fees" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="course_duration" class="form-label">Course Duration (Days)</label>
                            <input type="number" class="form-control" id="course_duration" name="course_duration"
                                required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="transmission" class="form-label">Transmission Type</label>
                            <input type="text" class="form-control" id="transmission" name="transmission" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="instructor" class="form-label">Select Instructor</label>
                            <select class="form-select" id="instructor" name="instructor_id" required>
                                <option value="" disabled selected>Select Instructor</option>
                                @foreach ($instructors as $instructor)
                                    <option value="{{ $instructor->id }}">{{ $instructor->employee->user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="vehicle_id" class="form-label">Select Vehicle</label>
                            <select class="form-select" id="vehicle_id" name="vehicle_id" required>
                                <option value="" disabled selected>Select Vehicle</option>
                                @foreach ($cars as $vehicle)
                                    <option value="{{ $vehicle->id }}"
                                        data-transmission="{{ $vehicle->transmission }}">
                                        {{ $vehicle->make }} {{ $vehicle->model }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="class_start_time" class="form-label">Class Start Time</label>
                            <select class="form-select" id="class_start_time" name="class_start_time" required>
                                <!-- Time slots will be populated dynamically -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="class_duration" class="form-label">Class Duration (in minutes)</label>
                            <input type="number" class="form-control" id="class_duration" name="class_duration"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function populateModal(button) {
            // Get the student ID from the button's data attributes
            const studentId = button.getAttribute('data-id');

            // Update the form action to include the student ID
            document.getElementById('enrollForm').action = `/admin/student/update/${studentId}`;

            // Populate the form fields with the student's data
            document.getElementById('studentId').value = studentId;
            document.getElementById('name').value = button.getAttribute('data-name');
            document.getElementById('father_husband_name').value = button.getAttribute('data-father-name');
            document.getElementById('cnic').value = button.getAttribute('data-cnic');
            document.getElementById('address').value = button.getAttribute('data-address');
            document.getElementById('phone').value = button.getAttribute('data-phone');
            document.getElementById('optional_phone').value = button.getAttribute('data-optional-phone');
            document.getElementById('admission_date').value = button.getAttribute('data-admission-date');
            document.getElementById('email').value = button.getAttribute('data-email') || '';

            // Populate read-only fields for course, fees, and duration
            document.getElementById('course_name').value = button.getAttribute('data-course-name');
            document.getElementById('fees').value = button.getAttribute('data-fees');
            document.getElementById('course_duration').value = button.getAttribute('data-duration');

            // Set practical and theory class fields
            document.getElementById('practical_driving_hours').value = button.getAttribute('data-practical-driving-hours');
            document.getElementById('theory_classes').value = button.getAttribute('data-theory-classes');

            // Set the transmission type
            const transmissionType = button.getAttribute('data-transmission');
            document.getElementById('transmission').value = transmissionType;

            // Filter vehicles based on transmission type
            var vehicleSelect = document.getElementById('vehicle_id');
            var vehicleOptions = vehicleSelect.options;

            for (var i = 0; i < vehicleOptions.length; i++) {
                var option = vehicleOptions[i];
                if (option.dataset.transmission === transmissionType || option.value === "") {
                    option.style.display = '';
                } else {
                    option.style.display = 'none';
                }
            }
            vehicleSelect.selectedIndex = 0; // Reset the selection

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
        document.getElementById('vehicle_id').addEventListener('change', fetchBookedTimes);
    </script>
@endsection
