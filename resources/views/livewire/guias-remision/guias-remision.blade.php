<div class="container-fluid py-2">
    <!-- Título -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Guía de Remisión </h3>
        <div>
            <a href="#" class="btn btn-success">
                <i class="bi bi-plus-lg"></i> Nueva Guía de Remisión
            </a>
            <a href="#" class="btn btn-warning">
                <i class="bi bi-columns-gap"></i> Comparar Guías
            </a>
        </div>
    </div>

    <!-- Barra de búsqueda -->
    <div class="row mb-3">
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Buscar por número de guía, producto, estado...">
        </div>
    </div>

    <!-- Tabla -->
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>TIM</th>
                <th>Producto</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>-M6555265598</td>
                <td>Azúcar Rubia</td>
                <td><span class="badge bg-success">Activo</span></td>
                <td>28/04/2025</td>
                <td>
                    <a href="#" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil-square"></i> Editar
                    </a>
                    <a href="#" class="btn btn-sm btn-danger">
                        <i class="bi bi-trash"></i> Eliminar
                    </a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>-M6555265498</td>
                <td>Arroz Extra</td>
                <td><span class="badge bg-danger">Inactivo</span></td>
                <td>27/04/2025</td>
                <td>
                    <a href="#" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil-square"></i> Editar
                    </a>
                    <a href="#" class="btn btn-sm btn-danger">
                        <i class="bi bi-trash"></i> Eliminar
                    </a>
                </td>
            </tr>
            <!-- Puedes agregar más ejemplos aquí -->
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center mt-4">
            <li class="page-item disabled">
                <a class="page-link">Anterior</a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Siguiente</a>
            </li>
        </ul>
    </nav>
</div>
