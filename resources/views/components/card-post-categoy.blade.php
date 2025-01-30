@props(['post'])
<article class="entry">

    <div class="entry-img">
        <img src="{{Storage::url($post->image->url)}}" alt="" class="img-fluid">
    </div>

    <h2 class="entry-title">
        <a href="{{ route('posts.show', $post) }}">{{$post->name}}</a>
    </h2>
    <div class="entry-meta">
        <ul>
            <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                    href="blog-single.html">{{$post->user->name}}</a>
            </li>
            <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-single.html"><time
                        datetime="2020-01-01">Jan 1, 2020</time></a></li>
        </ul>
    </div>

    <div class="entry-content">
        <p>
            {{$post->extract}}
        </p>
        <div class="read-more">
            <a href="{{ route('posts.show', $post) }}">Leer más</a>
        </div>
    </div>

</article>