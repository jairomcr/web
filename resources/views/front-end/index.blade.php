@extends('layouts.master')
@section('stylescss')
    <style>
        #hero {
            background: url("{{  asset('storage/'.($settings->image ?? 'image/default.jpg')) }}") center center;
        }  
        .about .video-box {
         background: url("{{ asset('storage/'.($settings->video_img ?? '../img/about-img.jpg')) }}") center center no-repeat;
        }    
    </style>
@endsection
@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
        <div class="container" data-aos="fade-in">
            <h1><?= $settings->name ?? 'Welcome to Flexor' ?></h1>
            <h2><?= $settings->phrase ?? 'We are team of talented designers making websites with Bootstrap' ?></h2>
            <div class="d-flex align-items-center">
                <i class="bx bxs-right-arrow-alt get-started-icon"></i>
                <a href="#about" class="btn-get-started scrollto">Empezar</a>
            </div>
        </div>
    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= Why Us Section ======= -->
        <section id="why-us" class="why-us">
            <div class="container">

                <div class="row">
                    <div class="col-xl-4 col-lg-5" data-aos="fade-up">
                        <div class="content">
                            <h3><?= $settings->subtitle ?? 'Why Choose Flexor for your company website?' ?></h3>
                                @if (isset($settings->extract))
                                    <p>{{$settings->extract}}</p>
                                @else
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.
                                    Asperiores dolores sed et. Tenetur quia eos. Autem tempore quibusdam vel necessitatibus
                                    optio ad corporis.</p>
                                @endif
                            <div class="text-center">
                                <a href="#" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7 d-flex">
                        @include('front-end.components.latest-info')
                    </div>
                </div>

            </div>
        </section><!-- End Why Us Section -->

        <!-- ======= About Section ======= -->
        @include('front-end.components.about')
        <!-- End About Section -->

        <!-- ======= Values Articles ======= -->
        @include('front-end.components.articles')
        <!-- End Values Section -->

        <!-- ======= Portfolio Section ======= -->
        @include('front-end.components.latest-products')
        <!-- End Portfolio Section -->

        <!-- ======= Team Section ======= -->
        @include('front-end.components.team')
        <!-- End Team Section -->

        <!-- ======= Contact Section ======= -->
        @include('front-end.components.contact')
        <!-- End Contact Section -->

    </main><!-- End #main -->
@endsection