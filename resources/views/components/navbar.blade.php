<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-logo">
            <a href="/">
                <img src="{{ asset('images/uneti-logo.png') }}" alt="UNETI Logo" class="navbar-logo-img">
                <span class="navbar-title">Sistema Integral CRUD</span>
            </a>
        </div>
        <div class="navbar-links">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="navbar-link">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="navbar-link">Iniciar Sesión</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="navbar-link navbar-link-register">Registrarse</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</nav>