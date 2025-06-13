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
    <div class="container-fluid">
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
                                wire:model.live.debounce.500ms="search" aria-label="Buscar productos">
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
                        <select class="form-select">
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
                            <select class="form-select">
                                <option value="">Todos los estados</option>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Fecha desde</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Fecha hasta</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button class="btn btn-outline-primary me-2">
                                <i class="fas fa-search me-1"></i>Aplicar
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i>Limpiar
                            </button>
                        </div>
                    </div>
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
                    </h5>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-success btn-sm">
                            <i class="fas fa-file-excel me-1"></i>Exportar
                        </button>
                        <button class="btn btn-outline-primary btn-sm">
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
                    <form id="idformproducto" class="needs-validation" novalidate>
                        @csrf
                        <input type="hidden" id="idproducto" name="idproducto" value="">
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="codigoproducto" class="form-label fw-semibold">
                                    <i class="fas fa-barcode me-1"></i>
                                    Código del Producto
                                </label>
                                <input type="text" class="form-control" id="idtxtcodigoproducto" name="codigoproducto" required>
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
                                <input type="text" class="form-control" id="idtxtnombre" name="nombre" required>
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
                    <button type="submit" form="idformproducto" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Guardar Producto
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Validación del formulario
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    // Limpiar formulario al cerrar modal
    document.getElementById('idmodalProductos').addEventListener('hidden.bs.modal', function () {
        document.getElementById('idformproducto').reset();
        document.getElementById('idformproducto').classList.remove('was-validated');
    });
</script>
@endsection