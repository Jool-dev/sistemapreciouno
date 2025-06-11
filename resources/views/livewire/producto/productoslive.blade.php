<div class="table-container-sticky">
    <table class="table table-bordered">
        <thead class="table-dark sticky-top">
        <tr>
            <th wire:click="sortBy('codigoproducto')" style="cursor: pointer;" class="text-center align-middle">
                Código Producto
                @if ($sortField === 'codigoproducto')
                    <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                @endif
            </th>
            <th wire:click="sortBy('nombre')" style="cursor: pointer;" class="text-center align-middle">
                Nombre Del Producto
                @if ($sortField === 'nombre')
                    <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                @endif
            </th>
            <th class="text-center align-middle">Tipo Cod Producto</th>
            <th wire:click="sortBy('tipoinventario')" style="cursor: pointer;" class="text-center align-middle">
                Tipo Inventario
                @if ($sortField === 'tipoinventario')
                    <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                @endif
            </th>
            <th class="text-center align-middle">Estado</th>
            <th wire:click="sortBy('fecharegistro')" style="cursor: pointer;" class="text-center align-middle">
                Fecha de registro
                @if ($sortField === 'fecharegistro')
                    <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                @endif
            </th>
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
                    <button type="button" class="btn btn-sm btn-warning btn-editarproducto"
                            title="Editar" data-bs-toggle="tooltip">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger btn-eliminarproducto"
                            data-id="{{ $producto->idproducto }}"
                            title="Eliminar" data-bs-toggle="tooltip">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center text-muted py-4">
                    @if ($search)
                        No se encontraron productos para "{{ $search }}"
                    @else
                        No hay productos registrados
                    @endif
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <!-- Paginación -->
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
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>
@endpush
