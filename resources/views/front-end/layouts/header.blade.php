<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <div class="logo">
            <h1><a href="/">Cerveza gtmo</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="/">Home</a></li>
                <li><a class="nav-link scrollto" href="#about">About</a></li>
                <li><a class="nav-link scrollto" href="{{ route('products.show') }}">Productos</a></li>
                <div class="dropdown"><a href="#"><span>Articulos</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        @foreach ($categories as $category)
                        <li><a href="{{ route('posts.category', $category) }}">{{$category->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header>