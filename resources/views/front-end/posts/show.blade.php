@extends('front-end.posts.index')
@section('pageTitle', $pageTitle ?? 'Page Title here')
@section('content')
<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
        <h2>{{$post->name}}</h2>
    </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Blog Single Section ======= -->
<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

        <div class="row">

            <div class="col-lg-8 entries">
                <x-card-post :post="$post" />
                <!-- End blog entry -->
            </div><!-- End blog entries list -->

            <div class="col-lg-4">

                <div class="sidebar">

                    <h3 class="sidebar-title">Más en {{$post->category->name}}</h3>
                    <div class="sidebar-item recent-posts">
                        @foreach ($similares as $similar)
                        <div class="post-item clearfix">
                            <img src="{{ Storage::url($similar->image->url) }}" alt="">
                            <h4><a href="{{ route('posts.show', $similar) }}">{{$similar->name}}</a></h4>
                        </div>
                        @endforeach
                    </div><!-- End sidebar recent posts-->

                    <h3 class="sidebar-title">Etiquetas</h3>
                    <div class="sidebar-item tags">
                        <ul>
                            @foreach ($post->tags as $tag)
                            <li class="px-1"><a href="{{ route('posts.tag', $tag) }}">{{$tag->name}}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- End sidebar tags-->

                </div><!-- End sidebar -->

            </div><!-- End blog sidebar -->

        </div>

    </div>
</section><!-- End Blog Single Section -->
@endsection