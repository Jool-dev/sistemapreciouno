@extends('intranet/layout')
@section('title', 'Conductores')
@section('subtitle', 'Gestión del personal de conducción')

@section('header-actions')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#idmodalConductoress">
        <i class="fa-solid fa-plus me-2"></i>
        Nuevo Conductor
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
                        <label class="form-label fw-semibold">Buscar Conductores</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Buscar por nombre o DNI..."
                                wire:model.live.debounce.500ms="search" aria-label="Buscar conductores">
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

                    <!-- Filtro por empresa -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Empresa Transportista</label>
                        <select class="form-select">
                            <option value="">Todas las empresas</option>
                            @forelse($transportes as $transporte)
                                <option value="{{ $transporte['idtransportista'] }}">
                                    {{ $transporte['nombre_razonsocial'] }}
                                </option>
                            @empty
                                <option value="" disabled>No hay empresas disponibles</option>
                            @endforelse
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
                        <i class="fas fa-user-check text-success fa-2x mb-2"></i>
                        <h4 class="text-success mb-1">45</h4>
                        <small class="text-muted">Conductores Activos</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-info">
                    <div class="card-body text-center">
                        <i class="fas fa-route text-info fa-2x mb-2"></i>
                        <h4 class="text-info mb-1">28</h4>
                        <small class="text-muted">En Ruta</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-warning">
                    <div class="card-body text-center">
                        <i class="fas fa-clock text-warning fa-2x mb-2"></i>
                        <h4 class="text-warning mb-1">12</h4>
                        <small class="text-muted">Disponibles</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-secondary">
                    <div class="card-body text-center">
                        <i class="fas fa-user-times text-secondary fa-2x mb-2"></i>
                        <h4 class="text-secondary mb-1">5</h4>
                        <small class="text-muted">Descanso</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de conductores -->
        <div class="card">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-semibold">
                        <i class="fas fa-users me-2 text-primary"></i>
                        Lista de Conductores
                    </h5>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-success btn-sm">
                            <i class="fas fa-file-excel me-1"></i>Exportar
                        </button>
                        <button class="btn btn-outline-info btn-sm">
                            <i class="fas fa-id-card me-1"></i>Licencias
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                @livewire('conductoress.conductoress')
            </div>
        </div>
    </div>

    <!-- Modal para agregar/editar conductor -->
    <div class="modal fade" id="idmodalConductoress" tabindex="-1" aria-labelledby="modalConductorLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalConductorLabel">
                        <i class="fas fa-user-plus me-2"></i>
                        Nuevo Conductor
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="idformConductores" class="needs-validation" novalidate>
                        @csrf
                        <input type="hidden" id="idconductor" name="idconductor" value="">
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label fw-semibold">
                                    <i class="fas fa-user me-1"></i>
                                    Nombre Completo
                                </label>
                                <input type="text" class="form-control" id="idtxtnombre" name="nombre" required>
                                <div class="invalid-feedback">
                                    Por favor, ingrese el nombre del conductor.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="dni" class="form-label fw-semibold">
                                    <i class="fas fa-id-card me-1"></i>
                                    DNI
                                </label>
                                <input type="text" class="form-control" id="idtxtdni" name="dni" 
                                       pattern="[0-9]{8}" maxlength="8" required>
                                <div class="invalid-feedback">
                                    Por favor, ingrese un DNI válido (8 dígitos).
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="idtransporte" class="form-label fw-semibold">
                                    <i class="fas fa-building me-1"></i>
                                    Empresa Transportista
                                </label>
                                <select class="form-select" id="idselecttransporte" name="idtransporte" required>
                                    <option value="">Seleccione una empresa...</option>
                                    @forelse($transportes as $transporte)
                                        <option value="{{ $transporte['idtransportista'] }}">
                                            {{ $transporte['ruc_transportista'] }} - {{ $transporte['nombre_razonsocial'] }}
                                        </option>
                                    @empty
                                        <option value="" disabled>No hay empresas disponibles</option>
                                    @endforelse
                                </select>
                                <div class="invalid-feedback">
                                    Por favor, seleccione una empresa transportista.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="idvehiculo" class="form-label fw-semibold">
                                    <i class="fas fa-truck me-1"></i>
                                    Vehículo Asignado
                                </label>
                                <select class="form-select" id="idselectvehiculo" name="idvehiculo" required>
                                    <option value="">Seleccione un vehículo...</option>
                                    @forelse($vehiculos as $vehiculo)
                                        <option value="{{ $vehiculo['idvehiculo'] }}">
                                            {{ $vehiculo['placa'] }} - {{ $vehiculo['placasecundaria'] }}
                                        </option>
                                    @empty
                                        <option value="" disabled>No hay vehículos disponibles</option>
                                    @endforelse
                                </select>
                                <div class="invalid-feedback">
                                    Por favor, seleccione un vehículo.
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Información:</strong> El conductor será asignado automáticamente al vehículo seleccionado.
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancelar
                    </button>
                    <button type="submit" form="idformConductores" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Guardar Conductor
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Validar solo números en DNI
    document.getElementById('idtxtdni').addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
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