<section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-envelope d-flex align-items-center"><a
                    href="mailto:contact@example.com"><?= $settings->email ?? 'contact@example.com' ?></a></i>
            <i class="bi bi-phone d-flex align-items-center ms-4"><span><?= $settings->phone ?? '+1 5589 55488 55' ?></span></i>
        </div>
        <div class="cta d-flex align-items-center">

            @auth

            <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                aria-expanded="false"><span>{{auth()->user()->name}}</span> <i class="bi bi-chevron-down"></i>
            </a>
            <ul class="dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                @can('admin.home')
                    <li><a class="dropdown-item text-dark bg-white" href="{{ route('admin.home') }}">Dashboard</a></li>
                @endcan
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item" type="submit">Cerrar sesión</button>
                    </form>
                </li>
            </ul>
            @else
            <a href="{{ route('register') }}" class="scrollto me-3">Register</a>
            <a href="{{ route('login') }}" class="scrollto">Login</a>
            @endauth
        </div>

    </div>
</section>