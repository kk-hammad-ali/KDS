@extends('layout.app')

@section('title', 'Blogs')
@section('breadcrumb', 'Blog')

@section('content')
    <!--News Section-->
    <section class="news-section">
        <div class="container">
            <div class="news-box">
                <div class="row clearfix">
                    <!--News Block-->
                    <div class="news-block col-xl-4 col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-box wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="0ms">
                            <div class="image-box">
                                <div class="image"><a href="{{ route('public.blog.common-traffic') }}"><img
                                            src="{{ asset('public/images/resource/new-1.png') }}" alt=""
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
                                            src="{{ asset('public/images/resource/new-2.webp') }}" alt=""
                                            title=""></a></div>
                            </div>
                            <div class="lower-box">
                                <div class="info">king driving / September 23, 2024</div>
                                <h4><a href="{{ route('public.blog.driving-test') }}">How to Prepare for Your Driving Test |
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
                                            src="{{ asset('public/images/resource/new-3.webp') }}" alt=""
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
    </section>
@endsection
