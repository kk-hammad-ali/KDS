@extends('layout.app')

@section('title', 'Signal Test')
@section('breadcrumb', 'Theroy Test')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 mb-4 text-center">
                <a href="{{ route('public.quiz.english') }}" class="theme-btn btn-style-one w-100">Signal Test English</a>
            </div>
            <div class="col-md-6 mb-4 text-center">
                <a href="{{ route('public.quiz.urdu') }}" class="theme-btn btn-style-one w-100">سگنل ٹیسٹ اردو</a>
            </div>
        </div>
    </div>

    <section class="welcome-three">
        <div class="auto-container">
            <div class="row clearfix">
                <!--Text Col-->
                <div class="text-col col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="inner wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="0ms">
                        <div class="title-box style-two">
                            <h2 class=" text-right"><span>کنگ ڈرائیونگ سکول سگنل ٹیسٹ</span></h2>
                        </div>
                        <div class="text-content">
                            <div class="text text-right">
                                <h3>
                                    ڈرائونگ ٹیسٹ کوز آپ کی ڈرائونگ کے علم اور محنت کا جائزہ لینے کا ایک
                                    امتحانی
                                    پیمانہ ہے۔ یہ کوز آپ کو ٹریفک قوانین، سواری کے علم، سلامتی مسائل، اور درست راہ دکھانے کے
                                    لئے
                                    تیار کرتا ہے۔ اس کوز میں اسلامیہ، قومیت، ٹریفک قوانین، راہ بتانے کی ترتیب، اشارات، اور
                                    سلامتی کے موضوعات شامل ہوتے ہیں۔ ڈرائونگ ٹیسٹ کوز کو آن لائن یا فیزیکل فارم میں دیا جا
                                    سکتا
                                    ہے اور اس کا پاس ہونا ایک ٹیسٹ لینس حاصل کرنے کا راستہ فراہم کرتا ہے۔
                                </h3>
                                <h3>
                                    اس کوئز میں 190 سے زیادہ اہم سوالات ہیں ، یہ ٹیسٹ / کوئز بار بار دیں تاکہ آپ ڈرائیونگ
                                    لائسنس کے لئے ٹریفک سائن ٹیسٹ آسانی سے پاس کرسکیں۔ آئیے اسے شروع کریں
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Image Col-->
                <div class="image-col col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="inner wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="0ms">
                        <div class="pattern"><img src="{{ asset('main/images/resource/wel-pattern.png') }}" alt=""
                                title=""></div>
                        <div class="images clearfix">
                            <div class="image"><img src="{{ asset('main/images/cars/alto.jpg') }}" alt=""
                                    title=""></div>
                            <div class="image-box">
                                <img src="{{ asset('main/images/resource/welcome-4.jpg') }}" alt="" title="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
