@extends('layouts.master')

@section('content')
<!-- PRODUCT DETAIL -->
<main id="main" class="">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{ url('/') }}">Inicio</a></li>
                <li>Detalles del producto</li>
            </ol>
            <h2>Producto: {{ $product->name }}</h2>
        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-8">
                    <img src="{{ Storage::url($product->image->url) }}" class="img-fluid"
                        alt="Imagen para el producto {{ $product->name }}">
                </div>

                <div class="col-lg-4">
                    <div class="portfolio-info row">
                        <b class="h4 col-12"><i>{{ $product->price }} CUP</i></b>
                        <b class="h5 col-12">Publicado por `<i>{{ $product->user->name }}</i>`</b>
                    </div>
                </div>
                <div class="portfolio-description">
                    <h2>{{ $product->info }}</h2>
                    <p>
                        {{ $product->desc }}
                    </p>
                </div>
            </div>

        </div>

        </div>
    </section><!-- End Portfolio Details Section -->

</main>
<!-- END PRODUCT DETAIL -->
@endsection