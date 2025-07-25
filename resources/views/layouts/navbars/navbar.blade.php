<nav class="navbar">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <a class="navbar-brand fw-bold d-flex align-items-center m-0" href="{{ url('/') }}">
            <span class="logo-navbar me-2">
                <img src="{{ asset('imagens/logo1.png') }}" alt="Logo ENKI">
            </span>
            ENKI
        </a>
        @auth
            <div class="d-flex align-items-center">
                <span class="nav-link mb-0">{{ Auth::user()->name }}</span>
                <a class="nav-link ms-3" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Sair
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        @endauth
        @guest
            <div class="d-flex align-items-center">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
                <a class="nav-link ms-2" href="{{ route('register') }}">Registrar</a>
            </div>
        @endguest
    </div>
</nav>
