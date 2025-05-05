<div class="container-fluid py-2">
    <!-- Tabla -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
            <tr>
                <th class="text-center align-middle">#</th>
                <th class="text-center align-middle">TIM</th>
                <th class="text-center align-middle">Fecha Registro</th>
                <th class="text-center align-middle">Hora Registro</th>
                <th class="text-center align-middle">Motivo Traslado</th>
                <th class="text-center align-middle">Origen</th>
                <th class="text-center align-middle">Destino</th>
                <th class="text-center align-middle">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse($data as $guiasderemision)
                <tr>
                    <td><strong>{{ $guiasderemision['idguia'] }}</strong></td>
                    <td><strong>{{ $guiasderemision['tim'] }}</strong></td>
                    <td><strong>{{ $guiasderemision['fechaemision'] }}</strong></td>
                    <td><strong>{{ $guiasderemision['horaemision'] }}</strong></td>
                    <td><strong>{{ $guiasderemision['motivotraslado'] }}</strong></td>
                    <td><strong>{{ $guiasderemision['origen'] }}</strong></td>
                    <td><strong>{{ $guiasderemision['destino'] }}</strong></td>
                    <td><strong>{{ $guiasderemision['estado'] }}</strong></td>
                    <td><strong>{{ $guiasderemision['cantidadenviada'] }}</strong></td>
                    <td>
                        <a href="#" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i> Editar</a>
                        <a href="#" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Eliminar</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        No hay guias registrados.
                    </td>
                </tr>
            @endforelse
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
