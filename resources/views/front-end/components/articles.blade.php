<div class="container-fluid blog pb-5">
    <div class="container pb-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h1 class="display-5 mb-4">Articles</h1>
        </div>
        <div class="owl-carousel blog-carousel wow fadeInUp" data-wow-delay="0.2s">
            @foreach ($posts as $post)
            {{Storage::url($post->image->url)}}
            <div class="blog-item p-4">
                <div class="blog-img mb-4">
                    @if ($post->image)
                    <img src="{{Storage::url($post->image->url)}}" class="img-fluid w-100 rounded" alt="">
                    @else
                    <img src="{{ asset('assets/img/service-1.jpg') }}" class="img-fluid w-100 rounded" alt="">
                    @endif
                    <div class="blog-title">
                        @foreach ($post->tags as $tag)
                        <a href="#" class="btn">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                </div>
                <a href="#" class="h4 d-inline-block mb-3">{{ $post->name }}</a>
                <p class="mb-4">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore aut aliquam
                    suscipit error corporis accusamus labore....
                </p>
                <div class="d-flex align-items-center">
                    <img src="{{ asset('assets/img/testimonial-1.jpg') }}" class="img-fluid rounded-circle"
                        style="width: 60px; height: 60px;" alt="">
                    <div class="ms-3">
                        <h5>Admin</h5>
                        <p class="mb-0">October 9, 2025</p>
                    </div>
                </div>

            </div>
            @endforeach
        </div>
    </div>
</div>