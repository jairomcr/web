<article class="entry">

    <div class="entry-img">
        <img src="{{ Storage::url($product->image->url) }}" alt="" class="img-fluid" style="width: 60%;">
    </div>

    <h2 class="entry-title">
        <a href="{{ route('products.detail', ['product' => $product->slug]) }}">{{ $product->name }}</a>
    </h2>
    <div class="entry-meta">
        <ul>
            <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                    href="blog-single.html">{{ $product->user->name }}</a>
            </li>
            <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-single.html"><time
                        datetime="">{{ $product->created_at }}</time></a></li>
        </ul>
    </div>

    <div class="entry-content">
        <p> {{ $product->info }} </p>
        <div class="read-more">
            <a href="{{ route('products.detail', ['product' => $product->slug]) }}">Ver Detalles.</a>
        </div>
    </div>

</article>

</article>
