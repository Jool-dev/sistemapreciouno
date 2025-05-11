@extends('intranet.prevencionistas.prevencionista')
@section('title', 'Productos de Guía')

@section('content')
    <div class="container-fluid py-4">
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white py-3">
                <div>
                    <img src="https://tefacturo.pe/images/logo.png" alt="Logo Empresa" style="height: 50px;">
                    <h6 class="mt-2 fw-bold text-primary">CIERREU S.A.C.</h6>
                </div>
                <div class="text-end">
                    <div class="border p-3">
                        <strong>RUC:</strong> 20549776974<br>
                        <strong>GUÍA DE REMISIÓN ELECTRÓNICA</strong><br>
                        <strong>Serie:</strong> T001-0
                    </div>
                </div>
            </div>

            <div class="card-body">
                <!-- Sección 1: Datos del Transportista -->
                <div class="card mb-4 border-primary">
                    <div class="card-header bg-light py-2">
                        <h5 class="mb-0 text-primary">DATOS DEL TRANSPORTISTA</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Documento de transportista:</strong> 10210447568</p>
                                <p><strong>Razón Social:</strong> Annela Olivina Terrestri</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Vehículo:</strong> Transporte policial</p>
                                <p><strong>Conductor:</strong> [Nombre del conductor]</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sección 2: Datos del Emisor -->
                <div class="card mb-4 border-success">
                    <div class="card-header bg-light py-2">
                        <h5 class="mb-0 text-success">DATOS DEL ESTABLECIMIENTO</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Documento de facturador:</strong> 20060776023</p>
                                <p><strong>Razón Social:</strong> MuseSUS S.A.C.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sección 3: Datos de Partida y Llegada -->
                <div class="card mb-4 border-info">
                    <div class="card-header bg-light py-2">
                        <h5 class="mb-0 text-info">DATOS DEL PUNTO DE PARTIDA Y LLEGADA</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Punto de Partida</h6>
                                <p><strong>Dirección:</strong> DE SERVICIACI DE CABLE EN VITE</p>
                                <p><strong>Código:</strong> 150915</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">Punto de Llegada</h6>
                                <p><strong>Dirección:</strong> CAL. ERA TECNOPRANDO EN LA LAMA LIMA LIMA</p>
                                <p><strong>Código:</strong> 160191</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sección 4: Datos del Traslado -->
                <div class="card mb-4 border-warning">
                    <div class="card-header bg-light py-2">
                        <h5 class="mb-0 text-warning">DATOS DEL TRASLADO</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>Fecha de Emisión:</strong> 2020-11-11</p>
                                <p><strong>Fecha de Entrega:</strong> 2020-11-11</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Modalidad de Traslado:</strong> VISTAS</p>
                                <p><strong>Peso Total:</strong> 5.691 (febril)</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Conocimiento:</strong> Puede Poder</p>
                                <p><strong>Estado:</strong> Conocupado en Trabajos</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sección 5: Productos -->
                <div class="card mb-4 border-danger">
                    <div class="card-header bg-light py-2">
                        <h5 class="mb-0 text-danger">DESCRIPCIÓN DE BIENES TRASLADADOS</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead class="table-dark">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="20%">Código</th>
                                    <th width="35%">Descripción</th>
                                    <th width="10%">Cantidad</th>
                                    <th width="15%">Unidad</th>
                                    <th width="15%">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
{{--                                @forelse($guia->productos as $producto)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{ $loop->iteration }}</td>--}}
{{--                                        <td>{{ $producto->codigo }}</td>--}}
{{--                                        <td>{{ $producto->nombre }}</td>--}}
{{--                                        <td>{{ $producto->pivot->cantidad }}</td>--}}
{{--                                        <td>{{ $producto->unidad_medida ?? 'UND' }}</td>--}}
{{--                                        <td>--}}
{{--                                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">--}}
{{--                                                <i class="fas fa-trash-alt"></i>--}}
{{--                                            </button>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @empty--}}
{{--                                    <tr>--}}
{{--                                        <td colspan="6" class="text-center">No hay productos registrados</td>--}}
{{--                                    </tr>--}}
{{--                                @endforelse--}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Sección 6: Agregar Productos -->
                <div class="card mb-4">
                    <div class="card-header bg-light py-2">
                        <h5 class="mb-0">AGREGAR PRODUCTOS</h5>
                    </div>
                    <div class="card-body">
                        <form id="formAgregarProducto" class="row g-3 align-items-end">
                            @csrf
                            <input type="hidden" name="idguia" value="#">

                            <div class="col-md-2">
                                <label for="codigoProducto" class="form-label">Código</label>
                                <input type="text" class="form-control" id="codigoProducto" name="codigo" required>
                            </div>

                            <div class="col-md-4">
                                <label for="nombreProducto" class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="nombreProducto" name="nombre" required>
                            </div>

                            <div class="col-md-2">
                                <label for="cantidadProducto" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" id="cantidadProducto" name="cantidad" min="1" required>
                            </div>

                            <div class="col-md-2">
                                <label for="unidadProducto" class="form-label">Unidad</label>
                                <input type="text" class="form-control" id="unidadProducto" name="unidad_medida" value="UND" required>
                            </div>

                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-plus me-1"></i> Agregar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Sección 7: Observaciones y Acciones -->
                <div class="row mt-4">
                    <div class="col-md-8">
                        <div class="card border-info">
                            <div class="card-header bg-light py-2">
                                <h5 class="mb-0 text-info">OBSERVACIONES</h5>
                            </div>
                            <div class="card-body">
                                <textarea class="form-control" rows="3" placeholder="Ingrese observaciones aquí..."></textarea>
                                <p class="mt-2 small text-muted">VARIOS_REVIS</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="d-grid gap-2">
                            <button class="btn btn-success btn-lg" type="button">
                                <i class="fas fa-check-circle me-2"></i> CONFIRMAR REGISTRO
                            </button>
                            <button class="btn btn-outline-secondary btn-lg" type="button">
                                <i class="fas fa-file-pdf me-2"></i> IMPRIMIR PDF
                            </button>
                            <a href="#" class="btn btn-outline-danger btn-lg">
                                <i class="fas fa-times-circle me-2"></i> CANCELAR
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
