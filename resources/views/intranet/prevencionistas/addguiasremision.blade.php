@extends('intranet.prevencionistas.prevencionista')
@section('title','Agregar Guía de Remisión')

@section('content')
    <div class="container-fluid py-2">
        <!-- Formulario -->
        <h5 class="modal-title" id="idmodalguiasremision">Agregar Guía de Remisión</h5>
        <form id="idformaddguiasremision" class="needs-validation" novalidate>
            @csrf
            <input type="hidden" id="idguia" name="idguia" value="">

            <!-- Sección: Datos Principales -->
            <div class="card mb-4 border shadow-sm">
                <div class="card-header bg-light border-start border-primary border-5 py-2">
                    <h6 class="mb-0 fw-bold"><i class="fas fa-file-alt me-2 text-primary"></i>Datos Principales</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Código Guía</label>
                            <input type="text" class="form-control" id="idtxtcodigoguia" name="codigoguia" required>
                        </div>
{{--                        <div class="col-md-3">--}}
{{--                            <label class="form-label fw-bold">Fecha Emisión</label>--}}
{{--                            <input type="date" class="form-control" id="idtxtfechaemision" name="fechaemision" required>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3">--}}
{{--                            <label class="form-label fw-bold">Hora Emisión</label>--}}
{{--                            <input type="time" class="form-control" id="idtxthoraemision" name="horaemision" required>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3">--}}
{{--                            <label class="form-label fw-bold">Fecha Entrega</label>--}}
{{--                            <input type="date" class="form-control" id="idtxtfechaentrega" name="fechaentrega" required>--}}
{{--                        </div>--}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Razón Social</label>
                            <input type="text" class="form-control" id="idtxtrazonsocialguia" name="razonsocialguia" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">N° Traslado TIM</label>
                            <input type="text" class="form-control" id="idtxtnumerotrasladotim" name="numerotrasladotim" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección: Detalles del Traslado -->
            <div class="card mb-4 border shadow-sm">
                <div class="card-header bg-light border-start border-success border-5 py-2">
                    <h6 class="mb-0 fw-bold"><i class="fas fa-truck-loading me-2 text-success"></i>Detalles del Traslado</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Motivo de Traslado</label>
                            <select class="form-select" id="idselcetmotivotraslado" name="motivotraslado" required>
                                <option value="">Seleccionar...</option>
                                <option value="Venta">Venta</option>
                                <option value="Traslado entre almacenes">Traslado entre almacenes</option>
                                <option value="Exportación">Exportación</option>
                                <option value="Importación">Importación</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-bold">Peso Bruto Total (kg)</label>
                            <input type="number" step="0.01" class="form-control" id="idtxtpesobrutototal" name="pesobrutototal" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-bold">Volumen Producto (m³)</label>
                            <input type="number" step="0.01" class="form-control" id="idtxtvolumenproducto" name="volumenproducto" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-bold">N° Bultos/Pallets</label>
                            <input type="number" class="form-control" id="idselectnumerobultopallet" name="numerobultopallet" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección: Datos del Conductor -->
            <div class="card mb-4 border shadow-sm">
                <div class="card-header bg-light border-start border-info border-5 py-2">
                    <h6 class="mb-0 fw-bold"><i class="fas fa-user-tie me-2 text-info"></i>Datos del Conductor</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Conductor</label>
                            <select class="form-select" id="idselectidconductor" name="idconductor" required>
                                <option value="">Seleccionar conductor...</option>
                                @forelse($conductores as $conductor)
                                    <option value="{{ $conductor->idconductor }}">{{ $conductor->nombre }} </option>
                                @empty
                                    <option value="" disabled>No hay conductores disponibles</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección: Datos de Empresa -->
            <div class="card mb-4 border shadow-sm">
                <div class="card-header bg-light border-start border-dark border-5 py-2">
                    <h6 class="mb-0 fw-bold"><i class="fas fa-building me-2 text-dark"></i>Datos de Empresa</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Tipo de Empresa</label>
                            <select class="form-select" id="idselectidtipoempresa" name="idtipoempresa" required>
                                <option value="">Seleccionar empresa...</option>
                                @forelse($tipoempresa as $empresa)
                                    <option value="{{ $empresa->idtipoempresa }}">{{ $empresa->razonsocial }} - RUC: {{ $empresa->ruc }}</option>
                                @empty
                                    <option value="" disabled>No hay empresas disponibles</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección: Observaciones -->
            <div class="card mb-4 border shadow-sm">
                <div class="card-header bg-light border-start border-warning border-5 py-2">
                    <h6 class="mb-0 fw-bold"><i class="fas fa-clipboard me-2 text-warning"></i>Observaciones</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Observaciones</label>
                        <textarea class="form-control" id="idtxtobservaciones" name="observaciones" rows="3"></textarea>
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-lg btn-outline-danger" data-bs-dismiss="modal">
                    <i class="fas fa-times-circle me-2"></i> Cancelar
                </button>
                <button type="submit" class="btn btn-lg btn-success">
                    <i class="fas fa-save me-2"></i> Guardar Guía
                </button>
            </div>
        </form>
    </div>
@endsection
