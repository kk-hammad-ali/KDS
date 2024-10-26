@extends('layout.main')


@section('content')
    <!-- Banner Section -->
    <section class="banner-two">
        <div class="banner-container">
            <div class="banner-slider owl-theme owl-carousel">
                <!-- Slide Item -->
                <div class="slide-item">
                    <div class="image-layer"
                        style="background-image: url('{{ asset('main/images/main-slider/slider-2.jpg') }}');"></div>
                    <div class="curve-layer"
                        style="background-image: url('{{ asset('main/images/main-slider/banner-curve-1.png') }}');"></div>
                    <div class="auto-container">
                        <div class="content-box">
                            <div class="content">
                                <div class="clearfix">
                                    <div class="inner">
                                        <h1><span>King Driving School</span></h1>
                                        <div class="text">High-Quality Driving Schools in Islamabad</div>
                                        <div class="links-box clearfix">
                                            <div class="link"><a href="{{ route('public.quiz') }}"
                                                    class="theme-btn btn-style-one"><span>Theory
                                                        Test</span></a></div>
                                            <div class="link"><a href="{{ route('public.admission.form') }}"
                                                    class="theme-btn btn-style-two"><span>Book
                                                        Now</span></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="image-box">
                                <div class="icon icon-1"><img src="{{ asset('main/images/main-slider/banner-icon-2.svg') }}"
                                        alt="" title=""></div>
                                <div class="icon icon-2"><img src="{{ asset('main/images/main-slider/banner-icon-3.svg') }}"
                                        alt="" title=""></div>
                                <div class="image">
                                    <img src="{{ asset('main/images/main-slider/slider-3.webp') }}" alt=""
                                        title="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide Item -->
                <div class="slide-item">
                    <div class="image-layer"
                        style="background-image: url('{{ asset('main/images/main-slider/slider-2.jpg') }}');"></div>
                    <div class="curve-layer"
                        style="background-image: url('{{ asset('main/images/main-slider/banner-curve-1.png') }}');"></div>
                    <div class="auto-container">
                        <div class="content-box">
                            <div class="content">
                                <div class="clearfix">
                                    <div class="inner">
                                        <h1><span>King Driving School</span></h1>
                                        <div class="text">High-Quality Driving Schools in Islamabad</div>
                                        <div class="links-box clearfix">
                                            <div class="link"><a href="{{ route('public.quiz') }}"
                                                    class="theme-btn btn-style-one"><span>Theory
                                                        Test</span></a></div>
                                            <div class="link"><a href="{{ route('public.admission.form') }}"
                                                    class="theme-btn btn-style-two"><span>Book
                                                        Now</span></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="image-box">
                                <div class="icon icon-1"><img
                                        src="{{ asset('main/images/main-slider/banner-icon-2.svg') }}" alt=""
                                        title=""></div>
                                <div class="icon icon-2"><img
                                        src="{{ asset('main/images/main-slider/banner-icon-3.svg') }}" alt=""
                                        title=""></div>
                                <div class="image">
                                    <img src="{{ asset('main/images/main-slider/slider-3.webp') }}" alt=""
                                        title="">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide Item -->
                <div class="slide-item">
                    <div class="image-layer"
                        style="background-image: url('{{ asset('main/images/main-slider/slider-2.jpg') }}');"></div>
                    <div class="curve-layer"
                        style="background-image: url('{{ asset('main/images/main-slider/banner-curve-1.png') }}');">
                    </div>
                    <div class="auto-container">
                        <div class="content-box">
                            <div class="content">
                                <div class="clearfix">
                                    <div class="inner">
                                        <h1><span>King Driving School</span></h1>
                                        <div class="text">High-Quality Driving Schools in Islamabad</div>
                                        <div class="links-box clearfix">
                                            <div class="link"><a href="{{ route('public.quiz') }}"
                                                    class="theme-btn btn-style-one"><span>Theory
                                                        Test</span></a></div>
                                            <div class="link"><a href="{{ route('public.admission.form') }}"
                                                    class="theme-btn btn-style-two"><span>Book
                                                        Now</span></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="image-box">
                                <div class="icon icon-1"><img
                                        src="{{ asset('main/images/main-slider/banner-icon-2.svg') }}" alt=""
                                        title=""></div>
                                <div class="icon icon-2"><img
                                        src="{{ asset('main/images/main-slider/banner-icon-3.svg') }}" alt=""
                                        title=""></div>
                                <div class="image">
                                    <img src="{{ asset('main/images/main-slider/slider-3.webp') }}" alt=""
                                        title="">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Section -->


    <!--Welcome Section-->
    <section class="welcome-two">
        <div class="right-image"><img src="{{ asset('main/images/resource/welcome-2.webp') }}" alt=""
                title=""></div>
        <div class="auto-container">
            <div class="row clearfix">
                <!-- Text Col -->
                <div class="text-col col-xl-6 col-lg-12 col-md-12 col-sm-12">
                    <div class="inner wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="0ms">
                        <div class="title-box style-two">
                            <div class="dots"><img src="{{ asset('main/images/resource/title-pattern-2.svg') }}"
                                    alt=""></div>
                            <h2><span>Welcome To King <br>Driving School</span></h2>
                        </div>
                        <div class="row clearfix">
                            <!-- Block -->
                            <div class="wel-block-two col-lg-6 col-md-6 col-sm-12">
                                <div class="inner-box">
                                    <div class="icon"><i class="fa-light fa-long-arrow-right"></i></div>
                                    <h6>Driving Training</h6>
                                    <div class="text">We train on-road, parking, roundabout, U-turns, sharp turns, and
                                        defensive driving techniques to our students.
                                    </div>
                                </div>
                            </div>
                            <!-- Block -->
                            <div class="wel-block-two col-lg-6 col-md-6 col-sm-12">
                                <div class="inner-box">
                                    <div class="icon"><i class="fa-light fa-long-arrow-right"></i></div>
                                    <h6>Theory Classes</h6>
                                    <div class="text">Driving theory lectures to familiarize the trainers with cockpit
                                        drill, basic driving skills, road signs, road safety, and road sense.
                                    </div>
                                </div>
                            </div>
                            <!-- Block -->
                            <div class="wel-block-two col-lg-6 col-md-6 col-sm-12">
                                <div class="inner-box">
                                    <div class="icon"><i class="fa-light fa-long-arrow-right"></i></div>
                                    <h6>Hallmark Training</h6>
                                    <div class="text">Excellence in S-shape, L-shape, ?-shape, and parallel parking as
                                        required by the Driving Licenses Authority (DLA).
                                    </div>
                                </div>
                            </div>
                            <!-- Block -->
                            <div class="wel-block-two col-lg-6 col-md-6 col-sm-12">
                                <div class="inner-box">
                                    <div class="icon"><i class="fa-light fa-long-arrow-right"></i></div>
                                    <h6>Pick & Drop</h6>
                                    <div class="text">We can also provide pick and drop service to students who need it.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="lower-links clearfix">
                            <div class="link"><a href="{{ route('public.courses') }}"
                                    class="theme-btn btn-style-one"><span>DISCOVER
                                        MORE</span></a></div>
                        </div>
                    </div>
                </div>
                <!-- Image Col -->
                <div class="image-col col-xl-6 col-lg-12 col-md-12 col-sm-12">
                    <div class="inner wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="0ms">
                        <div class="images">
                            <div class="image"><img src="{{ asset('main/images/resource/welcome-1.jpg') }}"
                                    alt="" title=""></div>
                            <div class="w-box">
                                <div class="inner-box">
                                    <div class="icon-box"><span class="fal fa-shield-check"></span></div>
                                    <div class="text">We will give you a safe drive from all threats.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <!--Video Lesson Class-->
    <section class="video-lessons">
        <div class="image-layer" style="background-image: url(images/background/bg-image-2.jpg);"></div>
        <div class="auto-container">
            <div class="title">
                <h2>Give us a call when you want <br>to schedule driving <br>lessons</h2>
            </div>
            <div class="video-link"><a href="https://youtube.com/shorts/m9zSjT4K1Rw?si=osVjEY4SP-NQzzG8"
                    class="theme-btn lightbox-image vid-btn"><span class="icon fa fa-play"></span></a></div>
        </div>
        </div>
    </section> --}}

    <!-- Programs Section -->
    <section class="programs-two">
        <div class="auto-container">
            <div class="title-box centered style-two">
                <div class="dots"><img src="{{ asset('main/images/resource/title-pattern-2.svg') }}" alt="">
                </div>
                <h2><span>Check Our Latest <br>Courses</span></h2>
            </div>
            <div class="row clearfix">
                <!-- Block -->
                <div class="program-block-two col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp"
                    data-wow-duration="1500ms" data-wow-delay="0ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <div class="image"><a href="{{ route('public.courses.mehranCourse') }}"><img
                                        src="{{ asset('main/images/resource/image-11.webp') }}" alt=""
                                        title=""></a>
                            </div>
                            <div class="icon-box"><img src="{{ asset('main/images/resource/steering-icon.svg') }}"
                                    alt="" title=""></div>
                        </div>
                        <div class="mid-box">
                            <h4><a href="{{ route('public.courses.mehranCourse') }}">Suzuki Mehran</a></h4>
                        </div>
                        <div class="link-box"><a href="{{ route('public.courses.mehranCourse') }}">READ MORE <i
                                    class="fa-light fa-angle-right"></i></a></div>
                    </div>
                </div>

                <!-- Block -->
                <div class="program-block-two col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp"
                    data-wow-duration="1500ms" data-wow-delay="300ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <div class="image"><a href="{{ route('public.courses.altoCourse') }}"><img
                                        src="{{ asset('main/images/resource/image-12.webp') }}" alt=""
                                        title=""></a>
                            </div>
                            <div class="icon-box"><img src="{{ asset('main/images/resource/steering-icon.svg') }}"
                                    alt="" title=""></div>
                        </div>
                        <div class="mid-box">
                            <h4><a href="{{ route('public.courses.altoCourse') }}">Suzuki Alto (Manual)</a></h4>
                        </div>
                        <div class="link-box"><a href="{{ route('public.courses.altoCourse') }}">READ MORE <i
                                    class="fa-light fa-angle-right"></i></a></div>
                    </div>
                </div>

                <!-- Block -->
                <div class="program-block-two col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp"
                    data-wow-duration="1500ms" data-wow-delay="600ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <div class="image"><a href="{{ route('public.courses.vitzCourse') }}"><img
                                        src="{{ asset('main/images/resource/image-13.webp') }}" alt=""
                                        title=""></a>
                            </div>
                            <div class="icon-box"><img src="{{ asset('main/images/resource/steering-icon.svg') }}"
                                    alt="" title=""></div>
                        </div>
                        <div class="mid-box">
                            <h4><a href="{{ route('public.courses.vitzCourse') }}">Toyota Vitz (Automatic)</a></h4>
                        </div>
                        <div class="link-box"><a href="{{ route('public.courses.vitzCourse') }}">READ MORE <i
                                    class="fa-light fa-angle-right"></i></a></div>
                    </div>
                </div>

                <div class="program-block-two col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp"
                    data-wow-duration="1500ms" data-wow-delay="600ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <div class="image"><a href="{{ route('public.courses.miraCourse') }}"><img
                                        src="{{ asset('main/images/resource/image-14.jpg') }}" alt=""
                                        title=""></a>
                            </div>
                            <div class="icon-box"><img src="{{ asset('main/images/resource/steering-icon.svg') }}"
                                    alt="" title=""></div>
                        </div>
                        <div class="mid-box">
                            <h4><a href="{{ route('public.courses.miraCourse') }}">Daihatsu Mira (Automatic)</a></h4>
                        </div>
                        <div class="link-box"><a href="{{ route('public.courses.miraCourse') }}">READ MORE <i
                                    class="fa-light fa-angle-right"></i></a></div>
                    </div>
                </div>

                <div class="program-block-two col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp"
                    data-wow-duration="1500ms" data-wow-delay="600ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <div class="image"><a href="{{ route('public.courses.hondaCourse') }}"><img
                                        src="{{ asset('main/images/resource/image-15.jpg') }}" alt=""
                                        title=""></a>
                            </div>
                            <div class="icon-box"><img src="{{ asset('main/images/resource/steering-icon.svg') }}"
                                    alt="" title=""></div>
                        </div>
                        <div class="mid-box">
                            <h4><a href="{{ route('public.courses.hondaCourse') }}">Honda City (Automatic)</a></h4>
                        </div>
                        <div class="link-box"><a href="{{ route('public.courses.hondaCourse') }}">READ MORE <i
                                    class="fa-light fa-angle-right"></i></a></div>
                    </div>
                </div>

                <div class="program-block-two col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp"
                    data-wow-duration="1500ms" data-wow-delay="600ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <div class="image"><a href="{{ route('public.courses.cd70') }}"><img
                                        src="{{ asset('main/images/resource/image-16.webp') }}" alt=""
                                        title=""></a>
                            </div>
                            <div class="icon-box"><img src="{{ asset('main/images/resource/steering-icon.svg') }}"
                                    alt="" title=""></div>
                        </div>
                        <div class="mid-box">
                            <h4><a href="'{{ route('public.courses.cd70') }}'">Bike (CD-70)</a></h4>
                        </div>
                        <div class="link-box"><a href="{{ route('public.courses.cd70') }}">READ MORE <i
                                    class="fa-light fa-angle-right"></i></a></div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- Why Us Section -->
    <section class="why-us-two">
        <div class="auto-container">
            <div class="title-box centered style-two">
                <div class="dots"><img src="{{ asset('main/images/resource/title-pattern-2.svg') }}" alt="">
                </div>
                <h2><span>Our <br>Facilities</span></h2>
            </div>
            <div class="row clearfix">
                <!-- Block -->
                <div class="why-block-two col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1500ms"
                    data-wow-delay="0ms">
                    <div class="inner-box">
                        <div class="icon-box"><span class="fal fa-phone-alt"></span></div>
                        <h4>Phone Call</h4>
                        <div class="text">You can also get admission on phone call.</div>
                    </div>
                </div>
                <!-- Block -->
                <div class="why-block-two col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1500ms"
                    data-wow-delay="300ms">
                    <div class="inner-box">
                        <div class="icon-box"><span class="fal fa-female"></span></div>
                        <h4>Female Instructor</h4>
                        <div class="text">We have ladies instructors for ladies.</div>
                    </div>
                </div>
                <!-- Block -->
                <div class="why-block-two col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1500ms"
                    data-wow-delay="600ms">
                    <div class="inner-box">
                        <div class="icon-box"><span class="fal fa-check-circle"></span></div>
                        <h4>License Test</h4>
                        <div class="text">We can also prepare you for license test.</div>
                    </div>
                </div>
                <!-- Block -->
                <div class="why-block-two col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1500ms"
                    data-wow-delay="0ms">
                    <div class="inner-box">
                        <div class="icon-box"><span class="fal fa-car"></span></div>
                        <h4>Automatic Cars</h4>
                        <div class="text">We have all types of manual and automatic cars.</div>
                    </div>
                </div>
                <!-- Block -->
                <div class="why-block-two col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1500ms"
                    data-wow-delay="300ms">
                    <div class="inner-box">
                        <div class="icon-box"><span class="fal fa-book-open"></span></div>
                        <h4>Theory Lecture</h4>
                        <div class="text">KDS also gives theory lectures in which students learn different traffic signs
                            and rules.</div>
                    </div>
                </div>
                <!-- Block -->
                <div class="why-block-two col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1500ms"
                    data-wow-delay="600ms">
                    <div class="inner-box">
                        <div class="icon-box"><span class="fal fa-shield-alt"></span></div>
                        <h4>Defensive Driving</h4>
                        <div class="text">KDS also gives you training in defensive driving.</div>
                    </div>
                </div>
                <!-- Block -->
                <div class="why-block-two col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1500ms"
                    data-wow-delay="600ms">
                    <div class="inner-box">
                        <div class="icon-box"><span class="fal fa-certificate"></span></div>
                        <h4>Certificate Facility</h4>
                        <div class="text">If you need a certificate, King Driving School can provide one on demand.</div>
                    </div>
                </div>
                <!-- Block -->
                <div class="why-block-two col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1500ms"
                    data-wow-delay="600ms">
                    <div class="inner-box">
                        <div class="icon-box"><span class="fal fa-bus"></span></div>
                        <h4>Pick & Drop</h4>
                        <div class="text">We can provide pick and drop services for students who need them.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Testimonials Section-->
    <section class="testimonial-two">
        <div class="auto-container">
            <div class="title-box centered style-two">
                <div class="dots"><img src="{{ asset('main/images/resource/title-pattern-2.svg') }}" alt="">
                </div>
                <h2><span>Clients Feedback</span></h2>
            </div>
            <div class="carousel-box">
                <div class="testi-carousel-two owl-theme owl-carousel">
                    <!--Block-->
                    <div class="testi-block">
                        <div class="inner-box">
                            <div class="image-box">
                                <div class="image"><img src="{{ asset('main/images/resource/testi-6.png') }}"
                                        alt="" title=""></div>
                                <i class="quotes fa fa-quote-right"></i>
                            </div>
                            <div class="text-content">
                                <div class="text">"My experience with this driving school was excellent! The instructors
                                    were very professional and helped me gain confidence behind the wheel. Highly
                                    recommended!"</div>
                            </div>
                            <div class="info">
                                <span class="name">Aisha Malik</span> <i class="dot"></i> <span
                                    class="designation">Student</span>
                            </div>
                        </div>
                    </div>
                    <!--Block-->
                    <div class="testi-block">
                        <div class="inner-box">
                            <div class="image-box">
                                <div class="image"><img src="{{ asset('main/images/resource/testi-6.png') }}"
                                        alt="" title=""></div>
                                <i class="quotes fa fa-quote-right"></i>
                            </div>
                            <div class="text-content">
                                <div class="text">"I was nervous about learning to drive, but the friendly staff made the
                                    process so easy. Thanks to them, I passed my test on the first try!"</div>
                            </div>
                            <div class="info">
                                <span class="name">Usman Ahmed</span> <i class="dot"></i> <span
                                    class="designation">Software Engineer</span>
                            </div>
                        </div>
                    </div>
                    <!--Block-->
                    <div class="testi-block">
                        <div class="inner-box">
                            <div class="image-box">
                                <div class="image"><img src="{{ asset('main/images/resource/testi-6.png') }}"
                                        alt="" title=""></div>
                                <i class="quotes fa fa-quote-right"></i>
                            </div>
                            <div class="text-content">
                                <div class="text">"The lessons were structured and easy to follow. I learned so much in a
                                    short time. Thank you for helping me become a safe driver!"</div>
                            </div>
                            <div class="info">
                                <span class="name">Fatima Khan</span> <i class="dot"></i> <span
                                    class="designation">Teacher</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!--About Section-->
    <section class="about-one">
        <div class="auto-container">
            <div class="row clearfix">
                <!--Text Col-->
                <div class="text-col col-xl-7 col-lg-6 col-md-12 col-sm-12">
                    <div class="inner wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="0ms">
                        <div class="title-box style-two">
                            <div class="dots"><img src="{{ asset('main/images/resource/title-pattern-2.svg') }}"
                                    alt="">
                            </div>
                            <h2><span>We’re an Experienced <br>Driving School</span></h2>
                        </div>
                        <div class="text-content">
                            <div class="text">
                                <p>We want to make roads a safer place for drivers, pedestrians, and the general public.
                                    This is an alarming situation for us: every year, more than 12,000 people die in road
                                    accidents. The primary reason behind these accidents is unskilled drivers.</p>
                                <ul>
                                    <li>Proper training is essential for developing safe driving habits.</li>
                                    <li>Understanding traffic rules and regulations reduces the risk of accidents.</li>
                                    <li>Defensive driving techniques can help prevent collisions.</li>
                                    <li>Awareness of road signs is crucial for safe navigation.</li>
                                    <li>Regular practice with skilled instructors builds confidence behind the wheel.</li>
                                </ul>
                            </div>

                        </div>

                        <div class="lower-links clearfix">
                            <div class="link"><a href="{{ route('public.about') }}"
                                    class="theme-btn btn-style-one"><span>DISCOVER
                                        MORE</span></a></div>
                        </div>
                    </div>
                </div>
                <!--Image Col-->
                <div class="image-col col-xl-5 col-lg-6 col-md-12 col-sm-12">
                    <div class="inner wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="0ms">
                        <div class="row clearfix">
                            <div class="image-block col-lg-6 col-d-6 col-sm-6">
                                <div class="inner-box">
                                    <h3>230,800</h3>
                                    <h5><a href="#">Trained Student</a></h5>
                                </div>
                            </div>
                            <div class="image-block col-lg-6 col-d-6 col-sm-6">
                                <div class="inner-box">
                                    <h3>450+</h3>
                                    <h5><a href="#">Positive Feedback</a></h5>
                                </div>
                            </div>
                            <div class="image-block col-lg-6 col-d-6 col-sm-6">
                                <div class="inner-box">
                                    <h3>20+</h3>
                                    <h5><a href="#">Staff</a></h5>
                                </div>
                            </div>
                            <div class="image-block col-lg-6 col-d-6 col-sm-6">
                                <div class="inner-box">
                                    <h5>24+</h5>
                                    <h5><a href="#">Years of Experience</a></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--News Section-->
    <section class="news-section no-padd-top">
        <div class="auto-container">
            <div class="title-box centered style-two">
                <div class="dots"><img src="{{ asset('main/images/resource/title-pattern-2.svg') }}" alt="">
                </div>
                <h2><span>Latest news <br>updates</span></h2>
            </div>
            <div class="news-box">
                <div class="row clearfix">
                    <!--News Block-->
                    <div class="news-block col-xl-4 col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-box wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="0ms">
                            <div class="image-box">
                                <div class="image"><a href="blog-single.html"><img
                                            src="{{ asset('main/images/resource/news-1.jpg') }}" alt=""
                                            title=""></a></div>
                            </div>
                            <div class="lower-box">
                                <div class="info">Personal / June 13, 2022</div>
                                <h4><a href="blog-single.html">How to become a best driver Marketer in a year!</a></h4>
                                <div class="link-box"><a href="blog-single.html" class="theme-btn">More Details
                                        <span class="icon far fa-long-arrow-right"></span></a></div>
                            </div>
                        </div>
                    </div>
                    <!--News Block-->
                    <div class="news-block col-xl-4 col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-box wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="300ms">
                            <div class="image-box">
                                <div class="image"><a href="blog-single.html"><img
                                            src="{{ asset('main/images/resource/news-2.jpg') }}" alt=""
                                            title=""></a></div>
                            </div>
                            <div class="lower-box">
                                <div class="info">Personal / June 13, 2022</div>
                                <h4><a href="blog-single.html">How to become a best driver Marketer in a year!</a></h4>
                                <div class="link-box"><a href="blog-single.html" class="theme-btn">More Details
                                        <span class="icon far fa-long-arrow-right"></span></a></div>
                            </div>
                        </div>
                    </div>
                    <!--News Block-->
                    <div class="news-block col-xl-4 col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-box wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="600ms">
                            <div class="image-box">
                                <div class="image"><a href="blog-single.html"><img
                                            src="{{ asset('main/images/resource/news-3.jpg') }}" alt=""
                                            title=""></a></div>
                            </div>
                            <div class="lower-box">
                                <div class="info">Personal / June 13, 2022</div>
                                <h4><a href="blog-single.html">How to become a best driver Marketer in a year!</a></h4>
                                <div class="link-box"><a href="blog-single.html" class="theme-btn">More Details
                                        <span class="icon far fa-long-arrow-right"></span></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
