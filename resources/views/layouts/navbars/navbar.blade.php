<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #009B8F;">
    <div class="container-fluid">
        <a class="navbar-brand text-white fw-bold" href="{{ url('/') }}">
            <img src="{{ asset('imagens/logo1.png') }}" alt="Logo ENKI" style="height: 40px; margin-right: 8px;">
            ENKI
        </a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('register') }}">Registrar</a>
                    </li>
                @else
                    <li class="nav-item">
                        <span class="nav-link text-white">{{ Auth::user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Sair
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
