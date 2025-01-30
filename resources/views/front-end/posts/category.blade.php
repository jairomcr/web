@extends('front-end.posts.index')
@section('pageTitle', $pageTitle ?? 'Page Title here')
@section('content')
<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
        <ol>
            <li><a href="/">Home</a></li>
        </ol>
        <h2>{{$category->name}}</h2>
    </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Blog Section ======= -->
<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

        <div class="row">
            <div class="col-lg-10 entries">
                @foreach ($posts as $post)
                <x-card-post-categoy :post="$post" />
                <!-- End blog entry -->
                @endforeach
                <div class="blog-pagination">
                    {{$posts->links()}}
                </div>
            </div><!-- End blog entries list -->
        </div>

    </div>
</section><!-- End Blog Section -->
@endsection