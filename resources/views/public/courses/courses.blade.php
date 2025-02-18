@extends('layout.app')

@section('title', 'Courses')
@section('breadcrumb', 'Our Courses')

@section('content')
    <!--Programs Section-->
    <section class="programs-three">
        <div class="auto-container">
            <div class="row justify-content-center">
                <!--Block-->
                <div class="program-block-three col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1500ms"
                    data-wow-delay="0ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <div class="image"><a href="{{ route('public.courses.mehranCourse') }}"><img
                                        src="{{ asset('main/images/car-thumbs/mehran.png') }}" alt="Suzuki Mehran"
                                        title="Suzuki Mehran"></a></div>
                        </div>
                        <div class="lower-box">
                            <h3><a href="{{ route('public.courses.mehranCourse') }}">Suzuki Mehran</a></h3>
                            <div class="text">The Suzuki Mehran is an excellent choice for beginner drivers. Its compact
                                size and simple controls make it easy to navigate city streets. Join our lessons to master
                                driving this reliable vehicle.</div>
                            <div class="link-box"><a href="{{ route('public.courses.mehranCourse') }}"
                                    class="theme-btn btn-style-one semi-round"><span>DETAILS</span></a></div>
                        </div>
                    </div>
                </div>

                <!--Block-->
                <div class="program-block-three col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp"
                    data-wow-duration="1500ms" data-wow-delay="300ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <div class="image"><a href="{{ route('public.courses.altoCourse') }}"><img
                                        src="{{ asset('main/images/car-thumbs/alto.png') }}" alt="Suzuki Alto"
                                        title="Suzuki Alto"></a></div>
                        </div>
                        <div class="lower-box">
                            <h3><a href="{{ route('public.courses.altoCourse') }}">Suzuki Alto</a></h3>
                            <div class="text">The Suzuki Alto is a perfect car for urban driving. With its fuel efficiency
                                and small turning radius, you'll learn how to handle tight spaces with confidence. Start
                                your journey with us!</div>
                            <div class="link-box"><a href="{{ route('public.courses.altoCourse') }}"
                                    class="theme-btn btn-style-one semi-round"><span>DETAILS</span></a></div>
                        </div>
                    </div>
                </div>

                <!--Block-->
                <div class="program-block-three col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp"
                    data-wow-duration="1500ms" data-wow-delay="600ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <div class="image"><a href="{{ route('public.courses.vitzCourse') }}"><img
                                        src="{{ asset('main/images/car-thumbs/vitz.png') }}" alt="Toyota Vitz (Automatic)"
                                        title="Toyota Vitz (Automatic)"></a></div>
                        </div>
                        <div class="lower-box">
                            <h3><a href="{{ route('public.courses.vitzCourse') }}">Toyota Vitz (Automatic)</a></h3>
                            <div class="text">The Toyota Vitz offers a smooth and automatic driving experience, ideal for
                                those new to driving. Our lessons will help you become familiar with its features and enjoy
                                a stress-free ride.</div>
                            <div class="link-box"><a href="{{ route('public.courses.vitzCourse') }}"
                                    class="theme-btn btn-style-one semi-round"><span>DETAILS</span></a></div>
                        </div>
                    </div>
                </div>

                <!--Block-->
                <div class="program-block-three col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp"
                    data-wow-duration="1500ms" data-wow-delay="600ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <div class="image"><a href="{{ route('public.courses.hondaCourse') }}"><img
                                        src="{{ asset('main/images/car-thumbs/honda.png') }}" alt="Honda City"
                                        title="Honda City"></a></div>
                        </div>
                        <div class="lower-box">
                            <h3><a href="{{ route('public.courses.hondaCourse') }}">Honda City</a></h3>
                            <div class="text">The Honda City is a spacious and comfortable vehicle, perfect for family
                                driving. Our experienced instructors will guide you through the nuances of driving this
                                sedan with confidence.</div>
                            <div class="link-box"><a href="{{ route('public.courses.hondaCourse') }}"
                                    class="theme-btn btn-style-one semi-round"><span>DETAILS</span></a></div>
                        </div>
                    </div>
                </div>

                <!--Block-->
                <div class="program-block-three col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp"
                    data-wow-duration="1500ms" data-wow-delay="600ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <div class="image"><a href="{{ route('public.courses.cd70') }}"><img
                                        src="{{ asset('main/images/car-thumbs/bike.png') }}" alt="CD70 Bike"
                                        title="CD70 Bike"></a></div>
                        </div>
                        <div class="lower-box">
                            <h3><a href="{{ route('public.courses.cd70') }}l">CD70 (Bike)</a></h3>
                            <div class="text">Our CD70 Bike Course is designed for new riders looking to gain confidence
                                on two wheels. The course covers essential skills such as balancing, steering, and traffic
                                awareness. Join us to learn the art of motorcycle riding!</div>
                            <div class="link-box"><a href="{{ route('public.courses.cd70') }}"
                                    class="theme-btn btn-style-one semi-round"><span>DETAILS</span></a></div>
                        </div>
                    </div>
                </div>

                <!-- Repeat for other blocks as needed -->
            </div>
        </div>
    </section>
@endsection
