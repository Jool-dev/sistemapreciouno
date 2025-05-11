@extends('intranet.prevencionistas.prevencionista')
@section('title','Guiasderemision')

@section('content')
    <div class="container-fluid py-4">
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
        <div class="card shadow-sm mb-4">
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

        <!-- Tarjeta contenedora de la tabla -->
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom-0 py-3">
                <h5 class="mb-0">Listado de Guías</h5>
            </div>

            <div class="card-body p-0">
                <!-- Tabla Livewire -->
                @livewire('guias-remision.guias-remision')
            </div>

            <div class="card-footer bg-white border-top-0 py-3 d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    Mostrando 1 a 10 de 25 registros
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Anterior</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Siguiente</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
