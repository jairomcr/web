@extends('layouts.master')


@section('content')
    <main id="main" class="">
        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                </ol>
                <h2>Lista de Productos</h2>
            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Blog Section ======= -->
        <section id="blog" class="blog">
            <div class="container aos-init aos-animate" data-aos="fade-up">

                <div class="row">
                    <div class="col-lg-10 entries">

                        @forelse ($products->paginate(3) as $product)
                                            @include('front-end.components.product', [
                                                'product' => $product
                                            ])
                        @empty
                            <h1>No hay productos nuevos por ahora...</h1>
                        @endforelse
                    </div><!-- End blog entries list -->
                </div>
                <div class="blog-pagination">
                    {{ $products->paginate(3)->links() }}
                </div>
            </div>
        </section><!-- End Blog Section -->
    </main>
@endsection