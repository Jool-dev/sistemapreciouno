<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="table-dark">
        <tr>
            <th class="text-center align-middle">#</th>
            <th class="text-center align-middle">DNI</th>
            <th class="text-center align-middle">Estado</th>
            <th class="text-center align-middle">Idtransportista</th>
            <th class="text-center align-middle">Idvehiculo</th>
            <th class="text-center align-middle">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @forelse($data as $conductor)
            <tr>
                <td class="text-center align-middle"><strong>{{ $conductor['idconductor'] }}</strong></td>
                <td class="text-center align-middle"><strong>{{ $conductor['dni'] }}</strong></td>
                <td class="text-center align-middle"><strong>{{ $conductor['estado'] }}</strong></td>
                <td class="text-center align-middle"><strong>{{ $conductor['idtransportista'] }}</strong></td>
                <td class="text-center align-middle"><strong>{{ $conductor['idvehiculo'] }}</strong></td>
                <td class="text-center align-middle">
                    <button type="button" class="btn btn-sm btn-warning btn-editarproducto">
                        <i class="bi bi-pencil-square"></i> Editar
                    </button>
                    <button type="button" class="btn btn-sm btn-danger btn-eliminarproducto">
                        {{--                            data-id="{{ $productos['idproducto'] }}">--}}
                        <i class="bi bi-trash"></i> Eliminar
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center text-muted py-4">
                    No hay conductores registrados.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
