@extends('layout.app')

@section('title', 'Contact Us')
@section('breadcrumb', 'Contact Us')

@section('content')

    <!--Contact Section-->
    <style>
        .preloader {
            display: none;
        }

        h2 span {
            color: #FF8F1F;
        }
    </style>

    <section class="contact-section">
        <div class="auto-container">
            <div class="title-box centered style-two">
                <div class="subtitle"><span>CONTACT</span></div>
                <h2><span>Get in Touch</span></h2>
            </div>

            <!-- Display Success Message -->
            @if (session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <div class="form-box contact-form">
                <form method="post" action="{{ route('public.contact.store') }}" id="contact-form">
                    @csrf
                    <div class="row clearfix">
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <div class="field-inner">
                                <input type="text" name="username" value="{{ old('username') }}" placeholder="Your Name"
                                    required>
                            </div>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <div class="field-inner">
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Address"
                                    required>
                            </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="field-inner">
                                <input type="text" name="address" value="{{ old('address') }}" placeholder="Your Address"
                                    required>
                            </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="field-inner">
                                <textarea name="message" placeholder="Message" required>{{ old('message') }}</textarea>
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
    </section>
@endsection
