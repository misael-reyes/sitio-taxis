<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/dash/css/login.css" />
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="contenedor-formulario">
            <div class="inicio-registro">
                <form method="POST" action="{{ route('login')}}" class="formulario-inicio">
                    @csrf
                    <h2 class="title">Bienvenido</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña" name="password" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <input type="submit" value="Login" class="btn solid" />
                    <p class="social-text">Nuestras redes sociales</p>
                    <div class="redes">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form>
                <form method="POST" action="{{ route('register') }}" class="formulario-registro">
                    @csrf
                    <h2 class="title">Registrarse</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nombre de usuario" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>

                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar contraseña" required autocomplete="new-password">
                    </div>


                    <input type="submit" class="btn" value="Registrarse" />
                    <p class="social-text">Nuestras redes sociales</p>
                    <div class="redes">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="paneles-contenedor">
            <div class="panel panel-registro">
                <div class="content">
                    <h3>Registrarse</h3>
                    <p>
                        Servivicio de taxis, resgistra tus datos.
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Regístrate
                    </button>
                </div>
                <img src="/dash/img/telephone.png" class="image" alt="" />
            </div>
            <div class="panel panel-inicio">
                <div class="content">
                    <h3>¿Ya tienes cuenta?</h3>
                    <p>
                        Ingresa tus datos para iniciar sesión
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Iniciar sesión
                    </button>
                </div>
                <img src="/dash/img/taxi.png" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="/dash/js/app.js"></script>
</body>

</html>