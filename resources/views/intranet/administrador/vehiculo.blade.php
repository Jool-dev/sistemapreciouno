@extends('intranet/layout')
@section('title', 'Vehículos')
@section('subtitle', 'Gestión de la flota vehicular')

@section('header-actions')
    <button type="button" class="btn btn-primary" id="btnnuevovehiculo">
        <i class="fa-solid fa-plus me-2"></i>
        Nuevo Vehículo
    </button>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Filtros y búsqueda -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-3 align-items-end">
                    <!-- Campo de búsqueda -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Buscar Vehículos</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Buscar por placa o código..."
                                wire:model.live.debounce.500ms="search" aria-label="Buscar vehículos">
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

                    <!-- Filtro por estado -->
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Estado</label>
                        <select class="form-select">
                            <option value="">Todos los estados</option>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                            <option value="Mantenimiento">En Mantenimiento</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estadísticas rápidas -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card border-success">
                    <div class="card-body text-center">
                        <i class="fas fa-truck text-success fa-2x mb-2"></i>
                        <h4 class="text-success mb-1">24</h4>
                        <small class="text-muted">Vehículos Activos</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-warning">
                    <div class="card-body text-center">
                        <i class="fas fa-tools text-warning fa-2x mb-2"></i>
                        <h4 class="text-warning mb-1">3</h4>
                        <small class="text-muted">En Mantenimiento</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-info">
                    <div class="card-body text-center">
                        <i class="fas fa-route text-info fa-2x mb-2"></i>
                        <h4 class="text-info mb-1">18</h4>
                        <small class="text-muted">En Ruta</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-danger">
                    <div class="card-body text-center">
                        <i class="fas fa-exclamation-triangle text-danger fa-2x mb-2"></i>
                        <h4 class="text-danger mb-1">1</h4>
                        <small class="text-muted">Fuera de Servicio</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de vehículos -->
        <div class="card">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-semibold">
                        <i class="fas fa-truck me-2 text-primary"></i>
                        Lista de Vehículos
                    </h5>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-success btn-sm">
                            <i class="fas fa-file-excel me-1"></i>Exportar
                        </button>
                        <button class="btn btn-outline-info btn-sm">
                            <i class="fas fa-map-marked-alt me-1"></i>Ver en Mapa
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                @livewire('vehiculo.vechiculo')
            </div>
        </div>
    </div>

    <!-- Modal para agregar/editar vehículo -->
    <div class="modal fade" id="idmodalvehiculo" tabindex="-1" aria-labelledby="idlabeltitlemodalvehiculo" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="idlabeltitlemodalvehiculo">
                        <i class="fas fa-truck me-2"></i>
                        Nuevo Vehículo
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="idformvechiculo" class="needs-validation" novalidate>
                        @csrf
                        <input type="hidden" id="idvehiculo" name="idvehiculo" value="">
                        
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="placa" class="form-label fw-semibold">
                                    <i class="fas fa-id-card me-1"></i>
                                    Placa Principal
                                </label>
                                <input type="text" class="form-control text-uppercase" id="idtxtplaca" name="placa" 
                                       placeholder="Ej: ABC-123" required maxlength="8">
                                <div class="invalid-feedback">
                                    Por favor, ingrese la placa del vehículo.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="placasecundaria" class="form-label fw-semibold">
                                    <i class="fas fa-id-card-alt me-1"></i>
                                    Placa Secundaria / Remolque
                                </label>
                                <input type="text" class="form-control text-uppercase" id="idtxtplacasecundaria" 
                                       name="placasecundaria" placeholder="Ej: MSKU869736-6" required>
                                <div class="invalid-feedback">
                                    Por favor, ingrese la placa secundaria.
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Información:</strong> Las placas se convertirán automáticamente a mayúsculas.
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancelar
                    </button>
                    <button type="submit" form="idformvechiculo" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Guardar Vehículo
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Convertir a mayúsculas automáticamente
    document.getElementById('idtxtplaca').addEventListener('input', function() {
        this.value = this.value.toUpperCase();
    });
    
    document.getElementById('idtxtplacasecundaria').addEventListener('input', function() {
        this.value = this.value.toUpperCase();
    });

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
</script>
@endsection