@extends('layouts.master')

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
        <div class="container" data-aos="fade-in">
            <h1>Welcome to Flexor</h1>
            <h2>We are team of talented designers making websites with Bootstrap</h2>
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
                            <h3>Why Choose Flexor for your company website?</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua.
                                Asperiores dolores sed et. Tenetur quia eos. Autem tempore quibusdam vel necessitatibus
                                optio ad corporis.
                            </p>
                            <div class="text-center">
                                <a href="#" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7 d-flex">
                        @include('front-end.components.latest-info', [
                            'last_post' => \App\Models\Post::latest()->first(),
                            'last_product' => \App\Models\Product::latest()->first(),
                        ])
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
        @include('front-end.components.latest-products', [
            'products' => \App\Models\Product::latest()->take(6)->get(),
        ])
        <!-- End Portfolio Section -->

        <!-- ======= Team Section ======= -->
        @include('front-end.components.team')
        <!-- End Team Section -->

        <!-- ======= Contact Section ======= -->
        @include('front-end.components.contact')
        <!-- End Contact Section -->

    </main><!-- End #main -->
@endsection