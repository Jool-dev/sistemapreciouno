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
            <form id="formulariologin" method="POST">
                @csrf
                <div class="row gy-3">
                    <!-- Campo de Correo -->
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

                    <!-- Campo de Contraseña -->
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

                    <!-- Enlace para recuperar contraseña -->
                    <div class="col-12 text-end">
                        <a href="#!" class="link-primary text-decoration-none small">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>

                    <!-- Botón de Inicio de Sesión -->
                    <div class="col-12">
                        <div class="d-grid">
                            <button id="btnlogin" class="btn btn-primary btn-lg" type="submit">
                                Iniciar Sesión
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
