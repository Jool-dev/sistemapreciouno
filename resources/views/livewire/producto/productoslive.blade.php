<div class="table-container-sticky">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-dark sticky-top">
            <tr>
                <th wire:click="sortBy('codigoproducto')" style="cursor: pointer;" class="text-center">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-barcode me-2"></i>
                        Código
                        @if ($sortField === 'codigoproducto')
                            <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                        @endif
                    </div>
                </th>
                <th wire:click="sortBy('nombre')" style="cursor: pointer;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-tag me-2"></i>
                        Nombre del Producto
                        @if ($sortField === 'nombre')
                            <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                        @endif
                    </div>
                </th>
                <th class="text-center">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-cog me-2"></i>
                        Tipo Código
                    </div>
                </th>
                <th wire:click="sortBy('tipoinventario')" style="cursor: pointer;" class="text-center">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-warehouse me-2"></i>
                        Inventario
                        @if ($sortField === 'tipoinventario')
                            <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                        @endif
                    </div>
                </th>
                <th class="text-center">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-info-circle me-2"></i>
                        Estado
                    </div>
                </th>
                <th wire:click="sortBy('fecharegistro')" style="cursor: pointer;" class="text-center">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-calendar me-2"></i>
                        Fecha Registro
                        @if ($sortField === 'fecharegistro')
                            <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                        @endif
                    </div>
                </th>
                <th class="text-center">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-tools me-2"></i>
                        Acciones
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($data as $producto)
                <tr class="border-bottom">
                    <td class="text-center">
                        <span class="badge bg-secondary fs-6">{{ $producto->codigoproducto }}</span>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                                <i class="fas fa-box text-primary"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-semibold">{{ $producto->nombre }}</h6>
                                <small class="text-muted">ID: {{ $producto->idproducto }}</small>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <span class="badge bg-info bg-opacity-10 text-info">{{ $producto->tipocodproducto }}</span>
                    </td>
                    <td class="text-center">
                        <span class="badge bg-{{ $producto->tipoinventario === 'Tottus' ? 'primary' : 'success' }}">
                            {{ $producto->tipoinventario }}
                        </span>
                    </td>
                    <td class="text-center">
                        <span class="badge bg-success">
                            <i class="fas fa-check-circle me-1"></i>
                            {{ $producto->estado }}
                        </span>
                    </td>
                    <td class="text-center">
                        <small class="text-muted">
                            <i class="fas fa-calendar-alt me-1"></i>
                            {{ \Carbon\Carbon::parse($producto->fecharegistro)->format('d/m/Y') }}
                        </small>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button type="button" class="btn btn-outline-warning btn-sm btn-editarproducto"
                                    title="Editar producto" data-bs-toggle="tooltip">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-sm btn-eliminarproducto"
                                    data-id="{{ $producto->idproducto }}"
                                    title="Eliminar producto" data-bs-toggle="tooltip">
                                <i class="fas fa-trash"></i>
                            </button>
                            <button type="button" class="btn btn-outline-info btn-sm"
                                    title="Ver detalles" data-bs-toggle="tooltip">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-5">
                        <div class="d-flex flex-column align-items-center">
                            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">
                                @if ($search)
                                    No se encontraron productos para "{{ $search }}"
                                @else
                                    No hay productos registrados
                                @endif
                            </h5>
                            @if (!$search)
                                <p class="text-muted">Comience agregando su primer producto</p>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#idmodalProductos">
                                    <i class="fas fa-plus me-1"></i>Agregar Producto
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Paginación mejorada -->
    @if($data->total() > 0)
        <div class="sticky-footer bg-white border-top">
            <div class="d-flex justify-content-between align-items-center px-4 py-3">
                <div class="text-muted">
                    <i class="fas fa-info-circle me-1"></i>
                    Mostrando <strong>{{ $data->firstItem() }}</strong> a <strong>{{ $data->lastItem() }}</strong> 
                    de <strong>{{ $data->total() }}</strong> productos
                </div>
                <div>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inicializar tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Animación de hover en filas
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(5px)';
                this.style.transition = 'transform 0.2s ease';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
            });
        });
    });
</script>

<style>
    .avatar-sm {
        width: 40px;
        height: 40px;
    }
    
    .table tbody tr:hover {
        background-color: rgba(var(--bs-primary-rgb), 0.05);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .action-buttons .btn {
        margin: 0 2px;
        transition: all 0.2s ease;
    }
    
    .action-buttons .btn:hover {
        transform: translateY(-1px);
    }
</style>
@endpush