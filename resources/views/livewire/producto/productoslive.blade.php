<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="table-dark">
        <tr>
            <th class="text-center align-middle">#</th>
            <th class="text-center align-middle">Codigo Producto</th>
            <th class="text-center align-middle">Nombre Del Producto</th>
            <th class="text-center align-middle">Tipo Cod Producto</th>
            <th class="text-center align-middle">Tipo Inventario</th>
            <th class="text-center align-middle">Estado</th>
            <th class="text-center align-middle">Fecha de registro</th>
            <th class="text-center align-middle">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @forelse($data as $productos)
            <tr>
                <td class="text-center align-middle"><strong>{{ $productos['idproducto'] }}</strong></td>
                <td class="text-center align-middle"><strong>{{ $productos['codigoproducto'] }}</strong></td>
                <td class="text-center align-middle"><strong>{{ $productos['nombre'] }}</strong></td>
                <td class="text-center align-middle"><strong>{{ $productos['tipocodproducto'] }}</strong></td>
                <td class="text-center align-middle"><strong>{{ $productos['tipoinventario'] }}</strong></td>
                <td class="text-center align-middle"><strong>{{ $productos['estado'] }}</strong></td>
                <td class="text-center align-middle"><strong>{{ $productos['fecharegistro'] }}</strong></td>
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
                    No hay productos registrados.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
