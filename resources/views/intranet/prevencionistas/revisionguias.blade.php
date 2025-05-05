@extends('intranet.prevencionistas.prevencionista')
@section('title','Revision de Guías de Carga')

@section('content')
    <div class="container-fluid py-2">
        <!-- Título -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Revision de Guías de Carga</h3>
            <div>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAprobarTodo">
                    Aprobar Todo
                </button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalRechazarTodo">
                    Rechazar Todo
                </button>
            </div>
        </div>

        <!-- Filtros -->
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="filtroFecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="filtroFecha">
            </div>
            <div class="col-md-3">
                <label for="filtroEstado" class="form-label">Estado</label>
                <select class="form-select" id="filtroEstado">
                    <option value="">Todos</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="aprobado">Aprobado</option>
                    <option value="rechazado">Rechazado</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="filtroGuia" class="form-label">N° Guía</label>
                <input type="text" class="form-control" id="filtroGuia" placeholder="Buscar por guía...">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button class="btn btn-primary w-100">Filtrar</button>
            </div>
        </div>

        <!-- Tabla de guías pendientes -->
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                        <tr>
                            <th>N° Guía</th>
                            <th>Fecha</th>
                            <th>Origen</th>
                            <th>Destino</th>
                            <th>Transportista</th>
                            <th>Productos</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
