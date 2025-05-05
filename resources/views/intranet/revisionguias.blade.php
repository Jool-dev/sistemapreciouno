@extends('intranet/layout')
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
                        @foreach($guias as $guia)
                            <tr>
                                <td>{{ $guia->numero_guia }}</td>
                                <td>{{ $guia->fecha_emision }}</td>
                                <td>{{ $guia->origen }}</td>
                                <td>{{ $guia->destino }}</td>
                                <td>{{ $guia->transportista }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#modalProductos{{ $guia->id }}">
                                        Ver ({{ $guia->productos->count() }})
                                    </button>
                                </td>
                                <td>
                                    @if($guia->estado == 'pendiente')
                                        <span class="badge bg-warning">Pendiente</span>
                                    @elseif($guia->estado == 'aprobado')
                                        <span class="badge bg-success">Aprobado</span>
                                    @else
                                        <span class="badge bg-danger">Rechazado</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                            data-bs-target="#modalValidar{{ $guia->id }}">
                                        Validar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para validar guía individual -->
    @foreach($guias as $guia)
        <div class="modal fade" id="modalValidar{{ $guia->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Validar Guía N° {{ $guia->numero_guia }}</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('guias.validar', $guia->id) }}" method="POST">
                            @csrf
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr class="table-secondary">
                                        <th>SKU</th>
                                        <th>Producto</th>
                                        <th>Cantidad Enviada</th>
                                        <th>Cantidad Recibida</th>
                                        <th>Estado</th>
                                        <th>Observaciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($guia->productos as $producto)
                                        <tr>
                                            <td>{{ $producto->sku }}</td>
                                            <td>{{ $producto->nombre }}</td>
                                            <td>{{ $producto->pivot->cantidad }}</td>
                                            <td>
                                                <input type="number" name="productos[{{ $producto->id }}][cantidad_recibida]"
                                                       class="form-control form-control-sm"
                                                       min="0" max="{{ $producto->pivot->cantidad * 1.1 }}"
                                                       value="{{ $producto->pivot->cantidad }}">
                                            </td>
                                            <td>
                                                <select name="productos[{{ $producto->id }}][estado]" class="form-select form-select-sm">
                                                    <option value="bueno">Bueno</option>
                                                    <option value="regular">Regular</option>
                                                    <option value="danado">Dañado</option>
                                                    <option value="faltante">Faltante</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="productos[{{ $producto->id }}][observaciones]"
                                                       class="form-control form-control-sm" placeholder="Observaciones...">
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mb-3">
                                <label for="observacionGeneral{{ $guia->id }}" class="form-label">Observación General</label>
                                <textarea class="form-control" id="observacionGeneral{{ $guia->id }}"
                                          name="observacion_general" rows="2"></textarea>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="submit" name="accion" value="rechazar" class="btn btn-danger">
                                    Rechazar Guía
                                </button>
                                <div>
                                    <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" name="accion" value="aprobar" class="btn btn-success">
                                        Aprobar Guía
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para ver productos -->
        <div class="modal fade" id="modalProductos{{ $guia->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title">Productos - Guía N° {{ $guia->numero_guia }}</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th>SKU</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($guia->productos as $producto)
                                    <tr>
                                        <td>{{ $producto->sku }}</td>
                                        <td>{{ $producto->nombre }}</td>
                                        <td>{{ $producto->pivot->cantidad }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modales para acciones masivas -->
    @include('guias.modales-aprobar-rechazar-todo')

@endsection
