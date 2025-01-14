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

                        <!-- Car Model Dropdown -->
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <div class="field-inner">
                                <select class="form-select @error('car_model_id') is-invalid @enderror" id="car_model"
                                    name="car_model_id" required>
                                    <option value="" disabled selected>Select Car Model</option>
                                    @foreach ($carModels as $carModel)
                                        <option value="{{ $carModel->id }}">{{ $carModel->name }}
                                            ({{ ucfirst($carModel->transmission) }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('car_model_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Gender Dropdown -->
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <div class="field-inner">
                                <select class="form-select @error('gender') is-invalid @enderror" id="gender"
                                    name="gender" required>
                                    <option value="" disabled selected>Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="both">Male & Female Both</option> <!-- Added "both" option -->
                                </select>
                                @error('gender')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
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
            const carModelSelect = document.getElementById('car_model');
            const genderSelect = document.getElementById('gender');
            const courseSelect = document.getElementById('course');

            function updateCourses() {
                const carModelId = carModelSelect.value;
                const gender = genderSelect.value;

                courseSelect.innerHTML = '<option value="" disabled selected>Select Course</option>';

                if (carModelId && gender) {
                    @foreach ($carModels as $carModel)
                        if (carModelId == {{ $carModel->id }}) {
                            @foreach ($carModel->courses as $course)
                                if ('{{ $course->course_type }}' === gender || '{{ $course->course_type }}' ===
                                    'both') {
                                    courseSelect.innerHTML += `
                                <option value="{{ $course->id }}">
                                    {{ $course->duration_days }} days / {{ $course->duration_minutes }} minutes -
                                    {{ number_format($course->fees, 2) }} PKR
                                </option>`;
                                }
                            @endforeach
                        }
                    @endforeach

                    if (courseSelect.innerHTML === '<option value="" disabled selected>Select Course</option>') {
                        courseSelect.innerHTML =
                            '<option value="" disabled>No courses available for the selected criteria.</option>';
                    }
                }
            }

            carModelSelect.addEventListener('change', updateCourses);
            genderSelect.addEventListener('change', updateCourses);
        });
    </script>
@endsection
