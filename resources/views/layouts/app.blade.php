<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="/dash/css/stylesBarra.css">
    <link rel="stylesheet" href="/dash/css/obligatorio.css">
    <title>home</title>

</head>

<body id="body-pd">
    <header class="header" id="header">
        <div class="header__toggle">
            <i class='bx bx-menu' id="header-toggle">Menú</i>
        </div>
        <div class="user-wrapper">
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @endif

                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Cerrar sesión') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </header>
    <!--
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                   Left Side Of Navbar 
                    <ul class="navbar-nav mr-auto">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('taxi.index') }}">{{ __('Taxi') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('chofer.index') }}">{{ __('Choferes') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('corrida.index') }}">{{ __('Corridas') }}</a>
                        </li>

                    </ul>

                    <!- Right Side Of Navbar --
                    <ul class="navbar-nav ml-auto">
                        <-- Authentication Links --
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>
-->

    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="#" class="nav__logo">
                    <i class="fas fa-taxi"></i>
                    <span class="nav__logo-name">YII-YEE</span>
                </a>

                <div class="nav__list">
                    <a href="{{ route('reservacion.corridas') }}" class="nav__link active">
                        <span><i class="fas fa-map-marked-alt"></i></span>
                        <span>Reservaciones</span>
                    </a>

                    <a href="{{ route('envio.index') }}" class="nav__link">
                        <span><i class="fas fa-box-open"></i></span>
                        <span>Paquetería</span>
                    </a>

                    <a href="{{ route('viaje.index') }}" class="nav__link">
                        <span><i class="fas fa-taxi"></i></span>
                        <span>Viajes Especiales</span>
                    </a>

                    <a href="{{ route('chofer.index') }}" class="nav__link">
                        <span><i class="fas fa-user"></i></span>
                        <span>Choferes</span>
                    </a>

                    <a href="{{ route('taxi.index') }}" class="nav__link">
                        <span><i class="fas fa-taxi"></i></span>
                        <span>Taxis</span>
                    </a>

                    <a href="{{ route('corrida.index') }}" class="nav__link">
                        <span><i class="fas fa-map-marker-alt"></i></span>
                        <span>Corridas</span>
                    </a>

                    <a href="{{ route('reporte.index') }}" class="nav__link">
                        <span><i class="fas fa-clipboard"></i></span>
                        <span>Reportes</span>
                    </a>
                </div>
            </div>
        </nav>
    </div>

    <section class="section-2">
        @yield('content')
    </section>
    <!--===== MAIN JS =====-->
    <script src="/dash/js/mainBarra.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="/dash/js/main.js"></script>
</body>

</html>