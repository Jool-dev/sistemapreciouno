<div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Placa</th>
            <th>Marca</th>
            <th>Tipo</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            @forelse($data as $vehiculos)
                <tr>
                    <td><strong>{{ $vehiculos['idvehiculo'] }}</strong></td>
                    <td><strong>{{ $vehiculos['placa'] }}</strong></td>
                    <td><strong>{{ $vehiculos['marca'] }}</strong></td>
                    <td><strong>{{ $vehiculos['tipo'] }}</strong></td>
                    <td>
                        <a href="#" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i> Editar</a>
                        <a href="#" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Eliminar</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        No hay Vehiculo registrados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
