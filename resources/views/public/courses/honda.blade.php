@extends('layout.app')

@section('content')
    <!--Course Details Section-->
    <section class="course-details">
        <div class="auto-container">
            <div class="content-box">
                <div class="image big-image">
                    <img src="{{ asset('public/images/resource/image-15.jpg') }}" alt="Highway Driving Training"
                        title="Highway Driving Training">
                </div>
                <h2>Honda</h2>
                <ul>
                    <li>Monday to Saturday: 8:00 am - 8:00 pm for gents & 9:00 am - 6:00 pm for ladies</li>
                    <li>Students can take 1 to 2 hours maximum daily or according to their selected package time.</li>
                    <li>If you wish to stop the classes due to health issues, please inform us 1 hour in advance so your
                        training will be extended accordingly.</li>
                    <li>In case your instructor is absent, we will arrange a replacement instructor. If we fail to provide
                        another instructor, your training will be extended accordingly.</li>
                </ul>

                <div class="row clearfix mt-5">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <h3>STEP 1</h3>
                        <ul>
                            <li>Prospectus</li>
                            <li>Starting Car and Switching Off</li>
                            <li>Use of Car Wipers</li>
                            <li>Use of Hand Brake</li>
                            <li>Use of Seatbelt</li>
                            <li>Car Interior Cockpit</li>
                            <li>Traffic Signs</li>
                            <li>Driver's Responsibilities</li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <h3>STEP 2</h3>
                        <ul>
                            <li>The Driving Task</li>
                            <li>1st and 2nd Gear Practice</li>
                            <li>Steering Control</li>
                            <li>Reverse Gear Practice</li>
                            <li>Lane Control</li>
                            <li>Lane and Line Difference</li>
                            <li>Fear of Driving</li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <h3>STEP 3</h3>
                        <ul>
                            <li>Hourly Road Practice</li>
                            <li>Defensive Driving</li>
                            <li>U-Turning</li>
                            <li>Round About Turning</li>
                            <li>Traffic Signals Crossing</li>
                            <li>Use of Side Mirrors</li>
                            <li>Use of Back View Mirrors</li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <h3>STEP 4</h3>
                        <ul>
                            <li>Theory Class</li>
                            <li>Types of Traffic Signs</li>
                            <li>Traffic Rules</li>
                            <li>Changing of Tyre</li>
                            <li>Parallel Parking</li>
                            <li>S shape Parking</li>
                            <li>L shape Parking</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="content-box">
                <h2>Importnat Instruction</h2>
                <ul>
                    <li>One Theory Class is Compulsory.</li>
                    <li>Pick & drop charges Will be according to location.</li>
                    <li>Change Of Driving Route Will Be Charged Separately 10,000/-</li>
                    <li>Air conditioned facility available in car 5000/-</li>
                    <li>Individual training classes fee 10,000/-</li>
                </ul>
            </div>
            <h2>Pricing</h2>
            <!--Pricing Section-->
            <div class="auto-container">
                <div class="row clearfix">
                    <!--Block-->
                    <div class="pricing-block col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1500ms"
                        data-wow-delay="0ms">
                        <div class="inner-box">
                            <div class="upper-box">
                                <div class="plan-title">10 Days</div>
                                <div class="price">20,000/-</div>
                                <div class="duration">30 Mins</div>
                            </div>
                            <div class="lower-box">
                                <div class="features">
                                    <ul>
                                        <li>Automatic</li>
                                        <li>09 Days practical driving</li>
                                        <li>30 Minutes Daily</li>
                                        <li>01 Theory class</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Block-->
                    <div class="pricing-block col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1500ms"
                        data-wow-delay="300ms">
                        <div class="inner-box">
                            <div class="upper-box">
                                <div class="plan-title">10 Days</div>
                                <div class="price">30,000/-</div>
                                <div class="duration">60 Mins</div>
                            </div>
                            <div class="lower-box">
                                <div class="features">
                                    <ul>
                                        <li>Automatic</li>
                                        <li>09 Days practical driving</li>
                                        <li>60 Minutes Daily</li>
                                        <li>01 Theory class</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Block-->
                    <div class="pricing-block col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1500ms"
                        data-wow-delay="600ms">
                        <div class="inner-box">
                            <div class="upper-box">
                                <div class="plan-title">15 Days</div>
                                <div class="price">45,000/-</div>
                                <div class="duration">60 Mins</div>
                            </div>
                            <div class="lower-box">
                                <div class="features">
                                    <ul>
                                        <li>Automatic</li>
                                        <li>14 Days practical driving</li>
                                        <li>60 Minutes Daily</li>
                                        <li>01 Theory class</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
