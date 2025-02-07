@extends('layout.app')

@section('bannerImage', asset('main/images/cars/MEHRAN.png'))

@section('content')

    <style>
        .preloader {
            display: none;
        }

        h4 span {
            color: #FF8F1F;
        }

        /* General styles for tabs */
        nav>.nav.nav-tabs {
            display: flex;
            justify-content: center;
            /* Center-align the tabs */
            flex-wrap: nowrap;
            /* Prevent wrapping */
            background-color: black;
            /* Maintain background color */
            border: none;
            padding: 10px 0;
            /* Add padding for spacing */
        }

        /* Individual tab styling */
        nav>div a.nav-item.nav-link {
            flex: 1;
            /* Equal width for all tabs */
            text-align: center;
            /* Center-align text within each tab */
            font-size: 14px;
            /* Adjust font size */
            /* color: #fff; */
            padding: 10px 15px;
            /* Add padding for a better click area */
            margin: 0 5px;
            /* Add spacing between tabs */
            border-radius: 5px;
            /* Add slight rounding for a modern look */
            background-color: black;
            /* Match background color */
            transition: all 0.3s ease;
            /* Smooth transition effect */
        }

        /* Active tab styling */
        nav>div a.nav-item.nav-link.active {
            background-color: #FF8F1F;
            /* Highlight active tab */
            color: #fff;
            /* Keep text white */
            border-color: #FF8F1F;

            border-radius: 5px;
        }

        /* Remove hover effect */
        nav>div a.nav-item.nav-link:hover,
        nav>div a.nav-item.nav-link:focus {
            background-color: #272e38;
            /* Maintain original color on hover */
            /* color: #fff; */
            /* Keep text white */
        }

        .tab-content {
            background: #fdfdfd;
            line-height: 25px;
            /* padding: 30px 25px; */
        }

        nav>div a.nav-item.nav-link:hover,
        nav>div a.nav-item.nav-link:focus {
            border: none;
            background: #FF8F1F;
            color: #fff;
            border-radius: 0;
            transition: background 0.20s linear;
        }


        .checkmark {
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #FF8F1F;
            color: white;
            text-align: center;
            line-height: 20px;
            font-size: 16px;
            margin-right: 10px;

        }

        /* Background for each step container */
        .step-container {
            /* Subtle border */
            border-radius: 8px;
            /* Rounded corners */
            padding: 20px;
            /* Add some space inside the container */
            margin-bottom: 20px;
            /* Space between the steps */
        }

        /* Background colors for steps */
        .step-1 {
            background-color: #09296B;
            /* Dark blue for Step 1 */
            color: white;
            /* White text for contrast */
        }

        .step-2 {
            background-color: #FF8F1F;
            /* Orange for Step 2 */
            color: white;
            /* White text for contrast */
        }

        .step-3 {
            background-color: #09296B;
            /* Dark blue for Step 3 */
            color: white;
            /* White text for contrast */
        }

        .step-4 {
            background-color: #FF8F1F;
            /* Orange for Step 4 */
            color: white;
            /* White text for contrast */
        }

        /* Style for headings */
        .step-container h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: white;
        }

        .our_pricing {
            background-size: 100%;
            background-repeat: no-repeat;
            background-position: top center;
            position: relative;
            /* padding: 20px; */
        }

        @media only screen and (max-width: 480px) {
            .our_pricing {
                background-size: auto;
            }
        }

        .pricingTable {
            background: #fff;
            color: #232434;
            margin-top: 30px;
            padding: 50px 15px;
            box-shadow: 0px 19px 43px 0px rgba(17, 17, 17, 0.05);
            perspective: 700px;
            margin-top: 20px;
            text-align: center;
            transition: all 0.3s ease-in-out;
        }

        .pricingTabletop {
            margin-top: -30px;
        }

        .pricingTable .price-value .value-bg {
            color: #FF8F1F;
            font-weight: 600;
            font-size: 60px;
            display: inline-block;
        }

        .pricingTable-2 .price-value {
            color: #e6e4ff;
        }

        .pricingTable-2 .price-value .value-bg {
            color: #FF8F1F;
        }

        .pricingTable .pricing-content {
            list-style: none;
            padding: 0;
            margin: 0 0 20px 0;
        }

        .pricingTable .pricing-content li {
            line-height: 40px;
        }

        .btn-price-bg {
            background: #FF8F1F;
            border: 2px solid #FF8F1F;
            border-radius: 5000px;
            color: #fff;
            font-size: 16px;
            padding: 12px 40px;
            text-transform: capitalize;
            transition: all 0.3s ease;
        }

        .pricingTable:hover .btn-price-bg {
            background: #232434;
            border: 2px solid #232434;
        }

        @media only screen and (max-width: 767px) {
            .pricingTable {
                margin-bottom: 50px;
            }

            .pricingTable .price-value .value-bg {
                font-size: 40px;
            }
        }

        @media only screen and (max-width: 480px) {
            .pricingTable .price-value .value-bg {
                font-size: 40px;
            }

            .customli {
                margin: 15px 0px;
            }
        }

        .section-title {
            margin-bottom: 60px;
        }

        h1.section-title-white {
            color: #fff;
        }

        .section-title h1 {
            font-size: 44px;
            font-weight: 500;
            margin-top: 0;
            position: relative;
            text-transform: capitalize;
            margin-bottom: 15px;
        }

        p.section-title-white {
            color: #fff;
        }

        .section-title p {
            padding: 0 10px;
            width: 70%;
            margin: auto;
            letter-spacing: 1px;
        }
    </style>

    <div class="container-fluid px-3">
        <div class="row">
            <div class="col-12" style="padding: 0px;">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                            aria-controls="nav-home" aria-selected="true">Training</a>
                        <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                            role="tab" aria-controls="nav-profile" aria-selected="false">Rates/Fees</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact"
                            role="tab" aria-controls="nav-contact" aria-selected="false">Register</a>
                    </div>
                </nav>
                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="auto-container mt-5">
                            <ul>
                                <li><span class="checkmark customli">&#x2713;</span> Monday to Saturday: 8:00 am - 8:00 pm
                                    for
                                    gents &
                                    9:00 am - 5:00 pm for ladies</li>
                                <li><span class="checkmark customli">&#x2713;</span> Students can take 1 to 2 hours maximum
                                    daily
                                    or
                                    according to their selected package time.</li>
                                <li><span class="checkmark customli">&#x2713;</span> If you wish to stop the classes due to
                                    health
                                    issues, please inform us 1 hour in advance so your training will be extended
                                    accordingly.
                                </li>
                                <li><span class="checkmark customli">&#x2713;</span> In case your instructor is absent, we
                                    will
                                    arrange a replacement instructor. If we fail to provide another instructor, your
                                    training will be extended accordingly.</li>
                            </ul>
                        </div>

                        <div class="row clearfix mt-5 px-sm-5">
                            <div class="col-lg-3 col-md-6 col-sm-12 step-container step-1">
                                <h3>STEP 1</h3>
                                <ul>
                                    <li><span class="checkmark">&#x2713;</span> Prospectus</li>
                                    <li><span class="checkmark">&#x2713;</span> Starting Car and Switching Off</li>
                                    <li><span class="checkmark">&#x2713;</span> Use of Car Wipers</li>
                                    <li><span class="checkmark">&#x2713;</span> Use of Hand Brake</li>
                                    <li><span class="checkmark">&#x2713;</span> Use of Seatbelt</li>
                                    <li><span class="checkmark">&#x2713;</span> Car Interior Cockpit</li>
                                    <li><span class="checkmark">&#x2713;</span> Traffic Signs</li>
                                    <li><span class="checkmark">&#x2713;</span> Driver's Responsibilities</li>
                                </ul>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 step-container step-2">
                                <h3>STEP 2</h3>
                                <ul>
                                    <li><span class="checkmark">&#x2713;</span> The Driving Task</li>
                                    <li><span class="checkmark">&#x2713;</span> 1st and 2nd Gear Practice</li>
                                    <li><span class="checkmark">&#x2713;</span> Steering Control</li>
                                    <li><span class="checkmark">&#x2713;</span> Reverse Gear Practice</li>
                                    <li><span class="checkmark">&#x2713;</span> Lane Control</li>
                                    <li><span class="checkmark">&#x2713;</span> Lane and Line Difference</li>
                                    <li><span class="checkmark">&#x2713;</span> Fear of Driving</li>
                                </ul>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 step-container step-3">
                                <h3>STEP 3</h3>
                                <ul>
                                    <li><span class="checkmark">&#x2713;</span> Hourly Road Practice</li>
                                    <li><span class="checkmark">&#x2713;</span> Defensive Driving</li>
                                    <li><span class="checkmark">&#x2713;</span> U-Turning</li>
                                    <li><span class="checkmark">&#x2713;</span> Round About Turning</li>
                                    <li><span class="checkmark">&#x2713;</span> Traffic Signals Crossing</li>
                                    <li><span class="checkmark">&#x2713;</span> Use of Side Mirrors</li>
                                    <li><span class="checkmark">&#x2713;</span> Use of Back View Mirrors</li>
                                </ul>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 step-container step-4">
                                <h3>STEP 4</h3>
                                <ul>
                                    <li><span class="checkmark">&#x2713;</span> Theory Class</li>
                                    <li><span class="checkmark">&#x2713;</span> Types of Traffic Signs</li>
                                    <li><span class="checkmark">&#x2713;</span> Traffic Rules</li>
                                    <li><span class="checkmark">&#x2713;</span> Changing of Tyre</li>
                                    <li><span class="checkmark">&#x2713;</span> Parallel Parking</li>
                                    <li><span class="checkmark">&#x2713;</span> S shape Parking</li>
                                    <li><span class="checkmark">&#x2713;</span> L shape Parking</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade show active" id="nav-profile" role="tabpanel"
                        aria-labelledby="nav-profile-tab">
                        <section id="pricing" class="our_pricing section-padding">
                            <div class="container">
                                @php
                                    $hasBoth = $courses->where('course_type', 'both')->isNotEmpty();
                                    $hasIndividuals = $courses
                                        ->whereIn('course_type', ['male', 'female'])
                                        ->isNotEmpty();
                                @endphp

                                @if ($hasBoth && !$hasIndividuals)
                                    <!-- Show only "Both" section -->
                                    <div class="row justify-content-center text-center mt-5">
                                        <div class="col-12">
                                            <h4><span>FOR MALE & FEMALE</span></h4>
                                        </div>
                                        @foreach ($courses->where('course_type', 'both') as $course)
                                            <div class="col-xs-12 col-sm-12 col-md-4">
                                                <div class="pricingTable">
                                                    <div class="pricingTable-header">
                                                        <h3 class="price-value"><span
                                                                class="value-bg">{{ $course->duration_days }} Days</span>
                                                        </h3>
                                                        <h3 class="title">{{ $course->duration_minutes }} Min</h3>
                                                    </div>
                                                    <ul class="pricing-content">
                                                        <li>{{ $course->duration_days - 1 }} Days Practical Driving</li>
                                                        <li>{{ $course->duration_minutes }} Minutes Daily</li>
                                                        <li>01 Theory Class</li>
                                                        <li>{{ ucfirst($course->carModel->transmission) }}</li>
                                                    </ul>
                                                    <h1 class="price-value"><span
                                                            class="value-bg">{{ number_format($course->fees, 0) }}/-</span>
                                                    </h1>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @elseif ($hasBoth && $hasIndividuals)
                                    <!-- Show both "Both" and individual sections -->
                                    <div class="row justify-content-center text-center mt-5">
                                        <div class="col-12">
                                            <h4><span>FOR MALE & FEMALE</span></h4>
                                        </div>
                                        @foreach ($courses->where('course_type', 'both') as $course)
                                            <div class="col-xs-12 col-sm-12 col-md-4">
                                                <div class="pricingTable">
                                                    <div class="pricingTable-header">
                                                        <h3 class="price-value"><span
                                                                class="value-bg">{{ $course->duration_days }} Days</span>
                                                        </h3>
                                                        <h3 class="title">{{ $course->duration_minutes }} Min</h3>
                                                    </div>
                                                    <ul class="pricing-content">
                                                        <li>{{ $course->duration_days - 1 }} Days Practical Driving</li>
                                                        <li>{{ $course->duration_minutes }} Minutes Daily</li>
                                                        <li>01 Theory Class</li>
                                                        <li>{{ ucfirst($course->carModel->transmission) }}</li>
                                                    </ul>
                                                    <h1 class="price-value"><span
                                                            class="value-bg">{{ number_format($course->fees, 0) }}/-</span>
                                                    </h1>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Female Section -->
                                    <div class="row justify-content-center text-center mt-5">
                                        <div class="col-12">
                                            <h4><span>FOR FEMALES</span></h4>
                                        </div>
                                        @foreach ($courses->where('course_type', 'female') as $course)
                                            <div class="col-xs-12 col-sm-12 col-md-4">
                                                <div class="pricingTable">
                                                    <div class="pricingTable-header">
                                                        <h3 class="price-value"><span
                                                                class="value-bg">{{ $course->duration_days }} Days</span>
                                                        </h3>
                                                        <h3 class="title">{{ $course->duration_minutes }} Min</h3>
                                                    </div>
                                                    <ul class="pricing-content">
                                                        <li>{{ $course->duration_days - 1 }} Days Practical Driving</li>
                                                        <li>{{ $course->duration_minutes }} Minutes Daily</li>
                                                        <li>01 Theory Class</li>
                                                        <li>{{ ucfirst($course->carModel->transmission) }}</li>
                                                    </ul>
                                                    <h1 class="price-value"><span
                                                            class="value-bg">{{ number_format($course->fees, 0) }}/-</span>
                                                    </h1>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Male Section -->
                                    <div class="row justify-content-center text-center mt-5">
                                        <div class="col-12">
                                            <h4><span>FOR MALES</span></h4>
                                        </div>
                                        @foreach ($courses->where('course_type', 'male') as $course)
                                            <div class="col-xs-12 col-sm-12 col-md-4">
                                                <div class="pricingTable">
                                                    <div class="pricingTable-header">
                                                        <h3 class="price-value"><span
                                                                class="value-bg">{{ $course->duration_days }} Days</span>
                                                        </h3>
                                                        <h3 class="title">{{ $course->duration_minutes }} Min</h3>
                                                    </div>
                                                    <ul class="pricing-content">
                                                        <li>{{ $course->duration_days - 1 }} Days Practical Driving</li>
                                                        <li>{{ $course->duration_minutes }} Minutes Daily</li>
                                                        <li>01 Theory Class</li>
                                                        <li>{{ ucfirst($course->carModel->transmission) }}</li>
                                                    </ul>
                                                    <h1 class="price-value"><span
                                                            class="value-bg">{{ number_format($course->fees, 0) }}/-</span>
                                                    </h1>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <!-- Show only individual sections -->
                                    <div class="row justify-content-center text-center mt-5">
                                        <div class="col-12">
                                            <h4><span>FOR FEMALES</span></h4>
                                        </div>
                                        @foreach ($courses->where('course_type', 'female') as $course)
                                            <div class="col-xs-12 col-sm-12 col-md-4">
                                                <div class="pricingTable">
                                                    <div class="pricingTable-header">
                                                        <h3 class="price-value"><span
                                                                class="value-bg">{{ $course->duration_days }} Days</span>
                                                        </h3>
                                                        <h3 class="title">{{ $course->duration_minutes }} Min</h3>
                                                    </div>
                                                    <ul class="pricing-content">
                                                        <li>{{ $course->duration_days - 1 }} Days Practical Driving</li>
                                                        <li>{{ $course->duration_minutes }} Minutes Daily</li>
                                                        <li>01 Theory Class</li>
                                                        <li>{{ ucfirst($course->carModel->transmission) }}</li>
                                                    </ul>
                                                    <h1 class="price-value"><span
                                                            class="value-bg">{{ number_format($course->fees, 0) }}/-</span>
                                                    </h1>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="row justify-content-center text-center mt-5">
                                        <div class="col-12">
                                            <h4><span>FOR MALES</span></h4>
                                        </div>
                                        @foreach ($courses->where('course_type', 'male') as $course)
                                            <div class="col-xs-12 col-sm-12 col-md-4">
                                                <div class="pricingTable">
                                                    <div class="pricingTable-header">
                                                        <h3 class="price-value"><span
                                                                class="value-bg">{{ $course->duration_days }} Days</span>
                                                        </h3>
                                                        <h3 class="title">{{ $course->duration_minutes }} Min</h3>
                                                    </div>
                                                    <ul class="pricing-content">
                                                        <li>{{ $course->duration_days - 1 }} Days Practical Driving</li>
                                                        <li>{{ $course->duration_minutes }} Minutes Daily</li>
                                                        <li>01 Theory Class</li>
                                                        <li>{{ ucfirst($course->carModel->transmission) }}</li>
                                                    </ul>
                                                    <h1 class="price-value"><span
                                                            class="value-bg">{{ number_format($course->fees, 0) }}/-</span>
                                                    </h1>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="auto-container mt-5">
                                <ul>
                                    <li><span class="checkmark customli">&#x2713;</span>Free Driving Course Certificate.</li>
                                    <li><span class="checkmark customli">&#x2713;</span>One Theory Class is Compulsory.
                                    </li>
                                    <li><span class="checkmark customli">&#x2713;</span>This packages do not include
                                        pick-and-drop services. Pick-and-drop charges are based on your location.</li>
                                    <li><span class="checkmark customli">&#x2713;</span>Change Of Driving Route Will Be
                                        Charged Separately 10,000/-
                                    </li>
                                </ul>
                            </div>
                        </section>
                    </div>

                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
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
                                    <form method="post" action="{{ route('public.admission.store') }}"
                                        id="contact-form">
                                        @csrf
                                        <div class="row clearfix">
                                            <!-- Name -->
                                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                                <div class="field-inner">
                                                    <input type="text" name="name" value="{{ old('name') }}"
                                                        placeholder="Your Name" required>
                                                </div>
                                            </div>

                                            <!-- Phone -->
                                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                                <div class="field-inner">
                                                    <input type="text" name="phone" value="{{ old('phone') }}"
                                                        placeholder="Phone Number" required>
                                                </div>
                                            </div>

                                            <!-- Full Address -->
                                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                                <div class="field-inner">
                                                    <input type="text" name="address" value="{{ old('address') }}"
                                                        placeholder="Full Address" required>
                                                </div>
                                            </div>

                                            <!-- Pickup Sector -->
                                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                                <div class="field-inner">
                                                    <input type="text" name="pickup_sector"
                                                        value="{{ old('pickup_sector') }}"
                                                        placeholder="Your Pickup Sector (e.g., I-10)" required>
                                                </div>
                                            </div>

                                            <!-- Email (Optional) -->
                                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                                <div class="field-inner">
                                                    <input type="email" name="email" value="{{ old('email') }}"
                                                        placeholder="Your Email">
                                                </div>
                                            </div>

                                            <!-- Car Model Dropdown -->
                                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                                <div class="field-inner">
                                                    <select class="form-select @error('car_model_id') is-invalid @enderror"
                                                        id="car_model" name="car_model_id" required>
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
                                                    <select class="form-select @error('gender') is-invalid @enderror"
                                                        id="gender" name="gender" required>
                                                        <option value="" disabled selected>Select Gender</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>
                                                    @error('gender')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Course Dropdown -->
                                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                                <div class="field-inner">
                                                    <select class="form-select @error('course_id') is-invalid @enderror"
                                                        id="course" name="course_id" required>
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
                    </div>

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
                                                if ('{{ $course->course_type }}' === gender) {
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

                </div>
            </div>
        </div>
    </div>
@endsection
