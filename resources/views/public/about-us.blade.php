@extends('layout.app')

@section('title', 'About Us')
@section('breadcrumb', 'About Us')

@section('content')

    <section class="welcome-three">
        <div class="auto-container">
            <div class="row clearfix">
                <!--Text Col-->
                <div class="text-col col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="inner wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="0ms">
                        <div class="title-box style-two">
                            <div class="subtitle"><span>OUR INTRODUCTION</span></div>
                            <h2><span>King Driving School</span></h2>
                        </div>
                        <div class="text-content">
                            <div class="text">King Driving School was founded in 1996. The main idea was to create a
                                platform for those who want to learn driving with proper rules and regulations. King Driving
                                School is approved by Islamabad Traffic Police. Thousands of students have learned the skill
                                of driving from King Driving School Islamabad. We have highly skilled male and female
                                instructors, and we have a proper workshop where we teach students about car parts, along
                                with a classroom where students learn traffic signs.</div>
                        </div>
                    </div>
                </div>
                <!--Image Col-->
                <div class="image-col col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="inner wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="0ms">
                        <div class="pattern"><img src="{{ asset('public/images/resource/wel-pattern.png') }}" alt=""
                                title=""></div>
                        <div class="images clearfix">
                            <div class="image"><img src="{{ asset('public/images/resource/welcome-3.jpg') }}"
                                    alt="" title=""></div>
                            <div class="image-box">
                                <img src="{{ asset('public/images/resource/welcome-4.jpg') }}" alt=""
                                    title="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--FAQs Section-->
    <section class="faqs-section">
        <div class="auto-container">
            <div class="row clearfix">
                <!--Block-->
                <div class="col-block col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="accordion-box clearfix">
                        <!--Block-->
                        <div class="accordion block">
                            <div class="acc-btn">Is Kings Driving School Islamabad registered and licensed?</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">Yes, Kings Driving School Islamabad is a registered and licensed
                                        driving school operating in Islamabad and some areas of Rawalpindi.</div>
                                </div>
                            </div>
                        </div>
                        <!--Block-->
                        <div class="accordion block">
                            <div class="acc-btn">How can I enroll in Kings Driving School Islamabad?</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">Enrolling is easy! You can fill out the enrollment form or give us a
                                        call to schedule your driving lessons.</div>
                                </div>
                            </div>
                        </div>
                        <!--Block-->
                        <div class="accordion block">
                            <div class="acc-btn">Do you provide driving lessons for beginners?</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">Yes, we provide driving lessons for beginners. Our experienced
                                        instructors will guide you through the basics and help you develop the necessary
                                        skills to become a confident driver.</div>
                                </div>
                            </div>
                        </div>
                        <!--Block-->
                        <div class="accordion block">
                            <div class="acc-btn">Are female trainers available for female learners?</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">Yes, we have female trainers specifically available for female
                                        learners who prefer to have a female instructor.</div>
                                </div>
                            </div>
                        </div>
                        <!--Block-->
                        <div class="accordion block">
                            <div class="acc-btn">Do you offer pick and drop facility?</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">Yes, we provide pick and drop facility for our students. Our
                                        instructors can pick you up from your desired location and drop you off after the
                                        driving lesson.</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!--Block-->
                <div class="col-block col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="accordion-box clearfix">
                        <!--Block-->
                        <div class="accordion block">
                            <div class="acc-btn">What types of cars do you use for driving lessons?</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">We have automatic cars available for driving lessons. Our cars are
                                        well-maintained, safe, and equipped with dual controls for the instructor’s
                                        assistance..</div>
                                </div>
                            </div>
                        </div>
                        <!--Block-->
                        <div class="accordion block">
                            <div class="acc-btn">How many driving lessons will I need to pass the driving test?</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">The number of lessons required varies for each individual depending
                                        on their previous driving experience and learning pace. Our instructors will assess
                                        your progress and guide you accordingly.</div>
                                </div>
                            </div>
                        </div>
                        <!--Block-->
                        <div class="accordion block">
                            <div class="acc-btn">Do you provide assistance for the driving license test?</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">Yes, our instructors will provide guidance and assistance to help
                                        you prepare for the driving license test. They will cover all the necessary skills
                                        and knowledge required to pass the test successfully.</div>
                                </div>
                            </div>
                        </div>
                        <!--Block-->
                        <div class="accordion block">
                            <div class="acc-btn">Is there an age limit for enrolling in driving lessons?</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">The legal driving age in Pakistan is 18 years. Therefore, we accept
                                        students who are 18 years or older for our driving lessons.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!--Testimonials Section-->
    <section class="testimonial-three">
        <div class="auto-container">
            <div class="title-box centered style-two">
                <div class="subtitle"><span>TESTIMONIALS</span></div>
                <h2><span>Check Our Clients <br>Feedback</span></h2>
            </div>
            <div class="carousel-box">
                <div class="testi-carousel-three owl-theme owl-carousel">
                    <!--Block-->
                    <div class="testi-block">
                        <div class="inner-box">
                            <div class="image-box">
                                <div class="image"><img src="{{ asset('public/images/resource/testi-7.png') }}"
                                        alt="" title=""></div>
                            </div>
                            <div class="text-content">
                                <div class="text">"I had an amazing experience learning to drive at this school. The
                                    instructors were very supportive, and I felt confident by the time I took my test!"
                                </div>
                            </div>
                            <div class="info">
                                <span class="name">Ayesha Khan</span>
                                <span class="designation">Student</span>
                            </div>
                        </div>
                    </div>
                    <!--Block-->
                    <div class="testi-block">
                        <div class="inner-box">
                            <div class="image-box">
                                <div class="image"><img src="{{ asset('public/images/resource/testi-8.png') }}"
                                        alt="" title=""></div>
                            </div>
                            <div class="text-content">
                                <div class="text">"The training I received was top-notch. I learned everything from basic
                                    driving skills to defensive driving techniques!"</div>
                            </div>
                            <div class="info">
                                <span class="name">Bilal Ahmed</span>
                                <span class="designation">Head Of Marketing</span>
                            </div>
                        </div>
                    </div>
                    <!--Block-->
                    <div class="testi-block">
                        <div class="inner-box">
                            <div class="image-box">
                                <div class="image"><img src="{{ asset('public/images/resource/testi-9.png') }}"
                                        alt="" title=""></div>
                            </div>
                            <div class="text-content">
                                <div class="text">"I highly recommend this driving school! The instructors are very
                                    knowledgeable and made me feel at ease while driving."</div>
                            </div>
                            <div class="info">
                                <span class="name">Fatima Noor</span>
                                <span class="designation">Business Owner</span>
                            </div>
                        </div>
                    </div>
                    <!--Block-->
                    <div class="testi-block">
                        <div class="inner-box">
                            <div class="image-box">
                                <div class="image"><img src="{{ asset('public/images/resource/testi-7.png') }}"
                                        alt="" title=""></div>
                            </div>
                            <div class="text-content">
                                <div class="text">"The driving lessons were very structured and informative. I learned so
                                    much and passed my test with ease!"</div>
                            </div>
                            <div class="info">
                                <span class="name">Hassan Raza</span>
                                <span class="designation">Software Engineer</span>
                            </div>
                        </div>
                    </div>
                    <!--Block-->
                    <div class="testi-block">
                        <div class="inner-box">
                            <div class="image-box">
                                <div class="image"><img src="{{ asset('public/images/resource/testi-8.png') }}"
                                        alt="" title=""></div>
                            </div>
                            <div class="text-content">
                                <div class="text">"I enjoyed every moment of my training. The instructors were patient
                                    and tailored lessons to my needs!"</div>
                            </div>
                            <div class="info">
                                <span class="name">Zainab Iqbal</span>
                                <span class="designation">Graphic Designer</span>
                            </div>
                        </div>
                    </div>
                    <!--Block-->
                    <div class="testi-block">
                        <div class="inner-box">
                            <div class="image-box">
                                <div class="image"><img src="{{ asset('public/images/resource/testi-9.png') }}"
                                        alt="" title=""></div>
                            </div>
                            <div class="text-content">
                                <div class="text">"This driving school exceeded my expectations! I feel prepared and
                                    confident on the road now!"</div>
                            </div>
                            <div class="info">
                                <span class="name">Omar Malik</span>
                                <span class="designation">University Student</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
