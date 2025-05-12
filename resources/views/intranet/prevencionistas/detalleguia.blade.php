@extends('intranet.prevencionistas.prevencionista')
@section('title', 'Productos de Guía')

@section('content')
    @vite('resources/css/views/prevencionistas/detalleguia.css')
    <div class="container-fluid py-3">
        <!-- Header con botones -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0 text-primary fw-bold">
                <i class="fas fa-file-invoice me-2"></i>Detalle de Guía #<span id="idguia" class="text-dark"></span>
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
                            <i class="fas fa-boxes me-1"></i> Productos De La Guia (3)
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
                                            <strong id="detalle-numerotim">TIM-789456</strong>
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
                                            <span class="d-block text-muted small">Peso Total (kg):</span>
                                            <strong id="detalle-peso">125.50</strong>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <span class="d-block text-muted small">Volumen (m³):</span>
                                            <strong id="detalle-volumen">2.75</strong>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <span class="d-block text-muted small">N° Bultos:</span>
                                            <strong id="detalle-bultos">8</strong>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <span class="d-block text-muted small">Motivo:</span>
                                            <strong id="detalle-motivo">Venta</strong>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <span class="d-block text-muted small">Observaciones:</span>
                                            <strong id="detalle-observaciones">Productos frágiles, manejar con cuidado</strong>
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
                                            <h6 class="mb-0 fw-bold" id="detalle-conductor">Robert Machacusy</h6>
                                            <span class="text-muted small" id="detalle-dni-conductor">DNI: 45879632</span><br>
                                            <span class="badge bg-success">Activo</span>
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
                                        <h6 class="mb-1 fw-bold" id="detalle-empresa">TRANSPORTES PERU SAC</h6>
                                        <span class="text-muted small" id="detalle-ruc-empresa">RUC: 20154879632</span><br>
                                        <span class="badge bg-info text-dark" id="detalle-modalidad">Transporte Privado</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pestaña Productos -->
                    <div class="tab-pane fade" id="productos" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover table-sm">
                                <thead class="table-primary">
                                <tr>
                                    <th width="10%">Código</th>
                                    <th width="40%">Producto</th>
                                    <th width="15%">Cantidad</th>
                                    <th width="20%">Estado</th>
                                    <th width="15%">Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- Los productos se listaran aquí -->
{{--                                @forelse($productodetalleguia as $productos)--}}
{{--                                    <tr>--}}
{{--                                        <td class="text-center align-middle"><strong>{{ $productos['codigoproducto'] }}</strong></td>--}}
{{--                                        <td class="text-center align-middle"><strong>{{ $productos['nombre'] }}</strong></td>--}}
{{--                                        <td class="text-center align-middle"><strong>{{ $productos['tipocodproducto'] }}</strong></td>--}}
{{--                                        <td class="text-center align-middle"><strong>{{ $productos['tipoinventario'] }}</strong></td>--}}
{{--                                        <td class="text-center align-middle"><strong>{{ $productos['estado'] }}</strong></td>--}}
{{--                                        <td class="text-center align-middle"><strong>{{ $productos['fecharegistro'] }}</strong></td>--}}
{{--                                    </tr>--}}
{{--                                @empty--}}
{{--                                    <tr>--}}
{{--                                        <td colspan="7" class="text-center text-muted py-4">--}}
{{--                                            No hay productos registrados.--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @endforelse--}}
                                </tbody>
                            </table>
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
