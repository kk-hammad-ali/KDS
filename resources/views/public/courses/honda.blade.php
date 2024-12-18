@extends('layout.app')

@section('title', 'Honda City - Automatic')
@section('breadcrumb', 'Honda City - Automatic')

@section('bannerImage', asset('main/images/resource/image-15.jpg'))


@section('content')

    <style>
        .preloader {
            display: none;
        }

        nav>.nav.nav-tabs {

            border: none;
            color: #fff;
            background: #272e38;
            border-radius: 0;

        }

        nav>div a.nav-item.nav-link,
        nav>div a.nav-item.nav-link.active {
            border: none;
            padding: 18px 25px;
            color: #fff;
            background: #272e38;
            border-radius: 0;
        }

        nav>div a.nav-item.nav-link.active:after {
            content: "";
            position: relative;
            bottom: -60px;
            left: -10%;
            border: 15px solid transparent;
            border-top-color: #FF8F1F;
        }

        .tab-content {
            background: #fdfdfd;
            line-height: 25px;
            border-top: 5px solid #FF8F1F;
            border-bottom: 5px solid #FF8F1F;
            padding: 30px 25px;
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
            margin-top: 120px;
            padding: 20px;
        }

        @media only screen and (max-width:480px) {
            .our_pricing {
                background-size: auto;
            }
        }

        .pricingTable {
            background: #fff none repeat scroll 0 0;
            color: #232434;
            margin-top: 30px;
            padding: 50px 15px;
            -webkit-box-shadow: 0px 19px 43px 0px rgba(17, 17, 17, 0.05);
            box-shadow: 0px 19px 43px 0px rgba(17, 17, 17, 0.05);
            -webkit-perspective: 700px;
            perspective: 700px;
            position: relative;
            text-align: center;
            -webkit-transition: all 0.3s ease-in-out 0s;
            -o-transition: all 0.3s ease-in-out 0s;
            transition: all 0.3s ease-in-out 0s;
            z-index: 1;
        }

        @media only screen and (max-width:480px) {
            .pricingTable {
                margin-bottom: 60px;
            }
        }

        .pricingTabletop {
            margin-top: -30px;
        }

        .pricingTable .pricingTable-header {}

        .pricingTable .title {
            display: block;
            font-size: 24px;
            font-weight: 600;
            text-transform: capitalize;
            -webkit-transition: all 0.3s ease-in-out 0s;
            -o-transition: all 0.3s ease-in-out 0s;
            transition: all 0.3s ease-in-out 0s;
        }

        .pricingTable .price-month {
            font-size: 16px;
            font-weight: 500;
            margin-top: 5px;
        }

        .pricingTable .price-value {
            /* font-size: 170px; */
            /* line-height: 112px;
                                                                                                                                                position: relative;
                                                                                                                                                color: #e4f1ff;
                                                                                                                                                margin: 40px 0; */
        }

        @media only screen and (max-width:768px) {
            .pricingTable .price-value {
                font-size: 130px;
            }
        }

        .pricingTable .price-value .value-bg {
            display: contents;
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translateX(-50%) translateY(-50%);
            -ms-transform: translateX(-50%) translateY(-50%);
            transform: translateX(-50%) translateY(-50%);
            color: #FF8F1F;
            font-weight: 600;
            font-size: 60px;
            line-height: 20px;
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

        .pricing-content-border {}

        .pricing-content-border>li {
            border: 1px solid #eee;
            margin-bottom: 10px;
        }

        .pricingTable .pricing-content li {
            line-height: 40px;
        }

        @media only screen and (max-width: 990px) {
            .pricingTable {
                margin-bottom: 30px;
            }
        }

        @media only screen and (max-width: 767px) {
            .pricingTable {
                margin-bottom: 50px;
            }
        }

        .btn-price-bg {
            background: #FF8F1F;
            border: 2px solid #FF8F1F;
            border-radius: 5000px;
            color: #fff;
            display: inline-block;
            font-size: 16px;
            overflow: hidden;
            padding: 12px 40px;
            text-transform: capitalize;
            -webkit-transition: all 0.3s ease 0s;
            -o-transition: all 0.3s ease 0s;
            transition: all 0.3s ease 0s;
        }

        .pricingTable:hover .btn-price-bg {
            background: #232434;
            color: #fff;
            border: 2px solid #232434;
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
    <div class="container-fluid px-5">
        <div class="row">
            <div class="col-12">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                            aria-controls="nav-home" aria-selected="true">Training Details</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                            role="tab" aria-controls="nav-profile" aria-selected="false">Rates/Fees</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact"
                            role="tab" aria-controls="nav-contact" aria-selected="false">Register</a>
                    </div>
                </nav>
                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="auto-container mt-5">
                            <ul>
                                <li><span class="checkmark">&#x2713;</span> Monday to Saturday: 8:00 am - 8:00 pm for
                                    gents &
                                    9:00 am - 6:00 pm for ladies</li>
                                <li><span class="checkmark">&#x2713;</span> Students can take 1 to 2 hours maximum daily
                                    or
                                    according to their selected package time.</li>
                                <li><span class="checkmark">&#x2713;</span> If you wish to stop the classes due to
                                    health
                                    issues, please inform us 1 hour in advance so your training will be extended
                                    accordingly.
                                </li>
                                <li><span class="checkmark">&#x2713;</span> In case your instructor is absent, we will
                                    arrange a replacement instructor. If we fail to provide another instructor, your
                                    training will be extended accordingly.</li>
                            </ul>
                        </div>

                        <div class="row clearfix mt-5">
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
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <section id="pricing" class="our_pricing section-padding">
                            <div class="container">
                                <div class="row">
                                    <!-- Standard Plan -->
                                    <div class="col-xs-12 col-sm-4 col-lg-4">
                                        <div class="pricingTable pricingTable-2">
                                            <div class="pricingTable-header">
                                                <h3 class="title">30 Min</h3>

                                                <h1 class="price-value"> <span class="value-bg">10 Days</span></h1>
                                                <h1 class="price-value"> <span class="value-bg">20,000/-</span></h1>
                                            </div>
                                            <ul class="pricing-content">
                                                <li>09 Days Practical Driving</li>
                                                <li>30 Minutes Daily</li>
                                                <li>01 Theory Class</li>
                                                <li>Automatic</li>
                                            </ul>
                                        </div>
                                    </div><!-- END COL -->

                                    <!-- Business Plan -->
                                    <div class="col-xs-12 col-sm-4 col-lg-4">
                                        <div class="pricingTable pricingTabletop pricingTable-2">
                                            <div class="pricingTable-header">
                                                <h3 class="title">60 Min</h3>

                                                <h1 class="price-value"> <span class="value-bg">10 Days</span></h1>
                                                <h1 class="price-value"> <span class="value-bg">27,000/-</span></h1>
                                            </div>
                                            <ul class="pricing-content">
                                                <li>09 Days Practical Driving</li>
                                                <li>60 Minutes Daily</li>
                                                <li>01 Theory Class</li>
                                                <li>Automatic</li>
                                            </ul>
                                        </div>
                                    </div><!-- END COL -->

                                    <!-- Premium Plan -->
                                    <div class="col-xs-12 col-sm-4 col-lg-4">
                                        <div class="pricingTable pricingTable-2">
                                            <div class="pricingTable-header">
                                                <h3 class="title">60 Min</h3>

                                                <h1 class="price-value"> <span class="value-bg">15 Days</span></h1>
                                                <h1 class="price-value"> <span class="value-bg">40,000/-</span></h1>
                                            </div>
                                            <ul class="pricing-content">
                                                <li>14 Days Practical Driving</li>
                                                <li>60 Minutes Daily</li>
                                                <li>01 Theory Class</li>
                                                <li>Automatic</li>
                                            </ul>
                                        </div>
                                    </div><!-- END COL -->
                                </div><!--END ROW -->


                                <!-- Additional Terms -->
                                <ul class="mt-5">
                                    <li><span class="checkmark">&#x2713;</span> One Theory Class is Compulsory.</li>
                                    <li><span class="checkmark">&#x2713;</span> Pick & Drop charges will be according to
                                        location.</li>
                                    <li><span class="checkmark">&#x2713;</span> Change of Driving Route will be charged
                                        separately ₨ 10,000/-.</li>
                                    <li><span class="checkmark">&#x2713;</span> Air-conditioned facility available in car ₨
                                        5,000/-.</li>
                                    <li><span class="checkmark">&#x2713;</span> Individual training classes fee ₨ 10,000/-.
                                    </li>
                                </ul>
                            </div><!-- END CONTAINER -->
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

                                            <!-- Father/Husband Name -->
                                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                                <div class="field-inner">
                                                    <input type="text" name="father_husband_name"
                                                        value="{{ old('father_husband_name') }}"
                                                        placeholder="Father/Husband Name" required>
                                                </div>
                                            </div>

                                            <!-- CNIC -->
                                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                                <div class="field-inner">
                                                    <input type="text" name="cnic" value="{{ old('cnic') }}"
                                                        placeholder="CNIC" required>
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

                                            <!-- Secondary Phone -->
                                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                                <div class="field-inner">
                                                    <input type="text" name="secondary_phone"
                                                        value="{{ old('secondary_phone') }}"
                                                        placeholder="Secondary Phone">
                                                </div>
                                            </div>

                                            <!-- Email (Optional) -->
                                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                                <div class="field-inner">
                                                    <input type="email" name="email" value="{{ old('email') }}"
                                                        placeholder="Your Email">
                                                </div>
                                            </div>

                                            <!-- Course Dropdown -->
                                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                                <div class="field-inner">
                                                    <select class="form-select @error('course_id') is-invalid @enderror"
                                                        id="course" name="course_id" required>
                                                        <option value="" disabled selected>Select Course</option>
                                                        @foreach ($courses as $course)
                                                            <option value="{{ $course->id }}"
                                                                data-fees="{{ $course->fees }}"
                                                                data-duration="{{ $course->duration_days }}">
                                                                {{ $course->car->make }} - {{ $course->car->model }} -
                                                                {{ $course->car->registration_number }}
                                                                ({{ $course->duration_days }} Days,
                                                                {{ $course->car->transmission }})
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
                                                    <input type="number"
                                                        class="form-control @error('fees') is-invalid @enderror"
                                                        id="fees" name="fees" value="{{ old('fees') }}"
                                                        placeholder="Course Fee" readonly required>
                                                    @error('fees')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Course Duration -->
                                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                                <div class="field-inner">
                                                    <input type="text"
                                                        class="form-control @error('course_duration') is-invalid @enderror"
                                                        id="course_duration" name="course_duration"
                                                        value="{{ old('course_duration') }}"
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
