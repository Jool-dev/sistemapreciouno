<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
    <!-- Bootstrap 5 CSS -->
    <link rel="icon" type="image/png" href="{{ asset('storage/imgsistema/logo.png') }}">
    @vite([
        'resources/css/demo/styles.css',
        'resources/js/applogin.js'
    ])
</head>
<body class="bg-light">
<div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow-lg" style="width: 24rem;">
        <div class="card-header bg-primary text-white text-center py-4">
            <h3 class="mb-1">Bienvenido</h3>
            <p class="mb-0 small">Ingresa tus credenciales para acceder</p>
        </div>

        <div class="card-body p-4">
            <form id="formulariologin">
                @csrf
                <div class="row gy-2 overflow-hidden">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" id="username" placeholder="name@example.com" required>
                            <label for="email" class="form-label">Correo</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password" required>
                            <label for="password" class="form-label">Contraseña</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex gap-2 justify-content-between">
                            <a href="#!" class="link-primary text-decoration-none">¿Olvidastes tu Contraseña?</a>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-grid my-3">
                            <button id="btnlogin" class="btn btn-primary btn-lg" type="submit">Iniciar Sesión</button>
                        </div>
                    </div>
                    {{--                        <div class="col-12">--}}
                    {{--                            <p class="m-0 text-secondary text-center">Don't have an account? <a href=" {{route("vistausuarioregistro1")}}" class="link-primary text-decoration-none">Registráte</a></p>--}}
                    {{--                        </div>--}}
                </div>
            </form>
            {{--                <form id="formulariologin">--}}
            {{--                    @csrf <!-- Token de seguridad de Laravel -->--}}
            {{--                    <div class="mb-3">--}}
            {{--                        <label for="username" class="form-label">Usuario</label>--}}
            {{--                        <div class="input-group">--}}
            {{--                            <span class="input-group-text bg-light"><i class="bi bi-person-fill text-primary"></i></span>--}}
            {{--                            <input type="text" class="form-control" id="username" placeholder="Ingresa tu usuario" required>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}

            {{--                    <div class="mb-3">--}}
            {{--                        <label for="password" class="form-label">Contraseña</label>--}}
            {{--                        <div class="input-group">--}}
            {{--                            <span class="input-group-text bg-light"><i class="bi bi-lock-fill text-primary"></i></span>--}}
            {{--                            <input type="password" class="form-control" id="password" placeholder="Ingresa tu contraseña" required>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}

            {{--                    <div class="mb-3 d-flex justify-content-between align-items-center">--}}
            {{--                        <div class="form-check">--}}
            {{--                            <input class="form-check-input" type="checkbox" id="remember">--}}
            {{--                            <label class="form-check-label small" for="remember">Recordar sesión</label>--}}
            {{--                        </div>--}}
            {{--                        <a href="#" class="small text-decoration-none">¿Olvidaste tu contraseña?</a>--}}
            {{--                    </div>--}}

            {{--                    <button href="{{route("vistadashboard")}}" type="submit" class="btn btn-primary w-100 py-2 mb-3 fw-bold">Iniciar Sesión</button>--}}
            {{--                    <button id="btnlogin" class="btn btn-primary btn-lg" type="submit">Iniciar Sesión</button>--}}
            {{--                </form>--}}
        </div>

        <div class="card-footer bg-light text-center py-3">
            <p class="small mb-0">¿No tienes cuenta? <a href="#" class="text-decoration-none">Regístrate aquí</a></p>
        </div>
    </div>
</div>
</body>
</html>
