@extends('layout.main')

@section('content')
    <style>
        h2 span {
            color: #FF8F1F;
        }
    </style>

    <!-- Banner Section -->
    <section class="banner-two">
        <div class="banner-container">
            <div class="banner-slider owl-theme owl-carousel">
                <!-- Slide Item -->
                <div class="slide-item">
                    <div class="image-layer"
                        style="background-image: url('{{ asset('main/images/main-slider/slider-1.png') }}');"></div>
                    {{-- <div class="curve-layer"
                        style="background-image: url('{{ asset('main/images/main-slider/banner-curve-1.png') }}');"></div> --}}
                    <div class="auto-container">
                        <div class="content-box">
                            {{-- <div class="image-box">
                                <div class="icon icon-1"><img src="{{ asset('main/images/main-slider/banner-icon-2.svg') }}"
                                        alt="" title=""></div>
                                <div class="icon icon-2"><img src="{{ asset('main/images/main-slider/banner-icon-3.svg') }}"
                                        alt="" title=""></div>
                                <div class="content">
                                    <div class="links-box clearfix">
                                        <div class="link"><a href="{{ route('public.admission.form') }}"
                                                class="theme-btn btn-style-one"><span>Book Now</span></a></div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <div class="slide-item">
                    <div class="image-layer"
                        style="background-image: url('{{ asset('main/images/main-slider/slider-2.jpg') }}');"></div>
                    {{-- <div class="curve-layer"
                        style="background-image: url('{{ asset('main/images/main-slider/banner-curve-1.png') }}');"></div> --}}
                    <div class="auto-container">
                        <div class="content-box">
                            {{-- <div class="image-box">
                                <div class="icon icon-1"><img src="{{ asset('main/images/main-slider/banner-icon-2.svg') }}"
                                        alt="" title=""></div>
                                <div class="icon icon-2"><img src="{{ asset('main/images/main-slider/banner-icon-3.svg') }}"
                                        alt="" title=""></div>
                                <div class="content">
                                    <div class="links-box clearfix">
                                        <div class="link"><a href="{{ route('public.admission.form') }}"
                                                class="theme-btn btn-style-one"><span>Book Now</span></a></div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- End Banner Section -->

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
                {{-- <h2><span><br></span></h2> --}}
                <div class="link">
                    <h3 href="#" class="theme-btn btn-style-one"><span>Courses We Offers</span></h3>
                </div>
            </div>
            <div class="row clearfix" style="display: flex; justify-content: center; align-items: center;">
                <!-- Block -->
                <div class="program-block-two col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1500ms"
                    data-wow-delay="0ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <div class="image"><a href="{{ route('public.courses.mehranCourse') }}"><img
                                        src="{{ asset('main/images/car-thumbs/mehran.png') }}" alt=""
                                        title=""></a>
                            </div>
                            <div class="icon-box"><img src="{{ asset('main/images/resource/steering-icon.svg') }}"
                                    alt="" title=""></div>
                        </div>
                        <div class="mid-box">
                            <h4><a href="{{ route('public.courses.mehranCourse') }}">Suzuki Mehran</a></h4>
                        </div>
                        <div class="link-box"><a href="{{ route('public.courses.mehranCourse') }}">JOIN NOW<i
                                    class="fa-light fa-angle-right"></i></a></div>
                    </div>
                </div>

                <!-- Block -->
                <div class="program-block-two col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1500ms"
                    data-wow-delay="300ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <div class="image"><a href="{{ route('public.courses.altoCourse') }}"><img
                                        src="{{ asset('main/images/car-thumbs/alto.png') }}" alt=""
                                        title=""></a>
                            </div>
                            <div class="icon-box"><img src="{{ asset('main/images/resource/steering-icon.svg') }}"
                                    alt="" title=""></div>
                        </div>
                        <div class="mid-box">
                            <h4><a href="{{ route('public.courses.altoCourse') }}">Suzuki Alto (Manual)</a></h4>
                        </div>
                        <div class="link-box"><a href="{{ route('public.courses.altoCourse') }}">JOIN NOW <i
                                    class="fa-light fa-angle-right"></i></a></div>
                    </div>
                </div>

                <!-- Block -->
                <div class="program-block-two col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1500ms"
                    data-wow-delay="600ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <div class="image"><a href="{{ route('public.courses.vitzCourse') }}"><img
                                        src="{{ asset('main/images/car-thumbs/vitz.png') }}" alt=""
                                        title=""></a>
                            </div>
                            <div class="icon-box"><img src="{{ asset('main/images/resource/steering-icon.svg') }}"
                                    alt="" title=""></div>
                        </div>
                        <div class="mid-box">
                            <h4><a href="{{ route('public.courses.vitzCourse') }}">Toyota Vitz (Automatic)</a></h4>
                        </div>
                        <div class="link-box"><a href="{{ route('public.courses.vitzCourse') }}">JOIN NOW <i
                                    class="fa-light fa-angle-right"></i></a></div>
                    </div>
                </div>


                <div class="program-block-two col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1500ms"
                    data-wow-delay="600ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <div class="image"><a href="{{ route('public.courses.hondaCourse') }}"><img
                                        src="{{ asset('main/images/car-thumbs/honda.png') }}" alt=""
                                        title=""></a>
                            </div>
                            <div class="icon-box"><img src="{{ asset('main/images/resource/steering-icon.svg') }}"
                                    alt="" title=""></div>
                        </div>
                        <div class="mid-box">
                            <h4><a href="{{ route('public.courses.hondaCourse') }}">Honda City (Automatic)</a></h4>
                        </div>
                        <div class="link-box"><a href="{{ route('public.courses.hondaCourse') }}">JOIN NOW <i
                                    class="fa-light fa-angle-right"></i></a></div>
                    </div>
                </div>

                <div class="program-block-two col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp"
                    data-wow-duration="1500ms" data-wow-delay="600ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <div class="image"><a href="{{ route('public.courses.cd70') }}"><img
                                        src="{{ asset('main/images/car-thumbs/bike.png') }}" alt=""
                                        title=""></a>
                            </div>
                            <div class="icon-box"><img src="{{ asset('main/images/resource/steering-icon.svg') }}"
                                    alt="" title=""></div>
                        </div>
                        <div class="mid-box">
                            <h4><a href="'{{ route('public.courses.cd70') }}'">Bike (CD-70)</a></h4>
                        </div>
                        <div class="link-box"><a href="{{ route('public.courses.cd70') }}">JOIN NOW <i
                                    class="fa-light fa-angle-right"></i></a></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!--Welcome Section-->
    <section class="welcome-two">
        {{-- <div class="right-image"><img src="{{ asset('main/images/resource/welcome-2.webp') }}" alt=""
                    title=""></div> --}}
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
                            <div class="link"><a href="{{ route('public.about') }}"
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
                            <div class="w-box d-lg-block d-none">
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

    <!-- Why Us Section -->
    <section class="why-us-two">
        <div class="auto-container">
            <div class="title-box centered style-two">
                <div class="dots"><img src="{{ asset('main/images/resource/title-pattern-2.svg') }}" alt="">
                </div>
                {{-- <h2><span>Our <br>Facilities</span></h2> --}}
                <div class="link">
                    <h3 href="#" class="theme-btn btn-style-one"><span>Our Facilities</span></h3>
                </div>
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
                                <div class="image"><img src="{{ asset('user.jpeg') }}" alt="" title="">
                                </div>
                                <i class="quotes fa fa-quote-right"></i>
                            </div>
                            <div class="text-content">
                                <div class="text">"I have had a great experience at King Driving School. My instructor,
                                    Mrs. Sajida, is honestly a very good teacher with a lot of patience. She has never
                                    shouted or shown any attitude. Thanks to her, I passed my exam on the first attempt and
                                    truly enjoyed the entire learning experience."</div>
                            </div>
                            <div class="info">
                                <span class="name">Anooshay Abbasi</span>
                            </div>
                        </div>
                    </div>
                    <!--Block-->
                    <div class="testi-block">
                        <div class="inner-box">
                            <div class="image-box">
                                <div class="image"><img src="{{ asset('user.jpeg') }}" alt="" title="">
                                </div>
                                <i class="quotes fa fa-quote-right"></i>
                            </div>
                            <div class="text-content">
                                <div class="text">"I had the pleasure of learning driving from Miss Seema. She is
                                    incredibly patient and professional. Her dedication is extremely appreciable, and I can
                                    safely say she has instilled confidence in me to become a great driver. I highly
                                    recommend her for a calm and smooth learning experience."</div>
                            </div>
                            <div class="info">
                                <span class="name">Soha Jehangir</span>
                            </div>
                        </div>
                    </div>
                    <!--Block-->
                    <div class="testi-block">
                        <div class="inner-box">
                            <div class="image-box">
                                <div class="image"><img src="{{ asset('user.jpeg') }}" alt="" title="">
                                </div>
                                <i class="quotes fa fa-quote-right"></i>
                            </div>
                            <div class="text-content">
                                <div class="text">"I took a five-day driving lesson course with Ma’am Sadaf. I had never
                                    driven before, but thanks to her, I gained a lot of confidence in my driving. She made
                                    sure I was calm throughout my lessons and consistently checked up on me. I am very
                                    grateful for this opportunity."</div>
                            </div>
                            <div class="info">
                                <span class="name">Hana Lee</span>
                            </div>
                        </div>
                    </div>
                    <!--Block-->
                    <div class="testi-block">
                        <div class="inner-box">
                            <div class="image-box">
                                <div class="image"><img src="{{ asset('user.jpeg') }}" alt="" title="">
                                </div>
                                <i class="quotes fa fa-quote-right"></i>
                            </div>
                            <div class="text-content">
                                <div class="text">"I had a great experience learning to drive with Mam Seema. She is very
                                    nice, humble, and professional. Her teaching style is encouraging and clear, making me a
                                    more confident driver. I highly recommend her as an instructor."</div>
                            </div>
                            <div class="info">
                                <span class="name">Nida Sadiq</span>
                            </div>
                        </div>
                    </div>
                    <!--Block-->
                    <div class="testi-block">
                        <div class="inner-box">
                            <div class="image-box">
                                <div class="image"><img src="{{ asset('user.jpeg') }}" alt="" title="">
                                </div>
                                <i class="quotes fa fa-quote-right"></i>
                            </div>
                            <div class="text-content">
                                <div class="text">"I have taken admission in King Driving School and had a very great
                                    experience! My instructor, Mam Sadaf, guided me very well and helped build my
                                    confidence. She made me feel comfortable, and her friendly nature made the learning
                                    process enjoyable. I highly recommend her!"</div>
                            </div>
                            <div class="info">
                                <span class="name">A.Ayesha Vlogs</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--About Section-->
    <section class="about-one bg-light">
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
                            <div class= "image-block col-lg-6 col-d-6 col-sm-6">
                                <div class="inner-box bg-white">
                                    <h3>230,800</h3>
                                    <h5><a href="#">Trained Student</a></h5>
                                </div>
                            </div>
                            <div class="image-block col-lg-6 col-d-6 col-sm-6">
                                <div class="bg-white inner-box">
                                    <h3>650+</h3>
                                    <h5><a href="#">Positive Feedback</a></h5>
                                </div>
                            </div>
                            <div class="image-block col-lg-6 col-d-6 col-sm-6">
                                <div class="bg-white inner-box">
                                    <h3>20+</h3>
                                    <h5><a href="#">Staff</a></h5>
                                </div>
                            </div>
                            <div class="image-block col-lg-6 col-d-6 col-sm-6">
                                <div class="bg-white inner-box">
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
    {{-- <section class="news-section">
        <div class="container">
            <div class="news-box">
                <div class="row clearfix">
                    <!--News Block-->
                    <div class="news-block col-xl-4 col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-box wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="0ms">
                            <div class="image-box">
                                <div class="image"><a href="{{ route('public.blog.common-traffic') }}"><img
                                            src="{{ asset('main/images/resource/new-1.png') }}" alt=""
                                            title=""></a></div>
                            </div>
                            <div class="lower-box">
                                <div class="info">king driving / September 23, 2024</div>
                                <h4><a href="{{ route('public.blog.common-traffic') }}">Understanding Common Traffic Signs
                                        and Their Meanings | A Comprehensive Guide</a></h4>
                                <div class="link-box"><a href="{{ route('public.blog.common-traffic') }}"
                                        class="theme-btn">More Details <span
                                            class="icon far fa-long-arrow-right"></span></a></div>
                            </div>
                        </div>
                    </div>
                    <!--News Block-->
                    <div class="news-block col-xl-4 col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-box wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="300ms">
                            <div class="image-box">
                                <div class="image"><a href="{{ route('public.blog.driving-test') }}"><img
                                            src="{{ asset('main/images/resource/new-2.webp') }}" alt=""
                                            title=""></a></div>
                            </div>
                            <div class="lower-box">
                                <div class="info">king driving / September 23, 2024</div>
                                <h4><a href="{{ route('public.blog.driving-test') }}">How to Prepare for Your Driving Test
                                        |
                                        Expert Tips from King Driving School</a></h4>
                                <div class="link-box"><a href="{{ route('public.blog.driving-test') }}"
                                        class="theme-btn">More Details <span
                                            class="icon far fa-long-arrow-right"></span></a></div>
                            </div>
                        </div>
                    </div>
                    <!--News Block-->
                    <div class="news-block col-xl-4 col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-box wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="600ms">
                            <div class="image-box">
                                <div class="image"><a href="{{ route('public.blog.tips-for-beginner') }}"><img
                                            src="{{ asset('main/images/resource/new-3.webp') }}" alt=""
                                            title=""></a></div>
                            </div>
                            <div class="lower-box">
                                <div class="info">king driving / September 23, 2024</div>
                                <h4><a href="{{ route('public.blog.tips-for-beginner') }}">Top Tips for Beginner Drivers |
                                        King Driving School Islamabad</a></h4>
                                <div class="link-box"><a href="{{ route('public.blog.tips-for-beginner') }}"
                                        class="theme-btn">More Details <span
                                            class="icon far fa-long-arrow-right"></span></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection
