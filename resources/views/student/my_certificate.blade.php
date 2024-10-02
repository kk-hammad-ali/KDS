@extends('layout.student')

@section('page_content')
    <style>
        body {
            font-family: Roboto;
        }

        .certificate-container {
            padding: 50px;
            width: 1024px;
        }

        .certificate {
            border: 20px solid #FF8F1F;
            padding: 25px;
            height: 600px;
            position: relative;
        }

        .certificate:after {
            content: '';
            top: 0px;
            left: 0px;
            bottom: 0px;
            right: 0px;
            position: absolute;
            background-image: url(https://image.ibb.co/ckrVv7/water_mark_logo.png);
            background-size: 100%;
            z-index: -1;
        }

        .certificate-header>.logo {
            width: 80px;
            height: 80px;
        }

        .certificate-title {
            text-align: center;
        }

        .certificate-body {
            text-align: center;
        }

        h1 {
            font-weight: 400;
            font-size: 48px;
            color: #FF8F1F;
        }

        .student-name {
            font-size: 24px;
        }

        .certificate-content {
            margin: 0 auto;
            width: 750px;
        }

        .about-certificate {
            width: 380px;
            margin: 0 auto;
        }

        .topic-description {
            text-align: center;
        }
    </style>
    <div class="certificate-container">
        <div class="certificate">
            <div class="water-mark-overlay"></div>
            <div class="certificate-header">
                <img src="{{ asset('public/images/logo.png') }}" class="logo" alt="King Driving School Logo">
            </div>
            <div class="certificate-body">
                {{-- <p class="certificate-title"><strong>King Driving School</strong></p> --}}
                <h1>Certificate of Completion</h1>
                <p class="student-name">Matthew Taylor</p>
                <div class="certificate-content">
                    <div class="about-certificate">
                        <p>
                            has completed [number of hours] hours of driving training on [Date of Completion].
                        </p>
                    </div>
                    <p class="topic-title">
                        The course consists of [number of hours] hours and includes the following topics:
                    </p>
                    <div class="text-center">
                        <p class="topic-description text-muted">Traffic Laws - Defensive Driving - Safe Driving Practices -
                            Road Signs - Vehicle Operation - Emergency Procedures</p>
                    </div>
                </div>
                <div class="certificate-footer text-muted">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Instructor: ______________________</p>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Accredited by</p>
                                </div>
                                <div class="col-md-6">
                                    <p>Endorsed by</p>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
