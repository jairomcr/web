<section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-envelope d-flex align-items-center"><a
                    href="mailto:contact@example.com">contact@example.com</a></i>
            <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
        </div>
        <div class="cta d-none d-md-flex align-items-center">
            <div class="contact-info d-flex align-items-center">
                {{-- <a href="#about" class="scrollto">Get Started</a> --}}
                @auth
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{Auth::user()->name}}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
                {{-- <a data-bs-toggle="dropdown" href="#"><span>{{Auth::user()->name}}</span> <i
                        class="bi bi-chevron-down" style="color: white;"></i></a>
                <div class="dropdown-menu">
                    <a href="{{ route('profile.show') }}" class="dropdown-item"><i class="fas fa-user-alt me-2"></i>
                        My Profile</a>
                    <a href="#" class="dropdown-item"><i class="fas fa-comment-alt me-2"></i> Inbox</a>
                    <a href="#" class="dropdown-item"><i class="fas fa-bell me-2"></i> Notifications</a>
                    <a href="#" class="dropdown-item"><i class="fas fa-cog me-2"></i> Account Settings</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="fas fa-power-off me-2"></i> Log
                            Out</button>
                    </form>
                </div> --}}
                @else
                <a href="{{ route('register') }}"><small class="me-3 text-dark"><i
                            class="bi bi-user text-primary me-2"></i>Register</small></a>
                <a href="{{ route('login') }}"><small class="me-3 text-dark"><i
                            class="bi bi-sign-in-alt text-primary me-2"></i>Login</small></a>
                @endauth
            </div>
        </div>
    </div>
</section>
{{-- <div class="container-fluid topbar bg-light px-5 d-none d-lg-block">
    <div class="row gx-0 align-items-center">
        <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
            <div class="d-flex flex-wrap">
                <a href="#" class="text-muted small me-4"><i class="fas fa-map-marker-alt text-primary me-2"></i>Find A
                    Location</a>
                <a href="tel:+01234567890" class="text-muted small me-4"><i
                        class="fas fa-phone-alt text-primary me-2"></i>+01234567890</a>
                <a href="mailto:example@gmail.com" class="text-muted small me-0"><i
                        class="fas fa-envelope text-primary me-2"></i>Example@gmail.com</a>
            </div>
        </div>
    </div>
</div> --}}