<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="table-dark">
        <tr>
            <th class="text-center align-middle">#</th>
            <th class="text-center align-middle">Placa</th>
            <th class="text-center align-middle">Marca</th>
            <th class="text-center align-middle">Tipo</th>
            <th class="text-center align-middle">Acciones</th>
        </tr>
        </thead>
        <tbody>
            @forelse($vehiculos as $vehiculo)
                <tr wire:key="vehiculo-{{ $vehiculo['idvehiculo'] }}-{{ now()->timestamp }}">
                    <td><strong>{{ $vehiculo['idvehiculo'] }}</strong></td>
                    <td><strong class="placa">{{ $vehiculo['placa'] }}</strong></td>
                    <td><strong class="marca">{{ $vehiculo['marca'] }}</strong></td>
                    <td><strong class="tipo">{{ $vehiculo['tipo'] }}</strong></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-warning btn-editarvehiculo">
                            <i class="bi bi-pencil-square"></i> Editar
                        </button>
                        <button type="button" class="btn btn-sm btn-danger btn-eliminarvehiculo"
                                data-id="{{ $vehiculo['idvehiculo'] }}">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        No hay Vehículos registrados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
