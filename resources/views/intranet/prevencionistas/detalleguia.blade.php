@extends('intranet.prevencionistas.prevencionista')
@section('title', 'Productos de Guía')

@section('content')
    @vite('resources/css/views/prevencionistas/detalleguia.css')
    <div class="container-fluid py-3">
        <!-- Header con botones -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0 text-primary fw-bold">
                <i class="fas fa-file-invoice me-2"></i>Detalle de Guía # {{ $guia->codigoguia ?? 'N/A' }}<span id="idguia" class="text-dark"></span>
            </h2>
            <div>
                <button class="btn btn-sm btn-outline-danger me-2">
                    <i class="fas fa-times me-1"></i> Cerrar
                </button>
                <button class="btn btn-sm btn-success">
                    <i class="fas fa-print me-1"></i> Imprimir
                </button>
            </div>
        </div>

        <!-- Tarjeta principal -->
        <div class="card border-0 shadow">
            <!-- Encabezado con pestañas -->
            <div class="card-header bg-white p-0 border-0">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="datos-tab" data-bs-toggle="tab" data-bs-target="#datos" type="button" role="tab">
                            <i class="fas fa-info-circle me-1"></i> Datos Generales
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="productos-tab" data-bs-toggle="tab" data-bs-target="#productos" type="button" role="tab">
                            <i class="fas fa-boxes me-1"></i> Productos De La Guia
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="productosval-tab" data-bs-toggle="tab" data-bs-target="#productosval" type="button" role="tab">
                            <i class="fas fa-boxes me-1"></i> Productos Validados
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="documentos-tab" data-bs-toggle="tab" data-bs-target="#documentos" type="button" role="tab">
                            <i class="fas fa-file-alt me-1"></i> Documentos
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Contenido de pestañas -->
            <div class="card-body p-4">
                <div class="tab-content" id="myTabContent">
                    <!-- Pestaña Datos Generales -->
                    <div class="tab-pane fade show active" id="datos" role="tabpanel">
                        <div class="row">
                            <!-- Columna izquierda -->
                            <div class="col-md-6">
                                <div class="info-card bg-light p-3 mb-3 rounded">
                                    <h6 class="fw-bold text-primary mb-3 border-bottom pb-2">
                                        <i class="fas fa-file-signature me-2"></i>Información Principal
                                    </h6>
                                    <div class="row">
                                        <div class="col-6 mb-2">
                                            <span class="d-block text-muted small">N° Guía:</span>
                                            <strong id="detalle-codigoguia">{{ $guia->idguia ?? 'N/A' }}</strong>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <span class="d-block text-muted small">N° TIM:</span>
                                            <strong id="detalle-numerotim">{{ $guia->numerotrasladotim ?? 'N/A' }}</strong>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <span class="d-block text-muted small">Fecha Emisión:</span>
                                            <strong id="detalle-fechaemision">{{ $guia->fechaemision ?? 'N/A' }}</strong>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <span class="d-block text-muted small">Hora Emisión:</span>
                                            <strong id="detalle-horaemision">{{ $guia->horaemision ?? 'N/A' }}</strong>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <span class="d-block text-muted small">Razón Social:</span>
                                            <strong id="detalle-razonsocial">{{ $guia->razonsocialguia ?? 'N/A' }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Columna derecha -->
                            <div class="col-md-6">
                                <div class="info-card bg-light p-3 mb-3 rounded">
                                    <h6 class="fw-bold text-primary mb-3 border-bottom pb-2">
                                        <i class="fas fa-truck-loading me-2"></i>Detalles de Envío
                                    </h6>
                                    <div class="row">
                                        <div class="col-6 mb-2">
                                            <span class="d-block text-muted small">Motivo del traslado:</span>
                                            <strong id="detalle-motivo">{{ $guia->motivotraslado ?? 'N/A' }}</strong>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <span class="d-block text-muted small">Peso Total (kg):</span>
                                            <strong id="detalle-peso">{{ $guia->pesobrutototal ?? 'N/A' }}</strong>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <span class="d-block text-muted small">Volumen (m³):</span>
                                            <strong id="detalle-volumen">{{ $guia->volumenproducto ?? 'N/A' }}</strong>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <span class="d-block text-muted small">N° Bultos:</span>
                                            <strong id="detalle-bultos">{{ $guia->numerobultopallet ?? 'N/A' }}</strong>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <span class="d-block text-muted small">Observaciones:</span>
                                            <strong id="detalle-observaciones">{{ $guia->observaciones ?? 'N/A' }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sección Transporte -->
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="info-card bg-light p-3 rounded">
                                    <h6 class="fw-bold text-primary mb-3 border-bottom pb-2">
                                        <i class="fas fa-user-tie me-2"></i>Conductor
                                    </h6>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar bg-primary text-white rounded-circle me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-user fs-5"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold" id="detalle-conductor">{{ $conductor->nombre ?? 'N/A' }}</h6>
                                            <span class="text-muted small" id="detalle-dni-conductor">DNI: {{ $conductor->dni ?? 'N/A' }}</span><br>
                                            <span class="badge bg-success">{{ $conductor->estado ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-card bg-light p-3 rounded">
                                    <h6 class="fw-bold text-primary mb-3 border-bottom pb-2">
                                        <i class="fas fa-building me-2"></i>Empresa Transportista
                                    </h6>
                                    <div>
                                        <h6 class="mb-1 fw-bold" id="detalle-empresa">{{ $tipoempresa->razonsocial ?? 'N/A' }}</h6>
                                        <span class="text-muted small" id="detalle-ruc-empresa">RUC: {{ $tipoempresa->estado ?? 'N/A' }}</span><br>
                                        <span class="badge bg-info text-dark" id="detalle-modalidad">T{{ $tipoempresa->estado ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Pestaña Productos -->
                    <div class="tab-pane fade" id="productos" role="tabpanel"
                         data-total-productos="{{ count($detalleguia) }}"
                         data-productos="{{ json_encode($detalleguia) }}"
                         data-guia="{{ json_encode($guia) }}">
                        <div class="table-responsive">
                            <table class="table table-hover table-sm">
                                <thead class="table-primary">
                                <tr>
                                    <th width="10%">Código</th>
                                    <th width="40%">Descripción</th>
                                    <th width="15%">Cantidad</th>
                                    <th width="10%">Estado</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($detalleguia as $item)
                                    <tr>
                                        <td>{{ $item->idproducto ?? 'N/A' }}</td>
                                        <td>{{ $item->producto ?? 'Sin descripción' }}</td>
                                        <td class="text-center">{{ number_format($item->cant ?? 0, 2) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $item->estado == 'VALIDADO' ? 'success' : 'warning' }}">
                                                {{ $item->estado ?? 'PENDIENTE' }}
                                            </span>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-3">
                                            <i class="fas fa-box-open me-2"></i> No se encontraron productos en esta guía
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Pestaña Productos Validados -->
                    <div class="tab-pane fade" id="productosval" role="tabpanel">
                        <div class="alert alert-info mb-3">
                            <i class="fas fa-info-circle me-2"></i> Productos validados clasificados por condición
                        </div>

                        <div class="accordion mb-4" id="accordionCondiciones">
                            <!-- Productos Buenos -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingBuenos">
                                    <button class="accordion-button bg-success bg-opacity-10" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBuenos" aria-expanded="true">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        Productos Buenos ({{ count($productosBuenos) }})
                                    </button>
                                </h2>
                                <div id="collapseBuenos" class="accordion-collapse collapse show" aria-labelledby="headingBuenos" data-bs-parent="#accordionCondiciones">
                                    <div class="accordion-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-sm mb-0">
                                                <thead class="table-light">
                                                <tr>
                                                    <th width="10%">Código</th>
                                                    <th width="40%">Descripción</th>
                                                    <th width="15%">Cantidad</th>
                                                    <th width="15%">Unidad</th>
                                                    <th width="20%">Condición</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($productosBuenos as $item)
                                                    <tr>
                                                        <td>{{ $item->idproducto ?? 'N/A' }}</td>
                                                        <td>
                                                            {{ $item->producto ?? 'Sin descripción' }}
                                                            @if(!empty($item->observaciones))
                                                                <small class="text-muted d-block">{{ $item->observaciones }}</small>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">{{ number_format($item->cantidad ?? 0, 2) }}</td>
                                                        <td>{{ $item->unidadmedida ?? 'N/A' }}</td>
                                                        <td>
                                                            <span class="badge bg-success">{{ $item->nombretipocondicion ?? 'VALIDADO' }}</span>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center text-muted py-3">
                                                            <i class="fas fa-box-open me-2"></i> No hay productos en estado Bueno
                                                        </td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Productos Regulares -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingRegulares">
                                    <button class="accordion-button bg-warning bg-opacity-10 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRegulares">
                                        <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                                        Productos Regulares ({{ count($productosRegulares) }})
                                    </button>
                                </h2>
                                <div id="collapseRegulares" class="accordion-collapse collapse" aria-labelledby="headingRegulares" data-bs-parent="#accordionCondiciones">
                                    <div class="accordion-body p-0">
                                        <!-- Misma estructura que Productos Buenos -->
                                        <div class="table-responsive">
                                            <table class="table table-sm mb-0">
                                                <thead class="table-light">
                                                <tr>
                                                    <th width="10%">Código</th>
                                                    <th width="40%">Descripción</th>
                                                    <th width="15%">Cantidad</th>
                                                    <th width="15%">Unidad</th>
                                                    <th width="20%">Condición</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($productosRegulares as $item)
                                                    <tr>
                                                        <td>{{ $item->idproducto ?? 'N/A' }}</td>
                                                        <td>
                                                            {{ $item->producto ?? 'Sin descripción' }}
                                                            @if(!empty($item->observaciones))
                                                                <small class="text-muted d-block">{{ $item->observaciones }}</small>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">{{ number_format($item->cantidad ?? 0, 2) }}</td>
                                                        <td>{{ $item->unidadmedida ?? 'N/A' }}</td>
                                                        <td>
                                                            <span class="badge bg-warning">{{ $item->nombretipocondicion ?? 'REGULAR' }}</span>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center text-muted py-3">
                                                            <i class="fas fa-box-open me-2"></i> No hay productos en estado Regular
                                                        </td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Productos Dañados -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingDanados">
                                    <button class="accordion-button bg-danger bg-opacity-10 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDanados">
                                        <i class="fas fa-times-circle text-danger me-2"></i>
                                        Productos Dañados ({{ count($productosDanados) }})
                                    </button>
                                </h2>
                                <div id="collapseDanados" class="accordion-collapse collapse" aria-labelledby="headingDanados" data-bs-parent="#accordionCondiciones">
                                    <div class="accordion-body p-0">
                                        <!-- Misma estructura que Productos Buenos -->
                                        <div class="table-responsive">
                                            <table class="table table-sm mb-0">
                                                <thead class="table-light">
                                                <tr>
                                                    <th width="10%">Código</th>
                                                    <th width="40%">Descripción</th>
                                                    <th width="15%">Cantidad</th>
                                                    <th width="15%">Unidad</th>
                                                    <th width="20%">Condición</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($productosDanados as $item)
                                                    <tr>
                                                        <td>{{ $item->idproducto ?? 'N/A' }}</td>
                                                        <td>
                                                            {{ $item->producto ?? 'Sin descripción' }}
                                                            @if(!empty($item->observaciones))
                                                                <small class="text-muted d-block">{{ $item->observaciones }}</small>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">{{ number_format($item->cantidad ?? 0, 2) }}</td>
                                                        <td>{{ $item->unidadmedida ?? 'N/A' }}</td>
                                                        <td>
                                                            <span class="badge bg-danger">{{ $item->nombretipocondicion ?? 'DAÑADO' }}</span>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center text-muted py-3">
                                                            <i class="fas fa-box-open me-2"></i> No hay productos Dañados
                                                        </td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- Resumen de Validación -->
                        <div class="card border-primary mt-4">
                            <div class="card-header bg-primary bg-opacity-10">
                                <h6 class="mb-0"><i class="fas fa-clipboard-check me-2"></i>Resumen de Validación</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Fecha Validación:</strong> {{ $validacion->fechavalidacion ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Total Productos:</strong> {{ $validacion->cantrecibidarevision ?? 0 }}</p>
                                    </div>
                                </div>
                                @if(!empty($validacion->observaciones))
                                    <div class="alert alert-warning mt-3 mb-0">
                                        <strong><i class="fas fa-exclamation-circle me-2"></i>Observaciones:</strong>
                                        {{ $validacion->observaciones }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Pestaña Documentos -->
                    <div class="tab-pane fade" id="documentos" role="tabpanel">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>Documentos adjuntos a la guía de remisión
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body text-center">
                                        <i class="fas fa-file-pdf text-danger fs-1 mb-3"></i>
                                        <h6>Guía_Remision_GR001245.pdf</h6>
                                        <p class="text-muted small">15/05/2023 - 2.4MB</p>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-download me-1"></i> Descargar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body text-center">
                                        <i class="fas fa-file-image text-success fs-1 mb-3"></i>
                                        <h6>Foto_Entrega_001.jpg</h6>
                                        <p class="text-muted small">15/05/2023 - 1.8MB</p>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-download me-1"></i> Descargar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
