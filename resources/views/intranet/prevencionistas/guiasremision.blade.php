@extends('intranet.prevencionistas.prevencionista')
@section('title','Guiasderemision')

@section('content')
    <div class="container-fluid py-3">
        <!-- Encabezado con título y botón -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">Guías de Remisión</h2>
            </div>

            <a href="{{route('vistaaddguiaremision')}}" class="btn btn-primary d-flex align-items-center">
                <i class="fas fa-plus-circle me-2"></i>
                Nueva Guía
            </a>
        </div>

        <!-- Panel de búsqueda y filtros -->
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control border-start-0" placeholder="Buscar por número, producto, cliente...">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-filter me-1"></i> Filtrar
                            </button>
                        </div>
                    </div>

                    <div class="col-md-6 d-flex justify-content-end">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-secondary">Hoy</button>
                            <button type="button" class="btn btn-outline-secondary">Semana</button>
                            <button type="button" class="btn btn-outline-secondary active">Mes</button>
                            <button type="button" class="btn btn-outline-secondary">Personalizado</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <!-- Tabla Livewire -->
        @livewire('guias-remision.guias-remision')
    </div>
@endsection
