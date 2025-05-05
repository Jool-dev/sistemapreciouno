<div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>SKU</th>
            <th>Estado</th>
            <th>Fecha de registro</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @forelse($data as $productos)
            <tr>
                <td><strong>{{ $productos['idproducto'] }}</strong></td>
                <td><strong>{{ $productos['nombre'] }}</strong></td>
                <td><strong>{{ $productos['sku'] }}</strong></td>
                <td><strong>{{ $productos['estado'] }}</strong></td>
                <td><strong>{{ $productos['fecharegistro'] }}</strong></td>
                <td>
                    <a href="#" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i> Editar</a>
                    <a href="#" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Eliminar</a>
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
