<article class="entry">

    <div class="entry-img">
        <img src="{{ asset($product->image->url ?? '/storage/products/default.jpeg') }}" alt="" class="img-fluid">
    </div>

    <h2 class="entry-title">
        <a href="{{ route('products.detail', ['id' => $product->id]) }}">{{ $product->name }}</a>
    </h2>
    <div class="entry-meta">
        <ul>
            <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                    href="blog-single.html">{{ $product->user->name }}</a>
            </li>
            <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                    href="blog-single.html"><time datetime="">{{ $product->created_at }}</time></a></li>
        </ul>
    </div>

    <div class="entry-content">
        <p> {{ $product->info }} </p>
        <div class="read-more">
            <a href="{{ 
                route('products.detail', [ 'id' => $product->id ]) }}">Ver Detalles.</a>
    <div class="entry-content">
        <p> {{ $product->info }} </p>
        <div class="read-more">
            <a href="{{ 
                route('products.detail', [ 'id' => $product->id ]) }}">Ver Detalles.</a>
        </div>
    </div>

</article>

</article>