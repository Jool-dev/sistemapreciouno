@extends('intranet.prevencionistas.prevencionista')
@section('title','Guiasderemision')

@section('content')
    <div class="container-fluid py-4">
        <!-- Encabezado -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">Guías de Remisión</h2>
            <a href="{{ route('vistaaddguiaremision') }}" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#idmodalguiasremision">
                <i class="fas fa-plus-circle me-2"></i> Nueva Guía
            </a>
        </div>

        <!-- Filtros y búsqueda -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3 align-items-center">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control border-start-0" placeholder="Buscar por número, producto, cliente...">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-filter me-1"></i> Filtrar
                            </button>
                        </div>
                    </div>

                    <div class="col-md-6 text-md-end">
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

        <!-- Tabla de guías -->
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Listado de Guías</h5>
            </div>

            <div class="card-body p-0">
                @livewire('guias-remision.guias-remision')
            </div>

            <div class="card-footer bg-white py-3 d-flex justify-content-between align-items-center">
                <small class="text-muted">Mostrando 1 a 10 de 25 registros</small>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Anterior</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">Siguiente</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
