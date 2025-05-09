@extends('intranet.prevencionistas.prevencionista')
@section('title','Agregar Guía de Remisión')

@section('content')
    <div class="container-fluid py-2">
{{--        <h5 class="modal-title" id="exampleModalLabel">Agregar Guía de Remisión</h5>--}}
{{--        <form id="idformguiasremision" class="needs-validation" novalidate>--}}
{{--                @csrf--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-6 mb-3">--}}
{{--                        <label for="idtxtcodigoguia" class="form-label">N° Guia</label>--}}
{{--                        <input type="text" class="form-control" id="idtxtcodigoguia" name="codigoguia" required>--}}
{{--                        <div class="invalid-feedback">Por favor ingrese el codigo de la guia.</div>--}}
{{--                    </div>--}}

{{--                    <div class="row">--}}
{{--                        <div class="col-md-6 mb-3">--}}
{{--                            <label for="idtxtrazonsocialguia" class="form-label">Razon Social</label>--}}
{{--                            <input type="text" class="form-control" id="idtxtrazonsocialguia" name="razonsocialguia" required>--}}
{{--                            <div class="invalid-feedback">Por favor ingrese la razon social.</div>--}}
{{--                        </div>--}}

{{--                        <div class="col-md-6 mb-3">--}}
{{--                            <label for="idtxtselectdestino" class="form-label">Destino</label>--}}
{{--                            <input type="text" class="form-control" id="idtxtselectdestino" name="destino" required>--}}
{{--                            <div class="invalid-feedback">Por favor ingrese el destino.</div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-6 mb-3">--}}
{{--                        <label for="idtxttim" class="form-label">N° TIM (Guía de Remisión)</label>--}}
{{--                        <input type="text" class="form-control" id="idtxttim" name="tim" required>--}}
{{--                        <div class="invalid-feedback">Por favor ingrese el número TIM.</div>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-6 mb-3">--}}
{{--                        <label for="idtxtmotivotraslado" class="form-label">Motivo de Traslado</label>--}}
{{--                        <input type="text" class="form-control" id="idtxtmotivotraslado" name="motivotraslado" required>--}}
{{--                        <div class="invalid-feedback">Por favor ingrese el motivo.</div>--}}
{{--                    </div>--}}
{{--                </div>--}}



{{--                <div class="row">--}}
{{--                    <div class="col-md-6 mb-3">--}}
{{--                        <label for="idselectestado" class="form-label">Estado</label>--}}
{{--                        <select class="form-select" id="idselectestado" name="estado" required>--}}
{{--                            <option value="">Seleccione...</option>--}}
{{--                            <option value="Pendiente">Pendiente</option>--}}
{{--                            <option value="En transito">En tránsito</option>--}}
{{--                            <option value="Entregado">Entregado</option>--}}
{{--                            <option value="Rechazado">Rechazado</option>--}}
{{--                        </select>--}}
{{--                        <div class="invalid-feedback">Por favor seleccione un estado.</div>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-6 mb-3">--}}
{{--                        <label for="idselectcantidadenviada" class="form-label">Cantidad Enviada</label>--}}
{{--                        <input type="number" class="form-control" id="idselectcantidadenviada" name="cantidadenviada" required>--}}
{{--                        <div class="invalid-feedback">Por favor ingrese la cantidad.</div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="row">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-6 mb-3">--}}
{{--                            <label for="idselectvehiculo" class="form-label">Vehículo</label>--}}
{{--                            <select class="form-select" id="idselectvehiculo" name="idvehiculo" required>--}}
{{--                                <option value="">Seleccione un vehículo...</option>--}}

{{--                                como array Eoquent--}}
{{--                                @forelse($vehiculos as $vehiculo)--}}
{{--                                    <option value="{{ $vehiculo->idvehiculo }}">--}}
{{--                                        {{ $vehiculo->placa }} - {{ $vehiculo->marca }}--}}
{{--                                    </option>--}}
{{--                                @empty--}}
{{--                                    <option value="" disabled>No hay vehículos registrados</option>--}}
{{--                                @endforelse--}}

{{--                                como array asociativo--}}
{{--                                                                    @foreach($vehiculos as $vehiculo)--}}
{{--                                                                        <option value="{{ $vehiculo['idvehiculo'] }}">--}}
{{--                                                                            {{ $vehiculo['placa'] }} - {{ $vehiculo['marca'] }}--}}
{{--                                                                        </option>--}}
{{--                                                                    @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div class="col-md-6 mb-3">--}}
{{--                            <label for="idselectvehiculo" class="form-label">Conductor</label>--}}
{{--                            <select class="form-select" id="idselectconductor" name="idconductor" required>--}}
{{--                                <option value="">Seleccione un conductor...</option>--}}
{{--                                @forelse($conductores as $conductor)--}}
{{--                                    <option value="{{ $conductor->idconductor }}">--}}
{{--                                        {{ $conductor->nombre }}--}}
{{--                                    </option>--}}
{{--                                @empty--}}
{{--                                    <option value="" disabled>No hay conductores registrados</option>--}}
{{--                                @endforelse--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="mb-3">--}}
{{--                    <label for="idtxtobservacion" class="form-label">Observaciones</label>--}}
{{--                    <textarea class="form-control" id="idtxtobservacion" name="observacion" rows="2"></textarea>--}}
{{--                </div>--}}

{{--                <div class="text-end">--}}
{{--                    <button type="submit" class="btn btn-primary">--}}
{{--                        <i class="fa-solid fa-save me-1"></i> Guardar--}}
{{--                    </button>--}}
{{--                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">--}}
{{--                        <i class="fa-solid fa-times me-1"></i> Cancelar--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </form>--}}
        </div>

    <div class="container-fluid py-2">
        <h5 class="modal-title" id="idmodalguiasremision">Agregar Guía de Remisión</h5>
        <form id="idformaddguiasremision" class="needs-validation" novalidate>
            @csrf
            <input type="hidden" id="idguia" name="idguia" value="">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>Datos Principales</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="idtxtcodigoguia" class="form-label fw-bold">N° Guía</label>
                            <input type="text" class="form-control" id="idtxtcodigoguia" name="codigoguia" required>
                            <div class="invalid-feedback">Campo obligatorio</div>
                        </div>

                        <div class="col-md-4">
                            <label for="idtxtnumerotrasladotim" class="form-label fw-bold">N° TIM</label>
                            <input type="text" class="form-control" id="idtxtnumerotrasladotim" name="numerotrasladotim" required>
                            <div class="invalid-feedback">Campo obligatorio</div>
                        </div>

                        <div class="col-md-4">
                            <label for="idtxtrazonsocialguia" class="form-label fw-bold">Razón Social</label>
                            <input type="text" class="form-control" id="idtxtrazonsocialguia" name="razonsocialguia" required>
                            <div class="invalid-feedback">Campo obligatorio</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header bg-success text-white py-3">
                    <h5 class="mb-0"><i class="fas fa-truck-loading me-2"></i>Detalles del Traslado</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="idselcetmotivotraslado" class="form-label fw-bold">Motivo de Traslado</label>
                            <select class="form-select" id="idselcetmotivotraslado" name="motivotraslado" required>
                                <option value="">Seleccionar...</option>
                                <option value="Venta">Venta</option>
                                <option value="Traslado entre almacenes">Traslado entre almacenes</option>
                                <option value="Exportación">Exportación</option>
                                <option value="Importación">Importación</option>
                            </select>
                            <div class="invalid-feedback">Selección obligatoria</div>
                        </div>

                        <div class="col-md-3">
                            <label for="idtxtpesobrutototal" class="form-label fw-bold">Peso Bruto (kg)</label>
                            <input type="number" step="0.01" class="form-control" id="idtxtpesobrutototal" name="pesobrutototal" required>
                            <div class="invalid-feedback">Campo obligatorio</div>
                        </div>

                        <div class="col-md-3">
                            <label for="idtxtvolumenproducto" class="form-label fw-bold">Volumen (m³)</label>
                            <input type="number" step="0.01" class="form-control" id="idtxtvolumenproducto" name="volumenproducto" required>
                            <div class="invalid-feedback">Campo obligatorio</div>
                        </div>

                        <div class="col-md-4">
                            <label for="idselectnumerobultopallet" class="form-label fw-bold">N° Bultos/Pallets</label>
                            <input type="number" class="form-control" id="idselectnumerobultopallet" name="numerobultopallet" required>
                            <div class="invalid-feedback">Campo obligatorio</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header bg-info text-white py-3">
                    <h5 class="mb-0"><i class="fas fa-users me-2"></i>Personal y Empresa</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="idselectidconductor" class="form-label fw-bold">Conductor</label>
                            <select class="form-select" id="idselectidconductor" name="idconductor" required>
                                <option value="">Seleccionar conductor...</option>
                                @forelse($conductores as $conductor)
                                    <option value="{{ $conductor->idconductor }}">{{ $conductor->nombre }}</option>
                                @empty
                                    <option value="" disabled>No hay conductores disponibles</option>
                                @endforelse
                            </select>
                            <div class="invalid-feedback">Selección obligatoria</div>
                        </div>

                        <div class="col-md-6">
                            <label for="idselectidtipoempresa" class="form-label fw-bold">Tipo de Empresa</label>
                            <select class="form-select" id="idselectidtipoempresa" name="idtipoempresa" required>
                                <option value="">Seleccionar empresa...</option>
                                @forelse($tipoempresa as $empresa)
                                    <option value="{{ $empresa->idtipoempresa }}">{{ $empresa->razonsocial }}</option>
                                @empty
                                    <option value="" disabled>No hay conductores disponibles</option>
                                @endforelse
                            </select>
                            <div class="invalid-feedback">Selección obligatoria</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header bg-warning text-dark py-3">
                    <h5 class="mb-0"><i class="fas fa-clipboard me-2"></i>Observaciones</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="idtxtobservaciones" class="form-label fw-bold">Notas adicionales</label>
                        <textarea class="form-control" id="idtxtobservaciones" name="observaciones" rows="3"></textarea>
                    </div>
                </div>
            </div>

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
