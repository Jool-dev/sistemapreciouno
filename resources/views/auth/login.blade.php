<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
    <!-- Bootstrap 5 CSS -->
    <link rel="icon" type="image/png" href="{{ asset('storage/imgsistema/logo.png') }}">
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    @vite([
//        'resources/css/demo/styles.css',
        'resources/css/views/login/login.css',
        'resources/js/applogin.js'
    ])
</head>
<body class="bg-light">
<div class="login-container">
    <div class="left-side" >
        <!-- Aquí va tu contenido HTML tal cual -->
        <div class="container-fluid vh-100 d-flex justify-content-center align-items-center p-0" style="height: auto;">
            <div class="card shadow-lg" style="width: 24rem;">
                <div class="card-header bg-danger text-white text-center py-4">
                    <h3 class="mb-1">Bienvenido</h3>
                    <p class="mb-0 small">Ingresa tus credenciales para acceder</p>
                </div>
                <div class="card-body p-4">
                    <form id="formulariologin" method="POST">
                        @csrf
                        <div class="row gy-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input
                                        type="email"
                                        class="form-control"
                                        name="email"
                                        id="username"
                                        placeholder="correo@ejemplo.com"
                                        required
                                        autocomplete="username"
                                    >
                                    <label for="email">Correo electrónico</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <input
                                        type="password"
                                        class="form-control"
                                        name="password"
                                        id="password"
                                        placeholder="Contraseña"
                                        required
                                        autocomplete="current-password"
                                    >
                                    <label for="password">Contraseña</label>
                                </div>
                            </div>
                            <a href="#!" class="text-danger text-decoration-none small">
                                ¿Olvidaste tu contraseña?
                            </a>

                            <button id="btnlogin" class="btn btn-danger btn-lg" type="submit">
                                Iniciar Sesión
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="right-side">
        <img src="{{ asset('storage/img/Hiperbodega_Precio_Uno.svg') }}" alt="Hiperbodega Precio Uno" class="logo-img"
        alt="Hiperbodega Precio Uno"
        style="width: 280px; height: auto;">
    </div>
</div>
</body>
</html>
