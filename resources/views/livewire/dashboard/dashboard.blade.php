<div class="container-fluid px-4">
    <h1 class="mt-4 mb-4 fw-bold">Dashboard</h1>
    @vite('resources/css/views/dahsboard/dashboard.css')
    <!-- Tarjetas resumen -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-gradient-primary shadow-sm rounded-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 fw-semibold">Guías Emitidas</h6>
                        <h3 class="fw-bold">1500</h3>
                    </div>
                    <i class="fas fa-truck fa-3x opacity-75"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-gradient-warning shadow-sm rounded-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 fw-semibold">Revisiones Realizadas</h6>
                        <h3 class="fw-bold">1200</h3>
                    </div>
                    <i class="fas fa-check-circle fa-3x opacity-75"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-gradient-success shadow-sm rounded-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 fw-semibold">Guías Sin Daño</h6>
                        <h3 class="fw-bold">1100</h3>
                    </div>
                    <i class="fas fa-shield-alt fa-3x opacity-75"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-gradient-danger shadow-sm rounded-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 fw-semibold">Guías Con Daño</h6>
                        <h3 class="fw-bold">50</h3>
                    </div>
                    <i class="fas fa-exclamation-triangle fa-3x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico ancho -->
    <div class="card mb-4 shadow-sm rounded-3">
        <div class="card-header bg-light fw-semibold d-flex align-items-center">
            <i class="fas fa-chart-area me-2"></i> Últimas Guías Emitidas
        </div>
        <div class="card-body p-3">
            <canvas id="myAreaChart" style="width: 100%; height: 350px;"></canvas>
        </div>
    </div>

    <!-- Tabla principal -->
    <div class="card mb-5 shadow-sm rounded-3">
        <div class="card-header bg-light fw-semibold d-flex align-items-center">
            <i class="fas fa-table me-2"></i> Tabla de Discrepancias
        </div>
        <div class="card-body p-3">
            <table id="datatablesSimple" class="table table-striped table-hover align-middle">
                <thead class="table-primary">
                <tr>
                    <th>EAN/SKU</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Cantidad</th>
                    <th>Fecha de entrega</th>
                    <th>Salary</th>
                </tr>
                </thead>
                <tbody>
                <!-- filas aquí -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Nuevo apartado final: Dashboard adicional -->
    <div class="row g-4">

        <!-- Top 5 servicios más vendidos -->
        <div class="col-lg-4">
            <div class="card shadow-sm rounded-3 p-3">
                <div class="text-center mb-3">
                    <button class="btn btn-outline-success btn-sm rounded-pill px-3 fw-semibold">
                        Top 5 servicios más vendidos
                    </button>
                </div>
                <canvas id="topServiciosChart" style="width: 100%; height: 300px;"></canvas>
            </div>
        </div>

        <!-- Top 10 clientes con más suscripciones -->
        <div class="col-lg-4">
            <div class="card shadow-sm rounded-3 p-3">
                <div class="text-center mb-3">
                    <button class="btn btn-outline-success btn-sm rounded-pill px-3 fw-semibold">
                        Top 10 clientes con más suscripciones
                    </button>
                </div>
                <div class="table-responsive" style="max-height: 320px; overflow-y: auto;">
                    <table class="table table-sm table-striped align-middle mb-0">
                        <thead class="table-success sticky-top">
                        <tr>
                            <th>N°</th>
                            <th>Nombre</th>
                            <th>Cantidad de suscripciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- filas dinámicas -->
                        <tr><td>1</td><td>M4 FERNANDO</td><td>5</td></tr>
                        <tr><td>2</td><td>M35 NETFLIX COMPLETA</td><td>5</td></tr>
                        <tr><td>3</td><td>M30 IPTV COMPLETA</td><td>5</td></tr>
                        <tr><td>4</td><td>M17 ALDO</td><td>4</td></tr>
                        <tr><td>5</td><td>M30 PRIME COMPLETO</td><td>3</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Top 10 clientes con más renovaciones -->
        <div class="col-lg-4">
            <div class="card shadow-sm rounded-3 p-3">
                <div class="text-center mb-3">
                    <button class="btn btn-outline-success btn-sm rounded-pill px-3 fw-semibold">
                        Top 10 clientes con más renovaciones
                    </button>
                </div>
                <div class="table-responsive" style="max-height: 320px; overflow-y: auto;">
                    <table class="table table-sm table-striped align-middle mb-0">
                        <thead class="table-success sticky-top">
                        <tr>
                            <th>N°</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Cantidad de renovaciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- filas dinámicas -->
                        <tr><td>1</td><td>M4 FERNANDO</td><td>Fernando</td><td>12</td></tr>
                        <tr><td>2</td><td>Cliente 2</td><td>Apellido 2</td><td>9</td></tr>
                        <tr><td>3</td><td>Cliente 3</td><td>Apellido 3</td><td>8</td></tr>
                        <tr><td>4</td><td>Cliente 4</td><td>Apellido 4</td><td>7</td></tr>
                        <tr><td>5</td><td>Cliente 5</td><td>Apellido 5</td><td>5</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
