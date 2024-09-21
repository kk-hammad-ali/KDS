    @extends('layout.admin')

    @section('page_content')
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-12">
                    <div class="bg-light rounded h-100 p-4">
                        <h3 class="mb-4">Add Student</h3>
                        <form id="studentForm" action="{{ route('admin.students.store') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name') }}" placeholder="John Doe"
                                            required>
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="fatherName" class="form-label">Father's Name / Husband's Name</label>
                                        <input type="text"
                                            class="form-control @error('father_or_husband_name') is-invalid @enderror"
                                            id="fatherName" name="father_or_husband_name"
                                            value="{{ old('father_or_husband_name') }}" placeholder="Robert Doe" required>
                                        @error('father_or_husband_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="cnic" class="form-label">CNIC No</label>
                                        <input type="text" class="form-control @error('cnic') is-invalid @enderror"
                                            id="cnic" name="cnic" value="{{ old('cnic') }}"
                                            placeholder="12345-6789012-3" required>
                                        @error('cnic')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                                            id="address" name="address" value="{{ old('address') }}"
                                            placeholder="123 Elm Street, Springfield" required>
                                        @error('address')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone No</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" name="phone" value="{{ old('phone') }}"
                                            placeholder="555-123-4567" required>
                                        @error('phone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="optionalPhone" class="form-label">Optional Phone No</label>
                                        <input type="text"
                                            class="form-control @error('optional_phone') is-invalid @enderror"
                                            id="optionalPhone" name="optional_phone" value="{{ old('optional_phone') }}"
                                            placeholder="555-765-4321">
                                        @error('optional_phone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="admission_date" class="form-label">Admission Date</label>
                                    <input type="date" class="form-control @error('admission_date') is-invalid @enderror"
                                        id="admission_date" name="admission_date" value="{{ old('admission_date') }}"
                                        required min="{{ date('Y-m-d') }}">
                                    @error('admission_date')
                                        <div class="text-danger">{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="drivingTime" class="form-label">Driving Time</label>
                                        <div class="input-group mb-3">
                                            <input type="number"
                                                class="form-control @error('driving_time_per_week') is-invalid @enderror"
                                                id="drivingTime" name="driving_time_per_week"
                                                value="{{ old('driving_time_per_week') }}" placeholder="2" required>
                                            <span class="input-group-text">hours per week</span>
                                            @error('driving_time_per_week')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="course" class="form-label">Course</label>
                                        <select class="form-select @error('course_id') is-invalid @enderror"
                                            id="course" name="course_id" required>
                                            <option value="" disabled selected>Select Course</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}" data-fees="{{ $course->fees }}"
                                                    data-duration="{{ $course->duration_days }}">
                                                    {{ $course->duration_days }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('course_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="fees" class="form-label">Fees</label>
                                        <input type="number" class="form-control @error('fees') is-invalid @enderror"
                                            id="fees" name="fees" value="{{ old('fees') }}"
                                            placeholder="5000" required>
                                        @error('fees')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="course_duration" class="form-label">Course Duration (Days)</label>
                                        <input type="text"
                                            class="form-control @error('course_duration') is-invalid @enderror"
                                            id="course_duration" name="course_duration"
                                            value="{{ old('course_duration') }}" placeholder="10" required>
                                        @error('course_duration')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="practicalDriving" class="form-label">Practical Driving (No. of
                                            Hours)</label>
                                        <input type="number"
                                            class="form-control @error('practical_driving_hours') is-invalid @enderror"
                                            id="practicalDriving" name="practical_driving_hours"
                                            value="{{ old('practical_driving_hours') }}" placeholder="10" required>
                                        @error('practical_driving_hours')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="theoryClasses" class="form-label">Theory Classes (No. of
                                            Classes)</label>
                                        <input type="number"
                                            class="form-control @error('theory_classes') is-invalid @enderror"
                                            id="theoryClasses" name="theory_classes" value="{{ old('theory_classes') }}"
                                            placeholder="15" required>
                                        @error('theory_classes')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="couponCode" class="form-label">Coupon Code</label>
                                        <input type="text"
                                            class="form-control @error('coupon_code') is-invalid @enderror"
                                            id="couponCode" name="coupon_code" value="{{ old('coupon_code') }}"
                                            placeholder="DISCOUNT20">
                                        @error('coupon_code')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="instructor" class="form-label">Select
                                            Instructor</label>
                                        <select class="form-select @error('instructor_id') is-invalid @enderror"
                                            id="instructor" name="instructor_id" required>
                                            <option value="" disabled selected>Select Instructor
                                            </option>
                                            @foreach ($instructors as $instructor)
                                                <option value="{{ $instructor->id }}"
                                                    {{ old('instructor_id') == $instructor->id ? 'selected' : '' }}>
                                                    {{ $instructor->employee ? ($instructor->employee->user ? $instructor->employee->user->name : 'No User') : 'No Employee' }}
                                                </option>
                                            @endforeach

                                        </select>
                                        @error('instructor_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="transmission" class="form-label">Select Transmission
                                            Type</label>
                                        <select class="form-select @error('transmission') is-invalid @enderror"
                                            id="transmission" name="transmission" required>
                                            <option value="" disabled selected>Select Transmission
                                                Type</option>
                                            <option value="automatic"
                                                {{ old('transmission') == 'automatic' ? 'selected' : '' }}>
                                                Automatic</option>
                                            <option value="manual"
                                                {{ old('transmission') == 'manual' ? 'selected' : '' }}>
                                                Manual</option>
                                        </select>
                                        @error('transmission')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Car Selection -->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="car" class="form-label">Select Car</label>
                                        <select class="form-select @error('vehicle_id') is-invalid @enderror"
                                            id="car" name="vehicle_id" required>
                                            <option value="" disabled selected>Select Car</option>
                                            @foreach ($cars as $car)
                                                <option value="{{ $car->id }}"
                                                    {{ old('vehicle_id') == $car->id ? 'selected' : '' }}
                                                    data-transmission="{{ $car->transmission }}">
                                                    {{ $car->make }} {{ $car->model }} -
                                                    {{ $car->registration_number }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('vehicle_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Class Start Time with 8 AM to 8 PM restriction -->
                                <div class="col-md-6">
                                    <label for="class_start_time" class="form-label">Class Start Time:</label>
                                    <select id="class_start_time" name="class_start_time"
                                        class="form-select @error('class_start_time') is-invalid @enderror" required>
                                        <!-- The available time slots will be populated here dynamically -->
                                        @for ($hour = 8; $hour <= 19; $hour++)
                                            @php
                                                $time1 = \Carbon\Carbon::createFromTime($hour, 0)->format('H:i');
                                                $time2 = \Carbon\Carbon::createFromTime($hour, 30)->format('H:i');
                                            @endphp
                                            <option value="{{ $time1 }}">
                                                {{ \Carbon\Carbon::createFromTime($hour, 0)->format('h:i A') }}
                                            </option>
                                            <option value="{{ $time2 }}">
                                                {{ \Carbon\Carbon::createFromTime($hour, 30)->format('h:i A') }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('class_start_time')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="class_duration" class="form-label">Class Duration (in minutes):</label>
                                    <input type="number" id="class_duration" name="class_duration"
                                        class="form-control @error('class_duration') is-invalid @enderror"
                                        placeholder="Enter duration in minutes" required>
                                    @error('class_duration')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <!-- Hidden input for calculated course end date -->
                            <input type="hidden" id="course_end_date" name="course_end_date" />

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const courseSelect = document.getElementById('course');
                const feesInput = document.getElementById('fees');
                const durationInput = document.getElementById('course_duration');
                const admissionDateInput = document.getElementById('admission_date');
                const courseEndDateInput = document.getElementById('course_end_date');

                // Function to calculate course end date
                function calculateEndDate() {
                    const admissionDate = admissionDateInput.value;
                    const duration = durationInput.value;

                    if (admissionDate && duration) {
                        const endDate = new Date(admissionDate);
                        endDate.setDate(endDate.getDate() + parseInt(duration));

                        const formattedDate = endDate.toISOString().split('T')[0];
                        courseEndDateInput.value = formattedDate;
                    }
                }

                // Update fees and course duration when a course is selected
                courseSelect.addEventListener('change', function() {
                    const selectedOption = courseSelect.options[courseSelect.selectedIndex];
                    const fees = selectedOption.getAttribute('data-fees');
                    const duration = selectedOption.getAttribute('data-duration');

                    const durationInt = parseInt(duration, 10);

                    // Assign values
                    feesInput.value = fees;
                    durationInput.value = durationInt;
                    calculateEndDate();
                });

                // Recalculate the end date when admission date or course duration changes
                admissionDateInput.addEventListener('input', calculateEndDate);
                durationInput.addEventListener('input', calculateEndDate);
            });
        </script>

        <script>
            // Update car list based on selected transmission type
            document.getElementById('transmission').addEventListener('change', function() {
                var selectedTransmission = this.value;
                var carSelect = document.getElementById('car');
                var carOptions = carSelect.options;

                for (var i = 0; i < carOptions.length; i++) {
                    var option = carOptions[i];

                    if (option.dataset.transmission === selectedTransmission || option.value === "") {
                        option.style.display = '';
                    } else {
                        option.style.display = 'none';
                    }
                }
                carSelect.selectedIndex = 0;
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const admissionDateInput = document.getElementById('admission_date');
                const instructorSelect = document.getElementById('instructor');
                const vehicleSelect = document.getElementById('car'); // New car/vehicle select input
                const classStartTimeSelect = document.getElementById('class_start_time');

                // Helper function to convert 24-hour time to 12-hour time with AM/PM
                function formatTime(time24) {
                    const [hours, minutes] = time24.split(':');
                    let hours12 = (hours % 12) || 12;
                    let period = hours < 12 ? 'AM' : 'PM';
                    return `${hours12}:${minutes} ${period}`;
                }

                function fetchBookedTimes() {
                    const selectedDate = admissionDateInput.value;
                    const selectedInstructor = instructorSelect.value;
                    const selectedVehicle = vehicleSelect.value; // Fetch selected vehicle ID

                    if (selectedDate || selectedInstructor || selectedVehicle) {
                        let url = `/admin/schedules/booked-times?`;

                        if (selectedDate) url += `date=${selectedDate}&`;
                        if (selectedInstructor) url += `instructor=${selectedInstructor}&`;
                        if (selectedVehicle) url += `vehicle=${selectedVehicle}`;

                        // Make an AJAX request to fetch booked times
                        fetch(url)
                            .then(response => response.json())
                            .then(data => {
                                const bookedTimes = data.booked_times;

                                // Reset the start time dropdown options
                                classStartTimeSelect.innerHTML = '';

                                // Populate with available times and format them to AM/PM
                                for (let hour = 8; hour <= 19; hour++) {
                                    let time1 = `${hour.toString().padStart(2, '0')}:00`;
                                    let time2 = `${hour.toString().padStart(2, '0')}:30`;

                                    // Only add the time slot if it is not in the booked times
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

                // Fetch available times when either date, instructor, or vehicle changes
                admissionDateInput.addEventListener('change', fetchBookedTimes);
                instructorSelect.addEventListener('change', fetchBookedTimes);
                vehicleSelect.addEventListener('change', fetchBookedTimes); // Trigger when vehicle is selected
            });
        </script>
    @endsection
