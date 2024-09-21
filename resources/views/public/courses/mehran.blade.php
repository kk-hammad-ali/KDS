<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mehran</title>
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
    </style>
</head>

<body>
    

    <div class="container-fluid p-0">
        <div class="position-relative" style="height: 50vh;">
            <img src="/images/carking.webp" class="w-100 h-100" style="object-fit: cover;">
            <div class="position-absolute" style="top: 30%; left: 10%;">
                <h1 class="display-3 fw-bold text-light">Mehran Car</h1>
                <p class="h4 fw-bold text-light">Detailed information of Mehran Car driving course</p>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row text-center">
            <div class="col">
                <button class="btn btn-link text-decoration-none text-muted" onclick="showSection('courseInfo')">
                    <i class="fas fa-book fa-2x d-block"></i>
                    <span>Course Information</span>
                </button>
            </div>
            <div class="col">
                <button class="btn btn-link text-decoration-none text-muted" onclick="showSection('documentsRequired')">
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
                <button class="btn btn-link text-decoration-none text-dark fw-bold"
                    onclick="showSection('trainingDetails')">
                    <i class="fas fa-file-alt fa-2x d-block"></i>
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
                    <p>Eco Drive’s Car Driving course module seamlessly blends theory
                        lessons, simulator sessions, road assessments, and parking tests
                        and practical classes to ensure that you are well-equipped for
                        your final test. The Eco Drive Instructors work with all
                        learners to build proficiency in key parameters like risk
                        management and adherence to traffic regulations</p>
                </div>
                <div class="col-md-6">
                    <img src="/images/mpic1.jpg" class="img-fluid" alt="Responsive image">
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row ms-4 me-4 py-2 px-4">
                <div class="col-md-6">
                    <img src="/images/mpic2.jpg" class="img-fluid" alt="Responsive image">
                </div>
                <div class="col-md-6">
                    <h2>What You Learn</h2>
                    <ul class="list-unstyled">
                        <li>&#8226; Basic understanding of car controls and introduction to how to drive
                        </li>
                        <li>&#8226; Cultivate the right driving habits and getting acquainted with traffic regulations
                            and lane discipline..</li>
                        <li>&#8226; Use and functionality of different parts of your motorbike including, clutch, brake,
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
                            mandatorily need to register for a minimum 20 hours of training, as per RTA requirements.
                        </li>
                        <li>&#8226; Learners who are in possession of valid motorcycle licenses from other countries are
                            permitted to register for a minimum 10 hours of training, as per RTA requirements.</li>
                        <li>&#8226; The minimum age requirement for securing a motorcycle license in Dubai is 17 years.
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <img src="/images/mpic3.jpg" class="img-fluid" alt="Responsive image">
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
                    <li><strong>Eye test report (before RTA file opening). The eye test is available at the ECO DRIVE
                            main centers or RTA-approved eye test centers in Dubai.</strong></li>
                    <li><strong>Original driving license issued from other countries of the same vehicle category (if
                            any) *</strong></li>
                </ol>
                <ul class="list-unstyled ms-4">
                    <li><i class="fas fa-check-circle text-dark me-2"></i>The hologram on the driving license must be
                        visible.</li>
                    <li><i class="fas fa-check-circle text-dark me-2"></i>A valid and expired (less than ten years of
                        expiry) driving licenses are acceptable.</li>
                    <li><i class="fas fa-check-circle text-dark me-2"></i>If your driving license is not issued in
                        English or Arabic, please legally translate your driving license from a legal translation typing
                        office in Dubai.</li>
                    <li><i class="fas fa-check-circle text-dark me-2"></i>For a lost driving license, please seek a
                        letter from the consulate of your country.</li>
                </ul>
                <p class="mt-3 mb-0">*Subject to RTA approval. If the driving license is denied by the RTA, please seek
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
                        <li><i class="fas fa-check-circle text-dark me-2"></i>A no-objection letter to be signed by self
                            (only for UAE nationals or company visa holders).</li>
                        <li><i class="fas fa-check-circle text-dark me-2"></i>Copy of the sponsor's Emirates ID</li>
                        <li><i class="fas fa-check-circle text-dark me-2"></i>RTA fees of AED 10/- for getting NOC.</li>
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
                        <li><i class="fas fa-check-circle text-dark me-2"></i>'Fit to Drive' certificate issued by the
                            consulting doctor.</li>
                    </ul>
                </ol>

                <ol class="mb-3">
                    <li><strong>File transfer from other institutes within Dubai or other emirates:</strong></li>
                    <ul class="list-unstyled ms-4">
                        <li><i class="fas fa-check-circle text-dark me-2"></i>Original RTA file from the previous
                            driving institute/Centre</li>
                        <li><i class="fas fa-check-circle text-dark me-2"></i>Clearance letter from the previous driving
                            institute/Centre signed and stamped by an authorized signatory. </li>
                        <li><i class="fas fa-check-circle text-dark me-2"></i>Proof of theory lectures attendance.</li>
                        <li><i class="fas fa-check-circle text-dark me-2"></i>Valid or invalid RTA learning permit (not
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
                        <li><i class="fas fa-check-circle text-dark me-2"></i>Valid passports copy & visa copy of the
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
                        <li><i class="fas fa-check-circle text-dark me-2"></i>Valid passports copy & visa copy of the
                            applicant</li>
                        <li><i class="fas fa-check-circle text-dark me-2"></i>Original and valid Emirates ID</li>
                        <li><i class="fas fa-check-circle text-dark me-2"></i>
                            Copy of valid trade license of the Dubai branch of the company. The company name must match
                            the name on the trade license</li>
                        <li><i class="fas fa-check-circle text-dark me-2"></i>NOC to mention that the applicant is
                            working in the Dubai branch of the company.</li>
                        <li><i class="fas fa-check-circle text-dark me-2"></i>Eye test (After approval)</li>
                    </ul>
                </ol>

                <ol class="mb-3">
                    <li><strong>Situation 2: Company does not have a branch in Dubai & currently residing in
                            Dubai:</strong></li>
                    <p class="mt-3 mb-0">(e.g. Applicants on investor or partner visas from other emirates do not have a
                        branch & currently residing in Dubai)</p>

                    <ul class="list-unstyled ms-4">
                        <li><i class="fas fa-check-circle text-dark me-2"></i>Valid passports copy & visa copy of the
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
                            <h6 class="card-subtitle mb-2 text-muted"><del>PKR 22,000</del> PKR 20,000</h6>
                            <p class="card-text">(5% VAT applicable on Eco Drive Fees)</p>
                            <ul class="list-unstyled">
                                <li><i class="fa fa-check-circle"></i> <strong>Training Days*</strong><br> 10 </li>
                                <li><i class="fa fa-check-circle"></i> <strong>Training Hours Per Week</strong><br> 5
                                    Hours </li>
                                <li><i class="fa fa-check-circle"></i> <strong>Male Instructor</strong><br> 20,000 </li>
                                <li><i class="fa fa-check-circle"></i> <strong>Female Instructor</strong><br> 22,000
                                </li>
                                <li><i class="fa fa-check-circle"></i> <strong>Manual Transmission</strong></li>
                                <li><i class="fa fa-check-circle"></i> <strong>09 Days Practical Driving</strong></li>
                                <li><i class="fa fa-check-circle"></i> <strong>01 Theory Class</strong>
                                <li><i class="fa fa-check-circle"></i> <strong>30 Minutes Daily</strong></li>
                                <li><i class="fa fa-check-circle"></i> <strong>Change Of Driving Route Will Be Charged
                                        Separately 10,000/-</strong>
                            </ul>
                            <a href="#" class="btn btn-dark w-100">Choose Regular</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-4">
                    <div class="card pricing-card border">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Regular</h5>
                            <h6 class="card-subtitle mb-2 text-muted"><del>PKR 33,000</del> PKR 30,000</h6>
                            <p class="card-text">(5% VAT applicable on Eco Drive Fees)</p>
                            <ul class="list-unstyled">
                                <li><i class="fa fa-check-circle"></i> <strong>Training Days*</strong><br> 15 </li>
                                <li><i class="fa fa-check-circle"></i> <strong>Training Hours Per Week</strong><br> 5
                                    Hours </li>
                                <li><i class="fa fa-check-circle"></i> <strong>Male Instructor</strong><br> 30,000 </li>
                                <li><i class="fa fa-check-circle"></i> <strong>Female Instructor</strong><br> 33,000
                                </li>
                                <li><i class="fa fa-check-circle"></i> <strong>Manual Transmission</strong></li>
                                <li><i class="fa fa-check-circle"></i> <strong>09 Days Practical Driving</strong></li>
                                <li><i class="fa fa-check-circle"></i> <strong>01 Theory Class</strong>
                                <li><i class="fa fa-check-circle"></i> <strong>30 Minutes Daily</strong></li>
                                <li><i class="fa fa-check-circle"></i> <strong>Change Of Driving Route Will Be Charged
                                        Separately 10,000/-</strong>
                            </ul>
                            <a href="#" class="btn btn-dark w-100">Choose Regular</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-4">
                    <div class="card pricing-card border">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Regular</h5>
                            <h6 class="card-subtitle mb-2 text-muted"><del>PKR 12,000</del> PKR 10,000</h6>
                            <p class="card-text">(5% VAT applicable on Eco Drive Fees)</p>
                            <ul class="list-unstyled">
                                <li><i class="fa fa-check-circle"></i> <strong>Training Days*</strong><br> 10 </li>
                                <li><i class="fa fa-check-circle"></i> <strong>Training Hours Per Week</strong><br> 2.5
                                    Hours </li>
                                <li><i class="fa fa-check-circle"></i> <strong>Male Instructor</strong><br> 10,000 </li>
                                <li><i class="fa fa-check-circle"></i> <strong>Female Instructor</strong><br> 15,000
                                </li>
                                <li><i class="fa fa-check-circle"></i> <strong>Manual Transmission</strong></li>
                                <li><i class="fa fa-check-circle"></i> <strong>09 Days Practical Driving</strong></li>
                                <li><i class="fa fa-check-circle"></i> <strong>01 Theory Class</strong>
                                <li><i class="fa fa-check-circle"></i> <strong>30 Minutes Daily</strong></li>
                                <li><i class="fa fa-check-circle"></i> <strong>Change Of Driving Route Will Be Charged
                                        Separately 10,000/-</strong>
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
                            <h6 class="card-subtitle mb-2 text-muted"><del>PKR 20,000</del> PKR 18,000</h6>
                            <p class="card-text">(5% VAT applicable on Eco Drive Fees)</p>
                            <ul class="list-unstyled">
                                <li><i class="fa fa-check-circle"></i> <strong>Training Days*</strong><br> 15 </li>
                                <li><i class="fa fa-check-circle"></i> <strong>Training Hours Per Week</strong><br> 5
                                    Hours </li>
                                <li><i class="fa fa-check-circle"></i> <strong>Male Instructor</strong><br> 18,000 </li>
                                <li><i class="fa fa-check-circle"></i> <strong>Female Instructor</strong><br> 22,500
                                </li>
                                <li><i class="fa fa-check-circle"></i> <strong>Manual Transmission</strong></li>
                                <li><i class="fa fa-check-circle"></i> <strong>09 Days Practical Driving</strong></li>
                                <li><i class="fa fa-check-circle"></i> <strong>01 Theory Class</strong>
                                <li><i class="fa fa-check-circle"></i> <strong>30Minutes Daily</strong></li>
                                <li><i class="fa fa-check-circle"></i> <strong>Change Of Driving Route Will Be Charged
                                        Separately 10,000/-</strong>
                            </ul>
                            <a href="#" class="btn btn-dark w-100">Choose Flexi</a>
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
                        <h5>Step 1</h5>
                        <ul class="list-unstyled">
                            <li>● Prospectus</li>
                            <li>● Starting Car ad switching off</li>
                            <li>● Use of Car wipers</li>
                            <li>● Use of Hand break</li>
                            <li>● Use of Seatbelt</li>
                            <li>● Car Interior cockpit</li>
                            <li>● Traffic Signs</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 border hover-effect">
                        <h5>Step 2</h5>
                        <ul class="list-unstyled">
                            <li>● The Driving Task</li>
                            <li>● 1st and 2nd gear practice</li>
                            <li>● Steering control</li>
                            <li>● Reverse Gear Practice</li>
                            <li>● Lane control</li>
                            <li>● Lane and line difference</li>
                            <li>● Fear of driving</li>
                        </ul>
                    </div>
                </div>
                <!-- Flexi Container -->
                <div class="col-md-4">
                    <div class="p-3 border hover-effect">
                        <h5>Step 3</h5>
                        <ul class="list-unstyled">
                            <li>● Hourly road practice</li>
                            <li>● Defensive Driving</li>
                            <li>● U-Turning</li>
                            <li>● Round about turning</li>
                            <li>● Traffic signals crossing</li>
                            <li>● Use of Side mirrors</li>
                            <li>● Use of back view Mirrors</li>
                        </ul>
                    </div>
                </div>
                <!-- VIP Container -->
                <div class="col-md-4">
                    <div class="p-3 border hover-effect">
                        <h5>Step 4</h5>
                        <ul class="list-unstyled">
                            <li>● Theory Class</li>
                            <li>● Types of traffic Signs</li>
                            <li>● Traffic Rules</li>
                            <li>● Changing of tyre</li>
                            <li>● Parallel parking</li>
                            <li>● S shape parking</li>
                            <li>● L shape parking</li>
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
                            <li>● Students can take 1 to 2 hours maximum daily or according to their selected package
                                time.</li>
                            <li>● Please arrive 10 mins earlier than your practical training and tests.</li>
                            <li>● Should you wish to stop the classes due to health issues, please inform us 1 hour in
                                advance so your training will be extended accordingly.</li>
                            <li>● In case your instructor is absent, we will arrange a replacement instructor & should
                                we fail to provide another instructor, your training will be extended accordingly.</li>
                            <li>● Should you wish to stop the classes due to health issues, please inform us 48 hours in
                                advance of your scheduled training to avoid absent fees.</li>
                            <li>● Your Learning Permit will be valid for 3 months from the time of issue date (Renewal
                                Charges will be applied as per Learner policy).</li>
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

            <div class="col-md-6 p-0 d-flex justify-content-center align-items-center" style="background-color: black;">
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