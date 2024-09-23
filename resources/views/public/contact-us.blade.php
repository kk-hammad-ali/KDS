@extends('layout.app')

@section('title', 'Contact Us')
@section('breadcrumb', 'Contact Us')

@section('content')
    <!--Info Section-->
    <section class="info-section">
        <div class="auto-container">
            <div class="map-box">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d65028532.77887411!2d126.52008190408255!3d-14.779379501629474!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4c2b349649%3A0xb6899234e561db11!2sEnvato!5e0!3m2!1sen!2s!4v1657804775658!5m2!1sen!2s"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="row clearfix">
                <!--Block-->
                <div class="info-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="0ms">
                        <div class="icon-box"><span class="fa-light fa-map-marker-alt"></span></div>
                        <h4>Office Location</h4>
                        <div class="text">629 12th St, Modesto, CA 95354 <br>United States</div>
                    </div>
                </div>
                <!--Block-->
                <div class="info-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="300ms">
                        <div class="icon-box"><span class="fa-light fa-envelope"></span></div>
                        <h4>Company Email</h4>
                        <div class="text">629 12th St, Modesto, CA 95354 <br>United States</div>
                    </div>
                </div>
                <!--Block-->
                <div class="info-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="600ms">
                        <div class="icon-box"><span class="fa-light fa-phone"></span></div>
                        <h4>Contact Us</h4>
                        <div class="text"><a href="tel:1800-222-155">1800-222-155</a> <br><a
                                href="tel:1106-125-120">1106-125-120</a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <!--Contact Section-->
    <section class="contact-section">
        <div class="auto-container">
            <div class="title-box centered style-two">
                <div class="subtitle"><span>CONTACT</span></div>
                <h2><span>Get in Touch</span></h2>
            </div>
            <div class="form-box contact-form">
                <form method="post" action="sendemail.php" id="contact-form">
                    <div class="row clearfix">
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <div class="field-inner">
                                <input type="text" name="username" value="" placeholder="Your Name" required>
                            </div>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <div class="field-inner">
                                <input type="email" name="email" value="" placeholder="Email Adress" required>
                            </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="field-inner">
                                <input type="text" name="address" value="" placeholder="Your Address" required>
                            </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="field-inner">
                                <textarea name="message" placeholder="Message" required></textarea>
                            </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="field-inner text-center">
                                <button type="submit" class="theme-btn btn-style-one"><span>Send Message</span></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section> --}}
@endsection
