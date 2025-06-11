<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="table-dark">
        <tr>
            <th wire:click="sortBy('id')" style="cursor: pointer;" class="text-center align-middle">
                #
                @if ($sortField === 'id')
                    <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                @endif
            </th>
            <th wire:click="sortBy('name')" style="cursor: pointer;" class="text-center align-middle">
                Nombre
                @if ($sortField === 'name')
                    <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                @endif
            </th>
            <th wire:click="sortBy('email')" style="cursor: pointer;" class="text-center align-middle">
                Correo Electrónico
                @if ($sortField === 'email')
                    <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                @endif
            </th>
            <th wire:click="sortBy('idrol')" style="cursor: pointer;" class="text-center align-middle">
                Rol
                @if ($sortField === 'idrol')
                    <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                @endif
            </th>
            <th class="text-center align-middle">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @forelse($data as $usuario)
            <tr>
                <td class="text-center align-middle"><strong>{{ $usuario->id }}</strong></td>
                <td class="text-center align-middle"><strong>{{ $usuario->name }}</strong></td>
                <td class="text-center align-middle"><strong>{{ $usuario->email }}</strong></td>
                <td class="text-center align-middle">
                    <span class="badge bg-primary">{{ $usuario->idrol }}</span>
                </td>
                <td class="text-center align-middle">
                    <button type="button" class="btn btn-sm btn-outline-warning btn-editarusuario"
                            title="Editar" data-bs-toggle="tooltip">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-danger btn-eliminarusuario"
                            data-id="{{ $usuario['id'] }}" title="Eliminar" data-bs-toggle="tooltip">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-muted py-4">
                    No hay usuarios registrados.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <!-- Paginación -->
    @if($data->total() > 0)
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
