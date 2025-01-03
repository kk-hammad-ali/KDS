<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Best Driving School in Islamabad King Driving School</title>
    <!-- Stylesheets -->
    <link href="{{ asset('main/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('main/css/style.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('main/images/logo.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('main/images/logo.png') }}" type="image/x-icon">
    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link href="{{ asset('main/css/responsive.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>

</head>

<body>
    <div class="page-wrapper">

        <!-- Preloader -->
        <div class="preloader"></div>

        <!-- Main Header -->
        <header class="main-header header-two">
            <div class="header-top">
                <div class="auto-container">
                    <div class="inner clearfix">
                        <div class="top-left clearfix">
                            <ul class="top-info clearfix">
                                <li>Call us : &nbsp;&nbsp;<a href="mailto:info@kingdrivingschool.com"><i
                                            class="icon far fa-envelope"></i> &nbsp;info@kingdrivingschool.com</a></li>
                                <li><a href="tel:+92 051-4445444"><i class="icon far fa-phone"></i>
                                        &nbsp;051-4445444</a></li>
                            </ul>
                        </div>
                        <div class="top-right clearfix">
                            <ul class="social-links clearfix">
                                <li>Follow Us :</li>
                                <li><a href="https://www.facebook.com/kingdrivingschoolisb"><i
                                            class="fab fa-facebook-f"></i></a></li>
                                <li><a href="https://www.instagram.com/king_drivingschool"><i
                                            class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header Upper -->
            <div class="header-upper">
                <div class="auto-container">
                    <!-- Main Box -->
                    <div class="main-box clearfix">
                        <!-- Logo -->
                        <div class="logo-box">
                            <div class="logo"><a href="{{ route('home') }}" title="King Driving School"><img
                                        src="{{ asset('main/images/logo.png') }}" alt=""
                                        title="King Driving School"></a></div>
                        </div>

                        <div class="nav-box clearfix">
                            <!-- Nav Outer -->
                            <div class="nav-outer clearfix">
                                <nav class="main-menu">
                                    <ul class="navigation clearfix">
                                        <li><a href="{{ route('home') }}">Home</a></li>
                                        <li><a href="{{ route('public.about') }}">About Us</a></li>
                                        <li class="dropdown"><a href="{{ route('public.courses') }}">Courses</a>
                                            <ul>
                                                <li><a href="{{ route('public.courses.mehranCourse') }}">Suzuki
                                                        Mehran</a></li>
                                                <li><a href="{{ route('public.courses.altoCourse') }}">Suzuki Alto
                                                        (Manual)</a></li>
                                                <li><a href="{{ route('public.courses.vitzCourse') }}">Toyota Vitz
                                                        (Automatic)</a></li>
                                                <li><a href="{{ route('public.courses.miraCourse') }}">Daihatsu Mira
                                                        (Automatic)</a></li>
                                                <li><a href="{{ route('public.courses.hondaCourse') }}">Honda City
                                                        (Automatic)</a></li>
                                                <li><a href="{{ route('public.courses.swiftCourse') }}">Swift</a></li>
                                                <li><a href="{{ route('public.courses.cd70') }}">Bike (CD-70)</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="{{ route('public.gallery') }}">Gallery</a></li>
                                        {{-- <li><a href="{{ route('public.branch') }}">Branches</a></li> --}}
                                        <li><a href="{{ route('public.blog') }}">Blog</a></li>
                                        <li><a href="{{ route('public.contact') }}">Contact</a></li>
                                        <li>
                                            <div class="link"><a style="padding: 8px;"
                                                    href="{{ route('public.quiz') }}"
                                                    class="theme-btn btn-style-one"><span>Theory
                                                        Test</span></a></div>
                                        </li>
                                        <li>
                                            <div class="link"><a style="padding: 8px;"
                                                    href="{{ route('public.admission.form') }}"
                                                    class="theme-btn btn-style-one"><span>Book
                                                        Now</span></a></div>
                                        </li>
                                    </ul>
                                </nav>
                                <!-- Main Menu End -->
                            </div>
                            <!-- Nav Outer End -->

                            <!-- Hidden Nav Toggler -->
                            <div class="nav-toggler">
                                <button class="hidden-bar-opener"><span class="icon"><img
                                            src="{{ asset('main/images/icons/menu-icon.png') }}"
                                            alt=""></span></button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!--Menu Backdrop-->
        <div class="menu-backdrop"></div>

        <!-- Hidden Navigation Bar -->
        <section class="hidden-bar">
            <!-- Hidden Bar Wrapper -->
            <div class="hidden-bar-wrapper">
                <div class="hidden-bar-closer"><span class="icon"><svg class="icon-close" role="presentation"
                            viewBox="0 0 16 14">
                            <path d="M15 0L1 14m14 0L1 0" stroke="currentColor" fill="none" fill-rule="evenodd">
                            </path>
                        </svg></span></div>
                <div class="nav-logo-box">
                    <div class="logo"><a href="index.html" title="King Driving School"><img
                                src="{{ asset('main/images/logo.png') }}" alt=""
                                title="King Driving School"></a>
                    </div>
                </div>
                <!-- .Side-menu -->
                <div class="side-menu">
                    <ul class="navigation clearfix">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('public.about') }}">About Us</a></li>
                        <li class="dropdown"><a href="{{ route('public.courses') }}">Courses</a>
                            <ul>
                                <li><a href="{{ route('public.courses.mehranCourse') }}">Suzuki
                                        Mehran</a></li>
                                <li><a href="{{ route('public.courses.altoCourse') }}">Suzuki Alto
                                        (Manual)</a></li>
                                <li><a href="{{ route('public.courses.vitzCourse') }}">Toyota Vitz
                                        (Automatic)</a></li>
                                <li><a href="{{ route('public.courses.miraCourse') }}">Daihatsu Mira
                                        (Automatic)</a></li>
                                <li><a href="{{ route('public.courses.hondaCourse') }}">Honda City
                                        (Automatic)</a></li>
                                <li><a href="{{ route('public.courses.swiftCourse') }}">Swift</a></li>
                                <li><a href="{{ route('public.courses.cd70') }}">Bike (CD-70)</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('public.gallery') }}">Gallery</a></li>
                        {{-- <li><a href="{{ route('public.branch') }}">Branches</a></li> --}}
                        <li><a href="{{ route('public.blog') }}">Blog</a></li>
                        <li><a href="{{ route('public.contact') }}">Contact</a></li>
                        <li style="margin:15px;">
                            <div class="link"><a href="{{ route('public.quiz') }}"
                                    class="theme-btn btn-style-one"><span>Theory
                                        Test</span></a></div>
                        </li>
                        <li style="margin:15px;">
                            <div class="link"><a href="{{ route('public.admission.form') }}"
                                    class="theme-btn btn-style-one"><span>Book
                                        Now</span></a></div>
                        </li>
                    </ul>
                </div><!-- /.Side-menu -->
            </div>
            <!-- / Hidden Bar Wrapper -->
        </section>
        <!-- / Hidden Bar -->

        <!--Info Back Drop-->
        <div class="info-back-drop"></div>

        <!-- Banner Section -->
        <section class="inner-banner">
            <div class="image-layer" style="background-image: url('@yield('bannerImage', asset('main/images/background/banner-image-1.jpg'))');"></div>
            <div class="auto-container">
                <div class="content-box">
                    <div class="bread-crumb">
                        <ul class="clearfix">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li class="current">@yield('breadcrumb', 'Default Breadcrumb')</li>
                        </ul>
                    </div>
                    <h1>@yield('title', 'Default Title')</h1>
                </div>
            </div>
        </section>
        <!-- End Banner Section -->


        @yield('content')


        <!-- Main Footer -->
        <footer class="main-footer">
            <div class="upper-section">
                <div class="auto-container">
                    <div class="row clearfix">

                        <div class="big-col col-xl-6 col-lg-12 col-md-12 col-sm-12">
                            <div class="row clearfix">

                                <div class="footer-column col-xl-7 col-lg-7 col-md-6 col-sm-12">
                                    <div class="about">
                                        {{-- <div class="footer-logo"><a href="index.html"
                                                title="King Driving School"><img
                                                    src="{{ asset('main/images/logo.png') }}" alt=""
                                                    title="King Driving School"></a></div> --}}
                                        <div class="text">Don't just learn to drive, experience the joy of the ride.
                                            Contact us and let's start your driving lessons together!</div>
                                        <div class="address"><span class="icon fa-light fa-map-marker-alt"></span>
                                            King driving school, Sohni Road, Near Allied Bank Shaukat Plaza, I-10 Markaz
                                            Islamabad, 44000</div>
                                        <div class="phone">
                                            <span class="icon fa fa-phone"></span>
                                            <a href="tel:+923233333818" class="theme-btn">0323-3333818</a>
                                            <a href="tel:+92514445444" class="theme-btn">051-4445444</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="footer-column col-xl-5 col-lg-5 col-md-6 col-sm-12">
                                    <h6>Courses</h6>
                                    <div class="links">
                                        <ul>
                                            <li><a href="#">Suzuki Mehran</a></li>
                                            <li><a href="#">Suzuki Alto (Manual)</a></li>
                                            <li><a href="#">Toyota Vitz (Automatic)</a></li>
                                            <li><a href="#">Daihatsu Mira (Automatic)</a></li>
                                            <li><a href="#">Honda City (Automatic)</a></li>
                                            <li><a href="#">Bike (CD-70)</a></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="big-col col-xl-6 col-lg-12 col-md-12 col-sm-12">
                            <div class="row clearfix">
                                <div class="footer-column col-xl-5 col-lg-5 col-md-6 col-sm-12">
                                    <h6>Links</h6>
                                    <div class="links">
                                        <ul>
                                            <li><a href="{{ route('public.about') }}">About Us</a></li>
                                            <li><a href="{{ route('public.courses') }}">Courses</a></li>
                                            <li><a href="{{ route('public.gallery') }}">Gallery</a></li>
                                            <li><a href="{{ route('public.blog') }}">Blog</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="footer-column col-xl-7 col-lg-7 col-md-6 col-sm-12">
                                    <h6>Our Gallery</h6>
                                    <!-- Logo -->
                                    <div class="footer-gallery">
                                        <div class="inner clearfix">
                                            <div class="image-block">
                                                <div class="image"><a
                                                        href="{{ asset('main/images/resource/image-1.jpg') }}"
                                                        class="lightbox-image" data-fancybox="gallery"><img
                                                            src="{{ asset('main/images/resource/g-thumb-1.webp') }}"
                                                            alt=""></a></div>
                                            </div>
                                            <div class="image-block">
                                                <div class="image"><a
                                                        href="{{ asset('main/images/resource/image-2.jpg') }}"
                                                        class="lightbox-image" data-fancybox="gallery"><img
                                                            src="{{ asset('main/images/resource/g-thumb-2.webp') }}"
                                                            alt=""></a></div>
                                            </div>
                                            <div class="image-block">
                                                <div class="image"><a
                                                        href="{{ asset('main/images/resource/image-3.jpg') }}"
                                                        class="lightbox-image" data-fancybox="gallery"><img
                                                            src="{{ asset('main/images/resource/g-thumb-3.webp') }}"
                                                            alt=""></a></div>
                                            </div>
                                            <div class="image-block">
                                                <div class="image"><a
                                                        href="{{ asset('main/images/resource/image-1.jpg') }}"
                                                        class="lightbox-image" data-fancybox="gallery"><img
                                                            src="{{ asset('main/images/resource/g-thumb-4.webp') }}"
                                                            alt=""></a></div>
                                            </div>
                                            <div class="image-block">
                                                <div class="image"><a
                                                        href="{{ asset('main/images/resource/image-2.jpg') }}"
                                                        class="lightbox-image" data-fancybox="gallery"><img
                                                            src="{{ asset('main/images/resource/g-thumb-5.webp') }}"
                                                            alt=""></a></div>
                                            </div>
                                            <div class="image-block">
                                                <div class="image"><a
                                                        href="{{ asset('main/images/resource/image-3.jpg') }}"
                                                        class="lightbox-image" data-fancybox="gallery"><img
                                                            src="{{ asset('main/images/resource/g-thumb-6.webp') }}"
                                                            alt=""></a></div>
                                            </div>
                                            <div class="image-block">
                                                <div class="image"><a
                                                        href="{{ asset('main/images/resource/image-1.jpg') }}"
                                                        class="lightbox-image" data-fancybox="gallery"><img
                                                            src="{{ asset('main/images/resource/g-thumb-7.webp') }}"
                                                            alt=""></a></div>
                                            </div>
                                            <div class="image-block">
                                                <div class="image"><a
                                                        href="{{ asset('main/images/resource/image-2.jpg') }}"
                                                        class="lightbox-image" data-fancybox="gallery"><img
                                                            src="{{ asset('main/images/resource/g-thumb-8.webp') }}"
                                                            alt=""></a></div>
                                            </div>
                                            <div class="image-block">
                                                <div class="image"><a
                                                        href="{{ asset('main/images/resource/image-3.jpg') }}"
                                                        class="lightbox-image" data-fancybox="gallery"><img
                                                            src="{{ asset('main/images/resource/g-thumb-9.webp') }}"
                                                            alt=""></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="f-bottom bg-black" style="background: black;">
                <div class="auto-container">
                    <div class="inner clearfix">
                        <div class="copyright">Copyrights &copy; 2024 King Driving School</div>
                        <div class="social-links">
                            <ul class="clearfix">
                                <li><a href="https://www.facebook.com/kingdrivingschoolisb"><i
                                            class="fab fa-facebook-f"></i></a></li>
                                <li><a href="https://www.instagram.com/king_drivingschool"><i
                                            class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!--End pagewrapper-->

    <!-- Scroll to top -->
    <div class="scroll-to-top scroll-to-target" data-target="html">
        <span class="icon">
            <img src="{{ asset('main/images/icons/arrow-up.svg') }}" alt="" title="Go To Top">
        </span>
    </div>

    <script src="{{ asset('main/js/jquery.js') }}"></script>
    <script src="{{ asset('main/js/popper.min.js') }}"></script>
    <script src="{{ asset('main/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('main/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('main/js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('main/js/owl.js') }}"></script>
    <script src="{{ asset('main/js/wow.js') }}"></script>
    <script src="{{ asset('main/js/custom-script.js') }}"></script>
</body>

</html>
