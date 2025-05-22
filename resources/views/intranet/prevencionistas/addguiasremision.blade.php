@extends('intranet.prevencionistas.prevencionista')
@section('title','Agregar Guía de Remisión')

@section('content')
    <div class="container-fluid py-2">
        <h5 class="modal-title mb-3 fw-bold text-primary" id="idmodalguiasremision">
            <i class="fas fa-file-import me-2"></i>Agregar Guía de Remisión
        </h5>

        <form id="idformaddguiasremision" class="needs-validation" novalidate>
            @csrf
            <input type="hidden" id="idguia" name="idguia" value="">

            <div class="row g-3">
                <!-- Columna 1: Datos Principales -->
                <div class="col-md-3">
                    <div class="card shadow-sm h-100 border-primary">
                        <div class="card-header bg-primary text-white py-2">
                            <h6 class="mb-0 fw-semibold"><i class="fas fa-file-alt me-2"></i>Datos Principales</h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="mb-3">
                                <label for="idtxtcodigoguia" class="form-label small fw-bold">N° Guía</label>
                                <input type="text" class="form-control form-control-sm" id="idtxtcodigoguia" name="codigoguia" required>
                            </div>
                            <div class="mb-3">
                                <label for="idtxtnumerotrasladotim" class="form-label small fw-bold">N° TIM</label>
                                <input type="text" class="form-control form-control-sm" id="idtxtnumerotrasladotim" name="numerotrasladotim" required>
                            </div>
                            <div class="mb-0">
                                <label for="idtxtrazonsocialguia" class="form-label small fw-bold">Razón Social</label>
                                <input type="text" class="form-control form-control-sm" id="idtxtrazonsocialguia" name="razonsocialguia" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Columna 2: Detalles del Traslado -->
                <div class="col-md-3">
                    <div class="card shadow-sm h-100 border-success">
                        <div class="card-header bg-success text-white py-2">
                            <h6 class="mb-0 fw-semibold"><i class="fas fa-truck me-2"></i>Detalles del Traslado</h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="mb-3">
                                <label for="idselcetmotivotraslado" class="form-label small fw-bold">Motivo</label>
                                <select class="form-select form-select-sm" id="idselcetmotivotraslado" name="motivotraslado" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="Venta">Venta</option>
                                    <option value="Traslado entre almacenes">Traslado entre almacenes</option>
                                    <option value="Exportación">Exportación</option>
                                    <option value="Importación">Importación</option>
                                </select>
                            </div>
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <label for="idtxtpesobrutototal" class="form-label small fw-bold">Peso (kg)</label>
                                    <input type="number" step="0.01" class="form-control form-control-sm" id="idtxtpesobrutototal" name="pesobrutototal" required>
                                </div>
                                <div class="col-6">
                                    <label for="idtxtvolumenproducto" class="form-label small fw-bold">Volumen (m³)</label>
                                    <input type="number" step="0.01" class="form-control form-control-sm" id="idtxtvolumenproducto" name="volumenproducto" required>
                                </div>
                            </div>
                            <div>
                                <label for="idselectnumerobultopallet" class="form-label small fw-bold">N° Bultos/Pallets</label>
                                <input type="number" class="form-control form-control-sm" id="idselectnumerobultopallet" name="numerobultopallet" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Columna 3: Personal -->
                <div class="col-md-3">
                    <div class="card shadow-sm h-100 border-info">
                        <div class="card-header bg-info text-white py-2">
                            <h6 class="mb-0 fw-semibold"><i class="fas fa-users me-2"></i>Personal</h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="mb-3">
                                <label for="idselectidconductor" class="form-label small fw-bold">Conductor</label>
                                <select class="form-select form-select-sm" id="idselectidconductor" name="idconductor" required>
                                    <option value="">Seleccionar...</option>
                                    @forelse($conductores as $conductor)
                                        <option value="{{ $conductor->idconductor }}">{{ $conductor->nombre }}</option>
                                    @empty
                                        <option value="" disabled>No hay conductores</option>
                                    @endforelse
                                </select>
                            </div>
                            <div>
                                <label for="idtxtobservaciones" class="form-label small fw-bold">Observaciones</label>
                                <input type="text" class="form-control form-control-sm" id="idtxtobservaciones" name="observaciones">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Columna 4: Empresa receptora -->
                <div class="col-md-3">
                    <div class="card shadow-sm h-100 border-warning">
                        <div class="card-header bg-warning text-dark py-2">
                            <h6 class="mb-0 fw-semibold"><i class="fas fa-building me-2"></i>Empresa Receptora</h6>
                        </div>
                        <div class="card-body p-3">
                            <label for="idselectidtipoempresa" class="form-label small fw-bold">Empresa que recibirá</label>
                            <select class="form-select form-select-sm" id="idselectidtipoempresa" name="idtipoempresa" required>
                                <option value="">Seleccionar...</option>
                                @forelse($tipoempresa as $empresa)
                                    <option value="{{ $empresa->idtipoempresa }}">{{ $empresa->razonsocial }}</option>
                                @empty
                                    <option value="" disabled>No hay empresas</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                </div>
            </div>

    </div>

            <!-- Sección de Productos -->
            <br>
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-secondary bg-opacity-10 py-2 border-0">
                    <h6 class="mb-0 text-secondary fw-bold"><i class="fas fa-boxes me-2"></i>Agrega los Productos al Carrito</h6>
                </div>

                <div class="card-body p-3">
                    <!-- Formulario para agregar productos -->
                    <div class="row g-2 mb-3 align-items-end">
                        <!-- Código -->
                        <div class="col-md-3">
                            <label for="idtxtcodigoproducto" class="form-label small fw-bold">Código</label>
                            <input type="hidden" id="idproductocarritogiaremision" >
                            <input type="text"
                                   class="form-control form-control-sm"
                                   id="idtxtcodigoproducto"
                                   pattern="\d{8}"
                                   maxlength="8"
                                   oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                                   required>
                        </div>

                        <!-- Nombre -->
                        <div class="col-md-4">
                            <label for="idtxtnombreproducto" class="form-label small fw-bold">Nombre del Producto</label>
                            <input type="text" class="form-control form-control-sm" id="idtxtnombreproducto" readonly>
                        </div>

                        <!-- Cantidad -->
                        <div class="col-md-2">
                            <label for="idtxtcantidadproducto" class="form-label small fw-bold">Cantidad</label>
                            <input type="number" class="form-control form-control-sm" id="idtxtcantidadproducto">
                        </div>

                        <!-- Estado -->
                        <div class="col-md-2">
                            <label for="idselectestadoproducto" class="form-label small fw-bold">Estado</label>
                            <select class="form-select form-select-sm" id="idselectestadoproducto">
                                <option value="Bueno">Bueno</option>
                                <option value="Regular">Regular</option>
                                <option value="Dañado">Dañado</option>
                            </select>
                        </div>

                        <!-- Botón de agregar (solo icono) -->
                        <div class="col-md-1">
                            <button type="button" class="btn btn-primary btn-sm h-100" id="idbtnagregarproducto" title="Agregar producto">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Tabla de productos agregados -->
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-hover" id="tablaProductos">
                            <thead class="table-light">
                            <tr>
                                <th width="15%">Código</th>
                                <th width="40%">Producto</th>
                                <th width="15%">Cantidad</th>
                                <th width="20%">Estado</th>
                                <th width="10%">Acción</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- Los productos se agregarán aquí dinámicamente -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Botones de acción - ahora fuera del grid -->
            <!-- Botones de acción alineados a la derecha -->
            <div class="d-flex justify-content-end mt-3 gap-2">
                <button type="button" class="btn btn-outline-danger btn-sm px-3" data-bs-dismiss="modal">
                    <i class="fas fa-times-circle me-1"></i> Cancelar
                </button>
                <button type="submit" class="btn btn-success btn-sm px-3">
                    <i class="fas fa-save me-1"></i> Guardar
                </button>
            </div>
        </form>
    </div>
@endsection
