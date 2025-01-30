<section id="values" class="values">
    <div class="container">
        <div class="row">
            @foreach ($posts as $post)
            <div class="col-md-6 d-flex align-items-stretch mb-4" data-aos="fade-up">
                <div class="card" style="background-image: url({{Storage::url($post->image->url)}});">
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{ route('posts.show', $post) }}">{{$post->name}}</a>
                        </h5>
                        <p class="card-text">{{$post->extract}}</p>
                        <div class="read-more"><a href="{{ route('posts.show', $post) }}"><i
                                    class="bi bi-arrow-right"></i>Leer más</a></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>