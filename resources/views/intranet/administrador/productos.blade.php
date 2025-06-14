@extends('intranet/layout')
@section('title', 'Productos')
@section('subtitle', 'Gestión del catálogo de productos')

@section('header-actions')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#idmodalProductos">
        <i class="fa-solid fa-plus me-2"></i>
        Nuevo Producto
    </button>
@endsection

@section('content')
    <div class="container-fluid" data-filter-container id="filter-container">
        <!-- Filtros y búsqueda -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-3 align-items-end">
                    <!-- Campo de búsqueda -->
                    <div class="col-md-5">
                        <label class="form-label fw-semibold">Buscar Productos</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Buscar por nombre o código..."
                                data-filter="search" aria-label="Buscar productos">
                        </div>
                    </div>
                    
                    <!-- Selector de items por página -->
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Mostrar</label>
                        <div class="input-group">
                            <select class="form-select" wire:model.live="perPage" aria-label="Items por página">
                                <option value="10">10 por página</option>
                                <option value="25">25 por página</option>
                                <option value="50">50 por página</option>
                                <option value="100">100 por página</option>
                            </select>
                            <span class="input-group-text">
                                <i class="fas fa-list-ol"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Filtro por tipo -->
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Tipo de Inventario</label>
                        <select class="form-select" data-filter="tipo">
                            <option value="">Todos los tipos</option>
                            <option value="Tottus">Tottus</option>
                            <option value="Tottus Oriente">Tottus Oriente</option>
                        </select>
                    </div>

                    <!-- Botón de filtros avanzados -->
                    <div class="col-md-1">
                        <button class="btn btn-outline-secondary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#filtrosAvanzados">
                            <i class="fas fa-filter"></i>
                        </button>
                    </div>
                </div>

                <!-- Filtros avanzados (colapsable) -->
                <div class="collapse mt-3" id="filtrosAvanzados">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Estado</label>
                            <select class="form-select" data-filter="estado">
                                <option value="">Todos los estados</option>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Fecha desde</label>
                            <input type="date" class="form-control" data-filter="fechaDesde">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Fecha hasta</label>
                            <input type="date" class="form-control" data-filter="fechaHasta">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button class="btn btn-outline-primary me-2" data-action="apply-filters">
                                <i class="fas fa-search me-1"></i>Aplicar
                            </button>
                            <button class="btn btn-outline-secondary" data-action="clear-filters">
                                <i class="fas fa-times me-1"></i>Limpiar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estadísticas rápidas -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card border-primary">
                    <div class="card-body text-center">
                        <i class="fas fa-boxes text-primary fa-2x mb-2"></i>
                        <h4 class="text-primary mb-1" data-counter="150">150</h4>
                        <small class="text-muted">Total Productos</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-success">
                    <div class="card-body text-center">
                        <i class="fas fa-check-circle text-success fa-2x mb-2"></i>
                        <h4 class="text-success mb-1" data-counter="142">142</h4>
                        <small class="text-muted">Productos Activos</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-warning">
                    <div class="card-body text-center">
                        <i class="fas fa-exclamation-triangle text-warning fa-2x mb-2"></i>
                        <h4 class="text-warning mb-1" data-counter="8">8</h4>
                        <small class="text-muted">Stock Bajo</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-info">
                    <div class="card-body text-center">
                        <i class="fas fa-plus-circle text-info fa-2x mb-2"></i>
                        <h4 class="text-info mb-1" data-counter="12">12</h4>
                        <small class="text-muted">Nuevos Este Mes</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Acciones masivas (oculto por defecto) -->
        <div data-bulk-actions style="display: none;" class="alert alert-info mb-3">
            <div class="d-flex justify-content-between align-items-center">
                <span>
                    <i class="fas fa-check-square me-2"></i>
                    <span data-selected-count>0</span> productos seleccionados
                </span>
                <div>
                    <button class="btn btn-sm btn-outline-danger me-2" data-bulk-action="delete" data-confirm="¿Eliminar los productos seleccionados?">
                        <i class="fas fa-trash me-1"></i>Eliminar
                    </button>
                    <button class="btn btn-sm btn-outline-primary" data-bulk-action="export">
                        <i class="fas fa-download me-1"></i>Exportar
                    </button>
                </div>
            </div>
        </div>

        <!-- Tabla de productos -->
        <div class="card">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-semibold">
                        <i class="fas fa-boxes me-2 text-primary"></i>
                        Lista de Productos
                        <span class="badge bg-secondary ms-2" data-results-count>Cargando...</span>
                    </h5>
                    <div class="d-flex gap-2">
                        <!-- Exportación -->
                        <div data-export-actions class="btn-group" role="group">
                            <button class="btn btn-outline-success btn-sm" data-export="excel">
                                <i class="fas fa-file-excel me-1"></i>Excel
                            </button>
                            <button class="btn btn-outline-danger btn-sm" data-export="pdf">
                                <i class="fas fa-file-pdf me-1"></i>PDF
                            </button>
                            <button class="btn btn-outline-info btn-sm" data-export="csv">
                                <i class="fas fa-file-csv me-1"></i>CSV
                            </button>
                        </div>
                        
                        <!-- Toggle de columnas -->
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-columns me-1"></i>Columnas
                            </button>
                            <ul class="dropdown-menu" data-column-toggle>
                                <li>
                                    <label class="dropdown-item">
                                        <input type="checkbox" class="form-check-input me-2" checked data-column="0">
                                        Selección
                                    </label>
                                </li>
                                <li>
                                    <label class="dropdown-item">
                                        <input type="checkbox" class="form-check-input me-2" checked data-column="1">
                                        Código
                                    </label>
                                </li>
                                <li>
                                    <label class="dropdown-item">
                                        <input type="checkbox" class="form-check-input me-2" checked data-column="2">
                                        Nombre
                                    </label>
                                </li>
                                <li>
                                    <label class="dropdown-item">
                                        <input type="checkbox" class="form-check-input me-2" checked data-column="3">
                                        Tipo
                                    </label>
                                </li>
                                <li>
                                    <label class="dropdown-item">
                                        <input type="checkbox" class="form-check-input me-2" checked data-column="4">
                                        Inventario
                                    </label>
                                </li>
                                <li>
                                    <label class="dropdown-item">
                                        <input type="checkbox" class="form-check-input me-2" checked data-column="5">
                                        Estado
                                    </label>
                                </li>
                                <li>
                                    <label class="dropdown-item">
                                        <input type="checkbox" class="form-check-input me-2" checked data-column="6">
                                        Fecha
                                    </label>
                                </li>
                                <li>
                                    <label class="dropdown-item">
                                        <input type="checkbox" class="form-check-input me-2" checked data-column="7">
                                        Acciones
                                    </label>
                                </li>
                            </ul>
                        </div>
                        
                        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#idmodalProductos">
                            <i class="fas fa-upload me-1"></i>Importar
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="enable-scroll">
                    @livewire('producto.productoslive')
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para agregar/editar producto -->
    <div class="modal fade" id="idmodalProductos" tabindex="-1" aria-labelledby="idlabeltitlemodalproductos" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="idlabeltitlemodalproductos">
                        <i class="fas fa-plus-circle me-2"></i>
                        Agregar Nuevo Producto
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="idformproducto" class="needs-validation" data-validate novalidate>
                        @csrf
                        <input type="hidden" id="idproducto" name="idproducto" value="">
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="codigoproducto" class="form-label fw-semibold">
                                    <i class="fas fa-barcode me-1"></i>
                                    Código del Producto
                                </label>
                                <input type="text" class="form-control" id="idtxtcodigoproducto" name="codigoproducto" required
                                       data-bs-toggle="tooltip" title="Ingrese el código único del producto">
                                <div class="invalid-feedback">
                                    Por favor, ingrese el código del producto.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="tipoinventario" class="form-label fw-semibold">
                                    <i class="fas fa-tags me-1"></i>
                                    Tipo de Inventario
                                </label>
                                <select class="form-select" id="idselectinventario" name="tipoinventario" required>
                                    <option value="">Seleccione un tipo...</option>
                                    <option value="Tottus Oriente">Tottus Oriente</option>
                                    <option value="Tottus">Tottus</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor, seleccione un tipo de inventario.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="nombre" class="form-label fw-semibold">
                                    <i class="fas fa-tag me-1"></i>
                                    Nombre del Producto
                                </label>
                                <input type="text" class="form-control" id="idtxtnombre" name="nombre" required
                                       data-bs-toggle="tooltip" title="Ingrese el nombre descriptivo del producto">
                                <div class="invalid-feedback">
                                    Por favor, ingrese el nombre del producto.
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Información:</strong> La fecha de registro se asignará automáticamente al guardar el producto.
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancelar
                    </button>
                    <button type="submit" form="idformproducto" class="btn btn-primary" data-loading="Guardando...">
                        <i class="fas fa-save me-1"></i>Guardar Producto
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Limpiar formulario al cerrar modal
        document.getElementById('idmodalProductos').addEventListener('hidden.bs.modal', function () {
            const form = document.getElementById('idformproducto');
            form.reset();
            form.classList.remove('was-validated');
            
            // Limpiar validaciones personalizadas
            const inputs = form.querySelectorAll('.is-valid, .is-invalid');
            inputs.forEach(input => {
                input.classList.remove('is-valid', 'is-invalid');
            });
            
            const feedbacks = form.querySelectorAll('.invalid-feedback, .valid-feedback');
            feedbacks.forEach(feedback => {
                if (!feedback.textContent.includes('Por favor')) {
                    feedback.remove();
                }
            });
        });

        // Formatear código de producto en tiempo real
        document.getElementById('idtxtcodigoproducto').addEventListener('input', function() {
            // Solo permitir números
            this.value = this.value.replace(/[^0-9]/g, '');
            
            // Limitar a 20 caracteres
            if (this.value.length > 20) {
                this.value = this.value.substring(0, 20);
            }
        });

        // Capitalizar nombre del producto
        document.getElementById('idtxtnombre').addEventListener('input', function() {
            // Capitalizar primera letra de cada palabra
            this.value = this.value.replace(/\b\w/g, l => l.toUpperCase());
        });

        // Notificaciones de éxito/error para acciones
        document.addEventListener('notification:action', function(e) {
            const { action, notification } = e.detail;
            
            switch(action) {
                case 'view':
                    showInfo('Redirigiendo a detalle del producto...');
                    break;
                case 'print':
                    showInfo('Preparando impresión...');
                    window.print();
                    break;
                case 'refresh':
                    location.reload();
                    break;
            }
        });
    });
</script>
@endsection