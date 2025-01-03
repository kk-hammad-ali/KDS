@extends('layout.app')

@section('title', 'Apply Now')
@section('breadcrumb', 'Admission Form')

@section('content')
    <style>
        .preloader {
            display: none;
        }
    </style>
    <section class="contact-section">
        <div class="auto-container">
            <div class="title-box centered style-two">
                <div class="subtitle"><span>Be a confident driver</span></div>
                <h2><span>Apply Now</span></h2>
            </div>

            <!-- Display Success Message -->
            @if (session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="form-box contact-form">
                <form method="post" action="{{ route('public.admission.store') }}" id="contact-form">
                    @csrf
                    <div class="row clearfix">
                        <!-- Name -->
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <div class="field-inner">
                                <input type="text" name="name" value="{{ old('name') }}" placeholder="Your Name"
                                    required>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <div class="field-inner">
                                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Phone Number"
                                    required>
                            </div>
                        </div>


                        <!-- Full Address -->
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <div class="field-inner">
                                <input type="text" name="address" value="{{ old('address') }}" placeholder="Full Address"
                                    required>
                            </div>
                        </div>


                        <!-- Pickup Sector -->
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <div class="field-inner">
                                <input type="text" name="pickup_sector" value="{{ old('pickup_sector') }}"
                                    placeholder="Your Pickup Sector (e.g., I-10)" required>
                            </div>
                        </div>

                        <!-- Email (Optional) -->
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <div class="field-inner">
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="Your Email">
                            </div>
                        </div>

                        <!-- Transmission Dropdown -->
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <div class="field-inner">
                                <select class="form-select" id="transmission" name="transmission" required>
                                    <option value="" disabled selected>Select Transmission</option>
                                    @foreach ($courses->pluck('car.transmission')->unique() as $transmission)
                                        <option value="{{ $transmission }}">{{ ucfirst($transmission) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Course Dropdown -->
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <div class="field-inner">
                                <select class="form-select @error('course_id') is-invalid @enderror" id="course"
                                    name="course_id" required>
                                    <option value="" disabled selected>Select Course</option>
                                </select>
                                @error('course_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Fees -->
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <div class="field-inner">
                                <input type="number" class="form-control @error('fees') is-invalid @enderror"
                                    id="fees" name="fees" value="{{ old('fees') }}" placeholder="Course Fee"
                                    readonly required>
                                @error('fees')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Course Duration -->
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <div class="field-inner">
                                <input type="text" class="form-control @error('course_duration') is-invalid @enderror"
                                    id="course_duration" name="course_duration" value="{{ old('course_duration') }}"
                                    placeholder="Course Duration" readonly required>
                                @error('course_duration')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="field-inner text-center">
                                <button type="submit" class="theme-btn btn-style-one"><span>Submit
                                        Application</span></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const transmissionSelect = document.getElementById('transmission');
            const courseSelect = document.getElementById('course');
            const feesInput = document.getElementById('fees');
            const durationInput = document.getElementById('course_duration');

            // Store all courses data
            const coursesData = @json($courses);

            // Update course dropdown when transmission changes
            transmissionSelect.addEventListener('change', function() {
                const selectedTransmission = this.value;

                // Clear the current courses dropdown
                courseSelect.innerHTML = '<option value="" disabled selected>Select Course</option>';

                // Filter courses based on selected transmission
                const filteredCourses = coursesData.filter(course => course.car.transmission ===
                    selectedTransmission);

                // Populate courses dropdown
                filteredCourses.forEach(course => {
                    const option = document.createElement('option');
                    option.value = course.id;
                    option.textContent =
                        `${course.car.make} - ${course.car.model} (${course.duration_days} Days, ${course.car.transmission})`;
                    option.setAttribute('data-fees', course.fees);
                    option.setAttribute('data-duration', course.duration_days);
                    courseSelect.appendChild(option);
                });
            });

            // Update fees and duration when a course is selected
            courseSelect.addEventListener('change', function() {
                const selectedOption = courseSelect.options[courseSelect.selectedIndex];
                feesInput.value = selectedOption.getAttribute('data-fees');
                durationInput.value = selectedOption.getAttribute('data-duration');
            });
        });
    </script>
@endsection
