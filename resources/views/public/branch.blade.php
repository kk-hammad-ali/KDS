@extends('layout.app')

@section('title', 'Branches')
@section('breadcrumb', 'Branches')

@section('content')
    <!--Info Section-->
    <section class="info-section">
        <div class="auto-container">
            <div class="map-box">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d106282.59737661654!2d73.040236!3d33.64858!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38df95a760f8ae57%3A0xaf7497d206440721!2sKing%20Driving%20School!5e0!3m2!1sen!2sus!4v1727035113056!5m2!1sen!2sus"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="row clearfix">
                <!--Block-->
                <div class="info-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="0ms">
                        <div class="icon-box"><span class="fa-light fa-map-marker-alt"></span></div>
                        <h4>Office Location</h4>
                        <div class="text">King Driving School, Sohni Road, Near Allied Bank Shaukat Plaza, I-10 Markaz
                            Islamabad,44000</div>
                    </div>
                </div>
                <!--Block-->
                <div class="info-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="300ms">
                        <div class="icon-box"><span class="fa-light fa-envelope"></span></div>
                        <h4>Company Email</h4>
                        <div class="text">kingdrivingschool2@gmail.com<br></div>
                    </div>
                </div>
                <!--Block-->
                <div class="info-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="600ms">
                        <div class="icon-box"><span class="fa-light fa-phone"></span></div>
                        <h4>Contact Us</h4>
                        <div class="text"><a href="tel:+9251-4445444">051-4445444</a> <br><a
                                href="tel:+92323-3333818">0323-3333818</a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
