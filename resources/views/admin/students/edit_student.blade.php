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
                    <li><span class="text-main-600 fw-normal text-15">Edit Student</span></li>
                </ul>
            </div>
        </div>


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Student Step List Start -->
        <ul class="step-list mb-24">
            <li class="step-list__item py-15 px-24 text-15 text-heading fw-medium flex-center gap-6 active" data-step="1">
                <span class="icon text-xl d-flex"><i class="ph ph-circle"></i></span>
                Personal Information
                <span class="line position-relative"></span>
            </li>
            <li class="step-list__item py-15 px-24 text-15 text-heading fw-medium flex-center gap-6" data-step="2">
                <span class="icon text-xl d-flex"><i class="ph ph-circle"></i></span>
                Admission Details
                <span class="line position-relative"></span>
            </li>
            <li class="step-list__item py-15 px-24 text-15 text-heading fw-medium flex-center gap-6" data-step="3">
                <span class="icon text-xl d-flex"><i class="ph ph-circle"></i></span>
                Class Schedule
                <span class="line position-relative"></span>
            </li>
            <li class="step-list__item py-15 px-24 text-15 text-heading fw-medium flex-center gap-6" data-step="4">
                <span class="icon text-xl d-flex"><i class="ph ph-circle"></i></span>
                Invoice Generation
                <span class="line position-relative"></span>
            </li>
        </ul>
        <!-- Student Step List End -->

        <!-- Student Form Tabs Start -->
        <div class="card">
            <div class="card-body">
                <form id="studentForm" action="{{ route('admin.students.update', $student->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Step 1: Personal Information -->
                    <div class="step-content" id="step-1">
                        <h5>Personal Information</h5>
                        <div class="row gy-20">
                            <div class="col-sm-6">
                                <label for="name" class="h5 mb-8 fw-semibold font-heading">Name <span
                                        class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $student->user->name) }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="fatherName" class="h5 mb-8 fw-semibold font-heading">Father's Name / Husband's
                                    Name</label>
                                <input type="text"
                                    class="form-control @error('father_or_husband_name') is-invalid @enderror"
                                    id="fatherName" name="father_or_husband_name"
                                    value="{{ old('father_or_husband_name', $student->father_or_husband_name) }}" required>
                                @error('father_or_husband_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="cnic" class="h5 mb-8 fw-semibold font-heading">CNIC No</label>
                                <input type="text" class="form-control @error('cnic') is-invalid @enderror"
                                    id="cnic" name="cnic" value="{{ old('cnic', $student->cnic) }}" required>
                                @error('cnic')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="address" class="h5 mb-8 fw-semibold font-heading">Full Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    id="address" name="address" value="{{ old('address', $student->address) }}" required>
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="phone" class="h5 mb-8 fw-semibold font-heading">Phone No</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" value="{{ old('phone', $student->phone) }}" required>
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="optionalPhone" class="h5 mb-8 fw-semibold font-heading">Optional Phone
                                    No</label>
                                <input type="text" class="form-control @error('optional_phone') is-invalid @enderror"
                                    id="optionalPhone" name="optional_phone"
                                    value="{{ old('optional_phone', $student->optional_phone) }}">
                                @error('optional_phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="email" class="h5 mb-8 fw-semibold font-heading">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $student->email) }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="pickup_sector" class="h5 mb-8 fw-semibold font-heading">Pickup Address (Sector
                                    Only)</label>
                                <input type="text" class="form-control @error('pickup_sector') is-invalid @enderror"
                                    id="pickup_sector" name="pickup_sector"
                                    value="{{ old('pickup_sector', $student->pickup_sector) }}" required>
                                @error('pickup_sector')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <!-- Step 2: Admission Details -->
                    <div class="step-content" id="step-2" style="display: none;">
                        <h5>Admission Details</h5>
                        <div class="row gy-20">

                            <!-- Car Model Dropdown -->
                            <div class="col-sm-6">
                                <label for="carModel" class="h5 mb-8 fw-semibold font-heading">Car Model</label>
                                <select class="form-select @error('car_model_id') is-invalid @enderror" id="carModel"
                                    name="car_model_id" required>
                                    <option value="" disabled>Select Car Model</option>
                                    @foreach ($courses->pluck('carModel')->unique('id') as $carModel)
                                        <option value="{{ $carModel->id }}"
                                            {{ old('car_model_id', $student->car_model_id) == $carModel->id ? 'selected' : '' }}>
                                            {{ $carModel->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('car_model_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Car Dropdown -->
                            <div class="col-sm-6">
                                <label for="car" class="h5 mb-8 fw-semibold font-heading">Car</label>
                                <select class="form-select @error('car_id') is-invalid @enderror" id="car"
                                    name="car_id" required disabled>
                                    <option value="" disabled>Select Car</option>
                                </select>
                                @error('car_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Course Type Dropdown -->
                            <div class="col-sm-6">
                                <label for="courseType" class="h5 mb-8 fw-semibold font-heading">Course Type</label>
                                <select class="form-select @error('course_type') is-invalid @enderror" id="courseType"
                                    name="course_type" required>
                                    <option value="" disabled>Select Course Type</option>
                                    <option value="male"
                                        {{ old('course_type', $student->course_type) == 'male' ? 'selected' : '' }}>Male
                                    </option>
                                    <option value="female"
                                        {{ old('course_type', $student->course_type) == 'female' ? 'selected' : '' }}>
                                        Female</option>
                                    <option value="both"
                                        {{ old('course_type', $student->course_type) == 'both' ? 'selected' : '' }}>Both
                                    </option>
                                </select>
                                @error('course_type')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Course Dropdown -->
                            <div class="col-sm-6">
                                <label for="course" class="h5 mb-8 fw-semibold font-heading">Course</label>
                                <select class="form-select @error('course_id') is-invalid @enderror" id="course"
                                    name="course_id" required disabled>
                                    <option value="" disabled>Select Course</option>
                                </select>
                                @error('course_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Coupon Code -->
                            <div class="col-sm-6">
                                <label for="couponCode" class="h5 mb-8 fw-semibold font-heading">Coupon Code
                                    (Optional)</label>
                                <input type="text" class="form-control @error('coupon_code') is-invalid @enderror"
                                    id="couponCode" name="coupon_code"
                                    value="{{ old('coupon_code', $student->coupon_code) }}">
                                @error('coupon_code')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const carModelSelect = document.getElementById('carModel');
                            const carSelect = document.getElementById('car');
                            const courseTypeSelect = document.getElementById('courseType');
                            const courseSelect = document.getElementById('course');

                            function filterCars() {
                                const selectedCarModelId = carModelSelect.value;

                                // Enable the car dropdown only if a car model is selected
                                if (selectedCarModelId) {
                                    carSelect.disabled = false;

                                    // Clear the car dropdown
                                    carSelect.innerHTML = '<option value="" disabled>Select Car</option>';

                                    // Filter cars based on car model
                                    const cars = @json($cars);
                                    cars.forEach(car => {
                                        if (car.car_model_id == selectedCarModelId) {
                                            const option = document.createElement('option');
                                            option.value = car.id;
                                            option.textContent = `Car #${car.registration_number}`;
                                            // Pre-select the car if it's the one selected for editing
                                            option.selected = car.id == @json(old('car_id', $student->car_id));
                                            carSelect.appendChild(option);
                                        }
                                    });
                                } else {
                                    carSelect.disabled = true;
                                    carSelect.innerHTML = '<option value="" disabled>Select Car</option>';
                                }
                            }

                            function filterCourses() {
                                const selectedCarModelId = carModelSelect.value;
                                const selectedCourseType = courseTypeSelect.value;

                                // Enable the course dropdown only if both fields are selected
                                if (selectedCarModelId && selectedCourseType) {
                                    courseSelect.disabled = false;

                                    // Clear the course dropdown
                                    courseSelect.innerHTML = '<option value="" disabled>Select Course</option>';

                                    // Filter courses based on car model and course type
                                    const courses = @json($courses);
                                    courses.forEach(course => {
                                        if (
                                            course.car_model_id == selectedCarModelId &&
                                            (course.course_type === selectedCourseType || selectedCourseType === 'both')
                                        ) {
                                            const option = document.createElement('option');
                                            option.value = course.id;
                                            option.textContent =
                                                `${course.car_model.name} - ${course.duration_days} Days / ${course.duration_minutes} Minutes - ${course.fees} PKR`;
                                            // Pre-select the course if it's the one selected for editing
                                            option.selected = course.id == @json(old('course_id', $student->course_id));
                                            courseSelect.appendChild(option);
                                        }
                                    });
                                } else {
                                    courseSelect.disabled = true;
                                    courseSelect.innerHTML = '<option value="" disabled selected>Select Course</option>';
                                }
                            }

                            // Event listeners for car model, car, and course type dropdowns
                            carModelSelect.addEventListener('change', () => {
                                filterCars();
                                filterCourses();
                            });
                            carSelect.addEventListener('change', filterCourses);
                            courseTypeSelect.addEventListener('change', filterCourses);

                            // Trigger the filters on page load to populate fields if editing
                            filterCars();
                            filterCourses();
                        });
                    </script>

                    <!-- Step 3: Class Schedule -->
                    <div class="step-content" id="step-3" style="display: none;">
                        <h5>Class Schedule</h5>
                        <div class="row gy-20">
                            <div class="col-sm-6">
                                <label for="admission_date" class="h5 mb-8 fw-semibold font-heading">Class Date</label>
                                <input type="date" class="form-control @error('admission_date') is-invalid @enderror"
                                    id="admission_date" name="admission_date"
                                    value="{{ old('admission_date', $student->admission_date) }}" required>
                                @error('admission_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="end_date" class="h5 mb-8 fw-semibold font-heading">End Date</label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                    id="end_date" name="end_date" value="{{ old('end_date', $class_end_date) }}">
                                @error('end_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-sm-6">
                                <label for="instructor" class="h5 mb-8 fw-semibold font-heading">Select Instructor</label>
                                <select class="form-select @error('instructor_id') is-invalid @enderror" id="instructor"
                                    name="instructor_id" required>
                                    <option value="" disabled>Select Instructor</option>
                                    @foreach ($instructors as $instructor)
                                        <option value="{{ $instructor->id }}"
                                            {{ old('instructor_id', $student->instructor_id) == $instructor->id ? 'selected' : '' }}>
                                            {{ $instructor->employee->user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('instructor_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="class_start_time" class="h5 mb-2 fw-semibold font-heading">Class Start
                                    Time:</label>
                                <select id="class_start_time" name="class_start_time"
                                    class="form-select @error('class_start_time') is-invalid @enderror" required>
                                    @for ($hour = 8; $hour <= 19; $hour++)
                                        @php
                                            $time1 = \Carbon\Carbon::createFromTime($hour, 0)->format('H:i');
                                            $time2 = \Carbon\Carbon::createFromTime($hour, 30)->format('H:i');
                                        @endphp
                                        <option value="{{ $time1 }}"
                                            {{ old('class_start_time', $student->class_start_time) == $time1 ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::createFromTime($hour, 0)->format('h:i A') }}</option>
                                        <option value="{{ $time2 }}"
                                            {{ old('class_start_time', $student->class_start_time) == $time2 ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::createFromTime($hour, 30)->format('h:i A') }}</option>
                                    @endfor
                                </select>
                                @error('class_start_time')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="class_duration" class="h5 mb-2 fw-semibold font-heading">Class Duration (in
                                    minutes):</label>
                                <input type="number" id="class_duration" name="class_duration"
                                    class="form-control @error('class_duration') is-invalid @enderror"
                                    value="{{ old('class_duration', $student->course->duration_minutes) }}" required>
                                @error('class_duration')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="branch_id" class="h5 mb-8 fw-semibold font-heading">Assign Branch</label>
                                <select class="form-select @error('branch_id') is-invalid @enderror" id="branch_id"
                                    name="branch_id">
                                    <option value="" disabled>Select branch</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}"
                                            {{ $branch->id == $student->branch_id ? 'selected' : '' }}>
                                            {{ $branch->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('branch_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="timing_preference" class="h5 mb-2 fw-semibold font-heading">Timing
                                    Preference</label>
                                <div>
                                    <input type="checkbox" id="before" name="timing_preference[]" value="before"
                                        {{ in_array('before', explode(', ', $student->timing_preference)) ? 'checked' : '' }}>
                                    <label for="before">Before</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="after" name="timing_preference[]" value="after"
                                        {{ in_array('after', explode(', ', $student->timing_preference)) ? 'checked' : '' }}>
                                    <label for="after">After</label>
                                </div>
                            </div>


                        </div>
                    </div>

                    <!-- Step 4: Invoice Generation -->
                    <div class="step-content" id="step-4" style="display: none;">
                        <h5>Invoice Details</h5>
                        <div class="row gy-20">
                            <input type="hidden" name="receipt_number"
                                value="{{ old('receipt_number', $student->invoice->receipt_number ?? 'KDS-01') }}">

                            <div class="col-sm-6">
                                <label for="invoice_date" class="h5 mb-8 fw-semibold font-heading">Invoice Date</label>
                                <input type="date" class="form-control @error('invoice_date') is-invalid @enderror"
                                    id="invoice_date" name="invoice_date"
                                    value="{{ old('invoice_date', $student->invoice->invoice_date ?? date('Y-m-d')) }}"
                                    required>
                                @error('invoice_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- <div class="col-sm-6">
                                <label for="branch" class="h5 mb-8 fw-semibold font-heading">Branch</label>
                                <input type="text" class="form-control @error('branch') is-invalid @enderror"
                                    id="branch" name="branch" value="{{ old('branch', $student->invoice->branch) }}"
                                    required>
                                @error('branch')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div> --}}

                            <div class="col-sm-6">
                                <label for="balance" class="h5 mb-8 fw-semibold font-heading">Advance</label>
                                <input type="number" class="form-control @error('balance') is-invalid @enderror"
                                    id="balance" name="balance"
                                    value="{{ old('balance', $student->invoice->balance) }}" required>
                                @error('balance')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="amount_received" class="h5 mb-8 fw-semibold font-heading">Total Amount</label>
                                <input type="number" class="form-control @error('amount_received') is-invalid @enderror"
                                    id="amount_received" name="amount_received"
                                    value="{{ old('amount_received', $student->invoice->amount_received) }}" required>
                                @error('amount_received')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex-align justify-content-end gap-8 mt-4">
                        <button type="button" class="btn btn-outline-main rounded-pill py-9" id="prevBtn"
                            style="display: none;">Previous</button>
                        <button type="button" class="btn btn-main rounded-pill py-9" id="nextBtn">Next</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Student Form Tabs End -->

        <!-- Script to handle form step navigation -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let currentStep = 1;
                const totalSteps = 4;
                const nextBtn = document.getElementById('nextBtn');
                const prevBtn = document.getElementById('prevBtn');
                const stepListItems = document.querySelectorAll('.step-list__item');

                function showStep(step) {
                    for (let i = 1; i <= totalSteps; i++) {
                        document.getElementById('step-' + i).style.display = i === step ? 'block' : 'none';
                    }
                    prevBtn.style.display = step === 1 ? 'none' : 'inline-block';
                    nextBtn.textContent = step === totalSteps ? 'Submit' : 'Next';
                    stepListItems.forEach((item, index) => {
                        if (index + 1 === step) {
                            item.classList.add('active');
                        } else {
                            item.classList.remove('active');
                        }
                    });
                }

                nextBtn.addEventListener('click', function() {
                    if (currentStep < totalSteps) {
                        currentStep++;
                        showStep(currentStep);
                    } else {
                        document.getElementById('studentForm').submit();
                    }
                });

                prevBtn.addEventListener('click', function() {
                    if (currentStep > 1) {
                        currentStep--;
                        showStep(currentStep);
                    }
                });

                showStep(currentStep);
                const courseSelect = document.getElementById('course');
                const feesInput = document.getElementById('fees');
                const durationInput = document.getElementById('course_duration');
                const admissionDateInput = document.getElementById('admission_date');
                const courseEndDateInput = document.getElementById('course_end_date');

                function calculateEndDate() {
                    const admissionDate = admissionDateInput.value;
                    const duration = durationInput.value;
                    if (admissionDate && duration) {
                        const endDate = new Date(admissionDate);
                        endDate.setDate(endDate.getDate() + parseInt(duration, 10));
                        const formattedDate = endDate.toISOString().split('T')[0];
                        courseEndDateInput.value = formattedDate;
                    }
                }
                admissionDateInput.addEventListener('input', calculateEndDate);
                durationInput.addEventListener('input', calculateEndDate);
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const admissionDateInput = document.getElementById('admission_date');
                const instructorSelect = document.getElementById('instructor');
                const classStartTimeSelect = document.getElementById('class_start_time');

                function formatTime(time24) {
                    const [hours, minutes] = time24.split(':');
                    let hours12 = (hours % 12) || 12;
                    let period = hours < 12 ? 'AM' : 'PM';
                    return `${hours12}:${minutes} ${period}`;
                }

                function fetchBookedTimes() {
                    const selectedDate = admissionDateInput.value;
                    const selectedInstructor = instructorSelect.value;
                    const courseSelect = document.getElementById('course');
                    const selectedCourseId = courseSelect.value;

                    if (selectedDate || selectedInstructor || selectedCourseId) {
                        let url = `/admin/schedules/booked-times?`;
                        if (selectedDate) url += `date=${selectedDate}&`;
                        if (selectedInstructor) url += `instructor=${selectedInstructor}&`;
                        if (selectedCourseId) url += `course=${selectedCourseId}`;
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
                admissionDateInput.addEventListener('change', fetchBookedTimes);
                instructorSelect.addEventListener('change', fetchBookedTimes);
                document.getElementById('course').addEventListener('change', fetchBookedTimes);
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const courseSelect = document.getElementById('course');
                const feesInput = document.getElementById('fees');
                const durationInput = document.getElementById('course_duration');

                courseSelect.addEventListener('change', function() {
                    const selectedOption = courseSelect.options[courseSelect.selectedIndex];
                    const fees = selectedOption.getAttribute('data-fees');
                    const duration = selectedOption.getAttribute('data-duration');

                    feesInput.value = fees;
                    durationInput.value = parseInt(duration, 10);
                });
            });
        </script>
    </div>
@endsection
