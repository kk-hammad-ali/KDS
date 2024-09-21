<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Design</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <style>
        .content-section {
            display: none;
        }

        .active {
            display: block;
        }

        .pricing-card:hover {
            background-color: black;
            color: white;


        }

        .pricing-card:hover .btn {
            background-color: white;
            color: black;
        }

        /* Ensure icons and other elements inside the card change color on hover */
        .pricing-card:hover .fa,
        .pricing-card:hover .text-muted,
        .pricing-card:hover .card-body {
            color: white !important;
        }

        .hover-effect:hover {
            background-color: black;
            color: white;
        }

        .container .row {
            border-bottom: 2px solid grey;
            /* Single border line under all buttons */
        }

        .btn-link:hover {
            color: #4d68e0;
            /* Change text color to black on hover */
        }

        .btn-link:hover i {
            color: #4d68e0;
            /* Change icon color to black on hover */
        }
    </style>
</head>

<body>
    <div class="bg">
        <!-- Top Social and Contact Section -->
        <div class="top-bar bg-dark text-white" style="padding: 20px;">
            <div class="container-fluid">
                <div class="row justify-content-between">
                    <!-- Social Icons -->
                    <div class="col-auto">
                        <a href="www.facebook.com" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="www.instagram.com" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="www.linkedin.com" class="text-white me-3"><i class="fab fa-linkedin-in"></i></a>
                        <a href="www.twitter.com" class="text-white"><i class="fab fa-twitter"></i></a>
                    </div>
                    <!-- Contact Info -->
                    <div class="col-auto d-flex align-items-center">
                        <a href="#" class="text-white me-4" style="text-decoration: none;">Find Us</a>
                        <a href="#" class="text-white me-4" style="text-decoration: none;"><i
                                class="fas fa-comments"></i> LIVE CHAT</a>
                        <a href="tel:+600595959" class="text-white" style="text-decoration: none;"><i
                                class="fas fa-phone-alt"></i> 600 595959</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid p-0">
            <div class="position-relative" style="height: 50vh;">
                <img src="/images/bimain.jpg" class="w-100 h-100" style="object-fit: cover;">
                <div class="position-absolute" style="top: 30%; left: 10%;">
                    <h1 class="display-3 fw-bold text-light">Motor Bike</h1>
                    <p class="h4 fw-bold text-light">Detailed information of Motor Bike driving course</p>
                </div>
            </div>
        </div>

        <div class="container my-5">
            <div class="row text-center border-bottom border-secondary">
                <div class="col">
                    <button class="btn btn-link text-decoration-none text-muted" onclick="showSection('courseInfo')">
                        <i class="fas fa-book fa-2x d-block"></i>
                        <span>Course Information</span>
                    </button>
                </div>
                <div class="col">
                    <button class="btn btn-link text-decoration-none text-muted"
                        onclick="showSection('documentsRequired')">
                        <i class="fas fa-briefcase fa-2x d-block"></i>
                        <span>Documents Required</span>
                    </button>
                </div>
                <div class="col">
                    <button class="btn btn-link text-decoration-none text-muted" onclick="showSection('pricing')">
                        <i class="fas fa-dollar-sign fa-2x d-block"></i>
                        <span>Pricing</span>
                    </button>
                </div>
                
                <div class="col">
                    <button class="btn btn-link text-decoration-none text-muted"
                    onclick="showSection('trainingDetails')">
                    <i class="fas fa-briefcase fa-2x d-block"></i>
                        <span>Training Details</span>
                    </button>
                </div>
            </div>
        </div>

        <div id="courseInfo" class="content-section">
            <h1 class="text-center mb-4">Course Information</h1>

            <div class="container">
                <div class="row ms-4 me-4 py-2 px-4">
                    <div class="col-md-6">
                        <h2>Course Overview</h2>
                        <p>Eco Drive's Motorcycle riding course is carefully curated in compliance to RTA regulations
                            and
                            provides the learner with not only a strong theoretical base, but also concrete practical
                            experience. Our team of riding instructors offer unparalleled support and guidance right
                            from
                            your first riding lesson, till the time your learning experience concludes and you
                            successfully
                            securing your motorcycle riding license.</p>
                    </div>
                    <div class="col-md-6">
                        <img src="/images/bike1.jpg" class="img-fluid" alt="Responsive image">
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row ms-4 me-4 py-2 px-4">
                    <div class="col-md-6">
                        <img src="/images/bike2.jpg" class="img-fluid" alt="Responsive image">
                    </div>
                    <div class="col-md-6">
                        <h2>What You Learn</h2>
                        <ul class="list-unstyled">
                            <li>&#8226; Key riding elements like balance, navigating turns and controlling your
                                motorbike.
                            </li>
                            <li>&#8226; Keen understanding of traffic signs and traffic rules.</li>
                            <li>&#8226; Use and functionality of different parts of your motorbike including, clutch,
                                brake,
                                gears, accelerator and mirrors.</li>
                            <li>&#8226; Maintaining lane discipline and general riding etiquette</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row ms-4 me-4 py-2 px-4">
                    <div class="col-md-6">
                        <h2>Information Points</h2>
                        <ul class="list-unstyled">
                            <li>&#8226; Learners who do not hold valid motorcycle licenses from other countries will
                                mandatorily need to register for a minimum 20 hours of training, as per RTA
                                requirements.
                            </li>
                            <li>&#8226; Learners who are in possession of valid motorcycle licenses from other countries
                                are
                                permitted to register for a minimum 10 hours of training, as per RTA requirements.</li>
                            <li>&#8226; The minimum age requirement for securing a motorcycle license in Dubai is 17
                                years.
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <img src="/images/bike3.jpg" class="img-fluid" alt="Responsive image">
                    </div>
                </div>
            </div>
        </div>

        <div id="documentsRequired" class="content-section">
            <h1 class="text-center mb-4">Documents Required</h1>
            <div class="container my-5">
                <div class="p-4 border">
                    <h4 class="fw-bold">Mandatory Documents</h4>
                    <ol class="mb-3">
                        <li><strong>Original Emirates ID or a digital copy of the latest Emirates ID from the ICA
                                app</strong></li>
                        <li><strong>Eye test report (before RTA file opening). The eye test is available at the ECO
                                DRIVE
                                main centers or RTA-approved eye test centers in Dubai.</strong></li>
                        <li><strong>Original driving license issued from other countries of the same vehicle category
                                (if
                                any) *</strong></li>
                    </ol>
                    <ul class="list-unstyled ms-4">
                        <li><i class="fas fa-check-circle text-dark me-2"></i>The hologram on the driving license must
                            be
                            visible.</li>
                        <li><i class="fas fa-check-circle text-dark me-2"></i>A valid and expired (less than ten years
                            of
                            expiry) driving licenses are acceptable.</li>
                        <li><i class="fas fa-check-circle text-dark me-2"></i>If your driving license is not issued in
                            English or Arabic, please legally translate your driving license from a legal translation
                            typing
                            office in Dubai.</li>
                        <li><i class="fas fa-check-circle text-dark me-2"></i>For a lost driving license, please seek a
                            letter from the consulate of your country.</li>
                    </ul>
                    <p class="mt-3 mb-0">*Subject to RTA approval. If the driving license is denied by the RTA, please
                        seek
                        a letter from the embassy of your country.</p>
                </div>
            </div>
            <div class="container my-5">
                <div class="p-4 border">
                    <h4 class="fw-bold">Additional Documents For:</h4>
                    <ol class="mb-3">
                        <li><strong>Female customers (less or equal to 21 years) who wish to take training by a male
                                instructor.</strong></li>
                        <ul class="list-unstyled ms-4">
                            <li><i class="fas fa-check-circle text-dark me-2"></i>A no-objection letter signed by the
                                sponsor</li>
                            <li><i class="fas fa-check-circle text-dark me-2"></i>A no-objection letter to be signed by
                                self
                                (only for UAE nationals or company visa holders).</li>
                            <li><i class="fas fa-check-circle text-dark me-2"></i>Copy of the sponsor's Emirates ID</li>
                            <li><i class="fas fa-check-circle text-dark me-2"></i>RTA fees of AED 10/- for getting NOC.
                            </li>
                        </ul>
                    </ol>
                    <ol class="mb-3">
                        <li><strong>Customers holding Partner visa:</strong></li>
                        <ul class="list-unstyled ms-4">
                            <li><i class="fas fa-check-circle text-dark me-2"></i>Copy of a valid UAE trade license</li>
                        </ul>
                    </ol>
                    <ol class="mb-3">
                        <li><strong>Pregnant women:</strong></li>
                        <ul class="list-unstyled ms-4">
                            <li><i class="fas fa-check-circle text-dark me-2"></i>A no-objection letter signed by the
                                sponsor.</li>
                            <li><i class="fas fa-check-circle text-dark me-2"></i>'Fit to Drive' certificate issued by
                                the
                                consulting doctor.</li>
                        </ul>
                    </ol>

                    <ol class="mb-3">
                        <li><strong>File transfer from other institutes within Dubai or other emirates:</strong></li>
                        <ul class="list-unstyled ms-4">
                            <li><i class="fas fa-check-circle text-dark me-2"></i>Original RTA file from the previous
                                driving institute/Centre</li>
                            <li><i class="fas fa-check-circle text-dark me-2"></i>Clearance letter from the previous
                                driving
                                institute/Centre signed and stamped by an authorized signatory. </li>
                            <li><i class="fas fa-check-circle text-dark me-2"></i>Proof of theory lectures attendance.
                            </li>
                            <li><i class="fas fa-check-circle text-dark me-2"></i>Valid or invalid RTA learning permit
                                (not
                                applicable for other emirates)</li>
                        </ul>
                    </ol>
                    <ol class="mb-3">
                        <li><strong>Driver visa holders (excluding Taxi Company):</strong></li>
                        <ul class="list-unstyled ms-4">
                            <li><i class="fas fa-check-circle text-dark me-2"></i>Medical fitness reports from the
                                RTA-approved medical centers or hospitals</li>
                        </ul>
                    </ol>

                    </ol>
                    <ol class="mb-3">
                        <li><strong>File opening process for other Emirates</strong></li>
                        <p class="mt-3 mb-0">Mandatory documents required for applicants.</p>
                        <li><strong>1. On personal or family-sponsored visa currently residing in Dubai:</strong></li>

                        <ul class="list-unstyled ms-4">
                            <li><i class="fas fa-check-circle text-dark me-2"></i>Valid passports copy & visa copy of
                                the
                                sponsor & applicant</li>
                            <li><i class="fas fa-check-circle text-dark me-2"></i>Original and valid Emirates ID</li>
                            <li><i class="fas fa-check-circle text-dark me-2"></i>Valid tenancy contract (Ejari) &
                                electricity bill from DEWA*</li>
                            <li><i class="fas fa-check-circle text-dark me-2"></i>Eye test report (After approval)</li>
                            <li><i class="fas fa-check-circle text-dark me-2"></i>Declaration letter from the school or
                                university (if the applicant is a student in Dubai).</li>
                        </ul>
                    </ol>

                    </ol>
                    <ol class="mb-3">
                        <li><strong> 2. On a company-sponsored visa:
                                Situation 1: Company has a branch in Dubai & currently residing in Dubai:
                            </strong></li>

                        <ul class="list-unstyled ms-4">
                            <li><i class="fas fa-check-circle text-dark me-2"></i>Valid passports copy & visa copy of
                                the
                                applicant</li>
                            <li><i class="fas fa-check-circle text-dark me-2"></i>Original and valid Emirates ID</li>
                            <li><i class="fas fa-check-circle text-dark me-2"></i>
                                Copy of valid trade license of the Dubai branch of the company. The company name must
                                match
                                the name on the trade license</li>
                            <li><i class="fas fa-check-circle text-dark me-2"></i>NOC to mention that the applicant is
                                working in the Dubai branch of the company.</li>
                            <li><i class="fas fa-check-circle text-dark me-2"></i>Eye test (After approval)</li>
                        </ul>
                    </ol>

                    <ol class="mb-3">
                        <li><strong>Situation 2: Company does not have a branch in Dubai & currently residing in
                                Dubai:</strong></li>
                        <p class="mt-3 mb-0">(e.g. Applicants on investor or partner visas from other emirates do not
                            have a
                            branch & currently residing in Dubai)</p>

                        <ul class="list-unstyled ms-4">
                            <li><i class="fas fa-check-circle text-dark me-2"></i>Valid passports copy & visa copy of
                                the
                                sponsor & applicant</li>
                            <li><i class="fas fa-check-circle text-dark me-2"></i>Original and valid Emirates ID</li>
                            <li><i class="fas fa-check-circle text-dark me-2"></i>Valid tenancy contract (Ejari) &
                                electricity bill from DEWA</li>
                            <li><i class="fas fa-check-circle text-dark me-2"></i>Eye test report (After approval)</li>
                            <li><i class="fas fa-check-circle text-dark me-2"></i>NOC issued by the company from other
                                emirates if they do not have any branch in Dubai</li>
                        </ul>
                    </ol>
                </div>
            </div>
        </div>

        <div id="pricing" class="content-section">
            <h1 class="text-center mb-4">Pricing</h1>
            <div class="container my-5">
                <div class="row justify-content-center">
                    <!-- First Pricing Plan -->
                    <div class="col-12 col-md-4 mb-4">
                        <div class="card pricing-card border">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">Regular</h5>
                                <h6 class="card-subtitle mb-2 text-muted"><del>AED 5,074</del> AED 3,678</h6>
                                <p class="card-text">(5% VAT applicable on Eco Drive Fees)</p>
                                <ul class="list-unstyled">
                                    <li><i class="fa fa-check-circle"></i> <strong>Training Days*</strong><br> Any 3
                                        days
                                        from Mon-Sat</li>
                                    <li><i class="fa fa-check-circle"></i> <strong>Training Hours per week*</strong><br>
                                        Up
                                        to 6 hours</li>
                                    <li><i class="fa fa-check-circle"></i>
                                        <strong>Cancellation/Re-scheduling</strong><br>
                                        48 hours prior to the class
                                    </li>
                                    <li><i class="fa fa-check-circle"></i> <strong>Class Timings</strong><br> 08:30 -
                                        17:30
                                    </li>
                                    <li><i class="fa fa-check-circle"></i> <strong>Training fees per hour</strong><br>
                                        AED
                                        80</li>
                                </ul>
                                <a href="#" class="btn btn-dark w-100">Choose Regular</a>
                            </div>
                        </div>
                    </div>

                    <!-- Second Pricing Plan -->
                    <div class="col-12 col-md-4 mb-4">
                        <div class="card pricing-card border">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">Flexi</h5>
                                <h6 class="card-subtitle mb-2 text-muted"><del>AED 5,874</del> AED 4,278</h6>
                                <p class="card-text">(5% VAT applicable on Eco Drive Fees)</p>
                                <ul class="list-unstyled">
                                    <li><i class="fa fa-check-circle"></i> <strong>Training Days*</strong><br> 7 days a
                                        week
                                        from Mon-Sun</li>
                                    <li><i class="fa fa-check-circle"></i> <strong>Training Hours per week*</strong><br>
                                        Up
                                        to 14 hours</li>
                                    <li><i class="fa fa-check-circle"></i>
                                        <strong>Cancellation/Re-scheduling</strong><br>
                                        12 hours prior to the class
                                    </li>
                                    <li><i class="fa fa-check-circle"></i> <strong>Class Timings</strong><br> 08:30 -
                                        17:30
                                        and 20:00 - 23:00</li>
                                    <li><i class="fa fa-check-circle"></i> <strong>Training fees per hour</strong><br>
                                        AED
                                        110</li>
                                </ul>
                                <a href="#" class="btn btn-dark w-100">Choose Flexi</a>
                            </div>
                        </div>
                    </div>

                    <!-- Third Pricing Plan -->
                    <div class="col-12 col-md-4 mb-4">
                        <div class="card pricing-card border">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">Lumpsum - Automatic</h5>
                                <h6 class="card-subtitle mb-2 text-muted"><del>AED 9,250</del> AED 7,645</h6>
                                <p class="card-text">(5% VAT applicable on Eco Drive Fees)</p>
                                <ul class="list-unstyled">
                                    <li><i class="fa fa-check-circle"></i> <strong>Training Days*</strong><br> Any 5
                                        days
                                        from Mon-Sat</li>
                                    <li><i class="fa fa-check-circle"></i> <strong>Training Hours per week*</strong><br>
                                        Up
                                        to 10 hours</li>
                                    <li><i class="fa fa-check-circle"></i>
                                        <strong>Cancellation/Re-scheduling</strong><br>
                                        24 hours prior to the class
                                    </li>
                                    <li><i class="fa fa-check-circle"></i> <strong>Class Timings</strong><br> 08:30 -
                                        17:30
                                    </li>
                                    <li><i class="fa fa-check-circle"></i> <strong>Training fees per hour</strong><br>
                                        N/A
                                    </li>
                                </ul>
                                <a href="#" class="btn btn-dark w-100">Choose Lumpsum - Automatic</a>
                            </div>
                        </div>
                    </div>

                    <!-- Repeat for the other two plans -->
                    <!-- Fourth Pricing Plan -->
                    <div class="col-12 col-md-4 mb-4">
                        <div class="card pricing-card border">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">Plan 4</h5>
                                <h6 class="card-subtitle mb-2 text-muted"><del>AED 8,000</del> AED 6,000</h6>
                                <p class="card-text">(5% VAT applicable on Eco Drive Fees)</p>
                                <ul class="list-unstyled">
                                    <li><i class="fa fa-check-circle"></i> <strong>Training Days*</strong><br> Any 4
                                        days
                                        from Mon-Fri</li>
                                    <li><i class="fa fa-check-circle"></i> <strong>Training Hours per week*</strong><br>
                                        Up
                                        to 8 hours</li>
                                    <li><i class="fa fa-check-circle"></i>
                                        <strong>Cancellation/Re-scheduling</strong><br>
                                        24 hours prior to the class
                                    </li>
                                    <li><i class="fa fa-check-circle"></i> <strong>Class Timings</strong><br> 08:30 -
                                        17:30
                                    </li>
                                    <li><i class="fa fa-check-circle"></i> <strong>Training fees per hour</strong><br>
                                        AED
                                        90</li>
                                </ul>
                                <a href="#" class="btn btn-dark w-100">Choose Plan 4</a>
                            </div>
                        </div>
                    </div>

                    <!-- Fifth Pricing Plan -->
                    <div class="col-12 col-md-4 mb-4">
                        <div class="card pricing-card border">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">Plan 5</h5>
                                <h6 class="card-subtitle mb-2 text-muted"><del>AED 10,000</del> AED 8,000</h6>
                                <p class="card-text">(5% VAT applicable on Eco Drive Fees)</p>
                                <ul class="list-unstyled">
                                    <li><i class="fa fa-check-circle"></i> <strong>Training Days*</strong><br> Any 6
                                        days
                                        from Mon-Sat</li>
                                    <li><i class="fa fa-check-circle"></i> <strong>Training Hours per week*</strong><br>
                                        Up
                                        to 12 hours</li>
                                    <li><i class="fa fa-check-circle"></i>
                                        <strong>Cancellation/Re-scheduling</strong><br>
                                        24 hours prior to the class
                                    </li>
                                    <li><i class="fa fa-check-circle"></i> <strong>Class Timings</strong><br> 08:30 -
                                        17:30
                                    </li>
                                    <li><i class="fa fa-check-circle"></i> <strong>Training fees per hour</strong><br>
                                        AED
                                        100</li>
                                </ul>
                                <a href="#" class="btn btn-dark w-100">Choose Plan 5</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="trainingDetails" class="content-section">
            <h1 class="text-center mb-4">Training Details</h1>
            <div class="container my-5">
                <div class="row g-3">
                    <!-- Regular/Lumpsum Container -->
                    <div class="col-md-4">
                        <div class="p-3 border hover-effect">
                            <h5>Regular / Lumpsum</h5>
                            <ul class="list-unstyled">
                                <li>● Any 3 Days in a week (Monday to Saturday)</li>
                                <li>● Training time: 8:25 to 5:30 - all six days</li>
                                <li>● Training not applicable for evening/night and on Sunday</li>
                                <li>● 2 Hours a day</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Flexi Container -->
                    <div class="col-md-4">
                        <div class="p-3 border hover-effect">
                            <h5>Flexi</h5>
                            <ul class="list-unstyled">
                                <li>● Any 7 Days in a week</li>
                                <li>● Training time: 8:25 AM until 11:00 PM</li>
                                <li>● All the available training slots including Sunday, evening, and night</li>
                                <li>● 2 Hours a day</li>
                            </ul>
                        </div>
                    </div>
                    <!-- VIP Container -->
                    <div class="col-md-4">
                        <div class="p-3 border hover-effect">
                            <h5>VIP</h5>
                            <ul class="list-unstyled">
                                <li>● Any 7 Days in a week</li>
                                <li>● Training time: 8:25 AM until 11:00 PM</li>
                                <li>● All the available training slots including Sunday, evening, and night</li>
                                <li>● 8 Hours a day</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Car Training Timing Container -->
                    <div class="col-md-12">
                        <div class="p-3 border">
                            <h5>Car Training Timing</h5>
                            <p>Every 2 Hours of training, Break of one Hour</p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Monday to Thursday</th>
                                        <th>Friday</th>
                                        <th>Saturday and Sunday</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>8.25</td>
                                        <td>8.25</td>
                                        <td>8.25</td>
                                    </tr>
                                    <tr>
                                        <td>9.25</td>
                                        <td>9.25</td>
                                        <td>9.25</td>
                                    </tr>
                                    <tr>
                                        <td>10.30</td>
                                        <td>10.30</td>
                                        <td>10.30</td>
                                    </tr>
                                    <tr>
                                        <td>11.30</td>
                                        <td>11.30</td>
                                        <td>11.30</td>
                                    </tr>
                                    <tr>
                                        <td>12.35</td>
                                        <td class="bg-light"></td>
                                        <td>12.35</td>
                                    </tr>
                                    <tr>
                                        <td>13.35</td>
                                        <td>2.30</td>
                                        <td>13.35</td>
                                    </tr>
                                    <tr>
                                        <td>3.30</td>
                                        <td>3.30</td>
                                        <td>3.00</td>
                                    </tr>
                                    <tr>
                                        <td>4.30</td>
                                        <td>4.30</td>
                                        <td>4.00</td>
                                    </tr>
                                    <tr>
                                        <td>18.00</td>
                                        <td>18.00</td>
                                        <td>18.00</td>
                                    </tr>
                                    <tr>
                                        <td>19.00</td>
                                        <td>19.00</td>
                                        <td>19.00</td>
                                    </tr>
                                    <tr>
                                        <td>20.00</td>
                                        <td>20.00</td>
                                        <td>20.00</td>
                                    </tr>
                                    <tr>
                                        <td>21.00</td>
                                        <td>21.00</td>
                                        <td>21.00</td>
                                    </tr>
                                    <tr>
                                        <td>22.00</td>
                                        <td>22.00</td>
                                        <td>22.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Terms & Conditions Container -->
                    <div class="col-md-12">
                        <div class="p-3 border">
                            <h5>Terms & Conditions</h5>
                            <ul class="list-unstyled">
                                <li>● Always carry your Emirates ID, and RTA learning permit while attending the
                                    practical
                                    training, lectures, and tests.</li>
                                <li>● Please arrive 10 mins earlier than your practical training and tests.</li>
                                <li>● Should you fail to report within 10 minutes of your class, you’ll be marked as
                                    “ABSENT” and compensatory training will apply by paying for the absent class.</li>
                                <li>● Should you wish to temporarily stop your training, please inform us 48 hours in
                                    advance of your scheduled training to avoid absent fees.</li>
                                <li>● Should you wish to stop the classes due to health issues, please inform us 48
                                    hours in
                                    advance of your scheduled training to avoid absent fees. It is mandatory to submit a
                                    DHA-attested medical certificate as proof of absenteeism.</li>
                                <li>● In case your instructor is absent, we will arrange a replacement instructor &
                                    should
                                    we fail to provide another instructor, your training will be extended accordingly.
                                </li>
                                <li>● Your RTA Learning Permit will be valid for 3 months from the time of issue date
                                    (Renewal Charges will be applied as per RTA policy).</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <!-- Image Column -->
                <div class="col-md-6 position-relative p-0">
                    <img src="/images/ee.jpg" class="img-fluid w-100 h-100" style="object-fit: cover;" alt="Your Image">
                </div>

                <div class="col-md-6 p-0 d-flex justify-content-center align-items-center"
                    style="background-color: black;">
                    <div class="text-white p-4 text-center w-100">
                        <h2>Ready to go</h2>
                        <button type="button" class="btn btn-lg"
                            style="background-color: black; border: 2px solid white; color: white; padding: 10px 20px;">
                            Register Now
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            function showSection(sectionId) {
                // Hide all content sections
                const sections = document.querySelectorAll('.content-section');
                sections.forEach(section => {
                    section.classList.remove('active');
                });

                // Show the selected section
                const selectedSection = document.getElementById(sectionId);
                if (selectedSection) {
                    selectedSection.classList.add('active');
                }
            }
        </script>
</body>

</html>