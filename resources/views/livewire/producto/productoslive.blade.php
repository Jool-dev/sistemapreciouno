<div class="table-container-sticky">
    <table class="table table-bordered">
        <thead class="table-dark sticky-top">
        <tr>
            <th class="text-center align-middle">Codigo Producto</th>
            <th class="text-center align-middle">Nombre Del Producto</th>
            <th class="text-center align-middle">Tipo Cod Producto</th>
            <th class="text-center align-middle">Tipo Inventario</th>
            <th class="text-center align-middle">Estado</th>
            <th class="text-center align-middle">Fecha de Registro</th>
            <th class="text-center align-middle">Acciones</th>
        </tr>
        </thead>
        <tbody class="scrollable-tbody">
        @forelse($data as $producto)
            <tr>
                <td class="text-center align-middle"><strong>{{ $producto->codigoproducto }}</strong></td>
                <td class="text-center align-middle"><strong>{{ $producto->nombre }}</strong></td>
                <td class="text-center align-middle"><strong>{{ $producto->tipocodproducto }}</strong></td>
                <td class="text-center align-middle"><strong>{{ $producto->tipoinventario }}</strong></td>
                <td class="text-center align-middle">
                    <span class="badge bg-success">{{ $producto->estado }}</span>
                </td>
                <td class="text-center align-middle">{{ $producto->fecharegistro }}</td>
                <td class="text-center align-middle">
                    <button type="button" class="btn btn-sm btn-warning btn-editarproducto">
                        <i class="bi bi-pencil-square"></i> Editar
                    </button>
                    <button type="button" class="btn btn-sm btn-danger btn-eliminarproducto">
                        <i class="bi bi-trash"></i> Eliminar
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center text-muted py-4">
                    @if($search)
                        No se encontraron productos para "{{ $search }}"
                    @else
                        No hay productos registrados
                    @endif
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
    @if($data->total() > 0)
        <!-- Footer fijo -->
        <div class="sticky-footer d-flex justify-content-between align-items-center px-3 py-2 bg-white border-top">
            <div class="text-muted">
                Mostrando {{ $data->firstItem() }} a {{ $data->lastItem() }} de {{ $data->total() }} registros
            </div>
            <div>
                {{ $data->links() }}
            </div>
        </div>
    @endif
</div>
