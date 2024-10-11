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

                        <!-- Father/Husband Name -->
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <div class="field-inner">
                                <input type="text" name="father_husband_name" value="{{ old('father_husband_name') }}"
                                    placeholder="Father/Husband Name" required>
                            </div>
                        </div>

                        <!-- CNIC -->
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <div class="field-inner">
                                <input type="text" name="cnic" value="{{ old('cnic') }}" placeholder="CNIC"
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



                        <!-- Address -->
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="field-inner">
                                <input type="text" name="address" value="{{ old('address') }}"
                                    placeholder="Your Pickup Address (I-10)" required>
                            </div>
                        </div>

                        <!-- Secondary Phone -->
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <div class="field-inner">
                                <input type="text" name="secondary_phone" value="{{ old('secondary_phone') }}"
                                    placeholder="Secondary Phone">
                            </div>
                        </div>

                        <!-- Email (Optional) -->
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <div class="field-inner">
                                <input type="email" name="email" value="{{ old('email') }}"
                                    placeholder="Your Email (Optional)">
                            </div>
                        </div>

                        <!-- Transmission Type Dropdown -->
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <div class="field-inner">
                                <select name="transmission_type" class="form-select" required>
                                    <option value="" disabled selected>Select Transmission Type</option>
                                    <option value="Manual">Manual</option>
                                    <option value="Automatic">Automatic</option>
                                </select>
                            </div>
                        </div>

                        <!-- Course Dropdown -->
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <div class="field-inner">
                                <select class="form-select @error('course_id') is-invalid @enderror" id="course"
                                    name="course_id" required>
                                    <option value="" disabled selected>Select Course</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}" data-fees="{{ $course->fees }}"
                                            data-duration="{{ $course->duration_days }}">
                                            {{ $course->duration_days }} Days
                                        </option>
                                    @endforeach
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
                                    id="fees" name="fees" value="{{ old('fees') }}" placeholder="5000" readonly
                                    required>
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
                                    placeholder="10" readonly required>
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
            const courseSelect = document.getElementById('course');
            const feesInput = document.getElementById('fees');
            const durationInput = document.getElementById('course_duration');

            // Update fees and course duration when a course is selected
            courseSelect.addEventListener('change', function() {
                const selectedOption = courseSelect.options[courseSelect.selectedIndex];
                const fees = selectedOption.getAttribute('data-fees');
                const duration = selectedOption.getAttribute('data-duration');

                // Assign values
                feesInput.value = fees;
                durationInput.value = parseInt(duration, 10); // Ensure duration is an integer
            });
        });
    </script>
@endsection
