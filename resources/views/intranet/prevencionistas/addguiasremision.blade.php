@extends('intranet/layout')
@section('title', isset($guia) ? 'Editar Guía de Remisión' : 'Agregar Guía de Remisión')

@section('content')
    <div class="container-fluid py-2" style="overflow-y: auto; max-height: 90vh;">
        <h5 class="modal-title mb-3 fw-bold text-primary" id="idmodalguiasremision">
            <i class="fas fa-file-import me-2"></i>
            {{ isset($guia) ? 'Editar Guía de Remisión' : 'Agregar Guía de Remisión' }}
        </h5>
        
        @if(isset($guia))
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                Editando guía: <strong>{{ $guia->codigoguia }}</strong>
            </div>
        @endif
        
        <form id="idformaddguiasremision" class="needs-validation" novalidate>
            @csrf
            <input type="hidden" id="idguia" name="idguia" value="{{ $guia->idguia ?? '' }}">

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
                                <input type="text" class="form-control form-control-sm" id="idtxtcodigoguia"
                                    name="codigoguia" value="{{ $guia->codigoguia ?? '' }}" required>
                                <div class="invalid-feedback">Ingrese el numero de la guia</div>
                            </div>
                            <div class="mb-3">
                                <label for="idtxtnumerotrasladotim" class="form-label small fw-bold">N° TIM</label>
                                <input type="text" class="form-control form-control-sm" id="idtxtnumerotrasladotim"
                                    name="numerotrasladotim" value="{{ $guia->numerotrasladotim ?? '' }}" required>
                                <div class="invalid-feedback">Ingrese el número de TIM</div>
                            </div>
                            <div class="mb-0">
                                <label for="idtxtrazonsocialguia" class="form-label small fw-bold">Razón Social</label>
                                <input type="text" class="form-control form-control-sm" id="idtxtrazonsocialguia"
                                    name="razonsocialguia" value="{{ $guia->razonsocialguia ?? '' }}" required>
                                <div class="invalid-feedback">Ingrese la razón social</div>
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
                                    <option value="Venta" {{ (isset($guia) && $guia->motivotraslado == 'Venta') ? 'selected' : '' }}>Venta</option>
                                    <option value="Traslado entre almacenes" {{ (isset($guia) && $guia->motivotraslado == 'Traslado entre almacenes') ? 'selected' : '' }}>Traslado entre almacenes</option>
                                    <option value="Exportación" {{ (isset($guia) && $guia->motivotraslado == 'Exportación') ? 'selected' : '' }}>Exportación</option>
                                    <option value="Importación" {{ (isset($guia) && $guia->motivotraslado == 'Importación') ? 'selected' : '' }}>Importación</option>
                                </select>
                                <div class="invalid-feedback">Seleccione un motivo de traslado</div>
                            </div>
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <label for="idtxtpesobrutototal" class="form-label small fw-bold">Peso (kg)</label>
                                    <input type="number" step="0.01" class="form-control form-control-sm"
                                        id="idtxtpesobrutototal" name="pesobrutototal" 
                                        value="{{ $guia->pesobrutototal ?? '' }}" required>
                                    <div class="invalid-feedback">Ingrese el peso bruto total</div>
                                </div>
                                <div class="col-6">
                                    <label for="idtxtvolumenproducto" class="form-label small fw-bold">Volumen (m³)</label>
                                    <input type="number" step="0.01" class="form-control form-control-sm"
                                        id="idtxtvolumenproducto" name="volumenproducto" 
                                        value="{{ $guia->volumenproducto ?? '' }}" required>
                                    <div class="invalid-feedback">Ingrese el volumen total</div>
                                </div>
                            </div>
                            <div>
                                <label for="idselectnumerobultopallet" class="form-label small fw-bold">N° Bultos/Pallets</label>
                                <input type="number" class="form-control form-control-sm" id="idselectnumerobultopallet"
                                    name="numerobultopallet" value="{{ $guia->numerobultopallet ?? '' }}" required>
                                <div class="invalid-feedback">Ingrese el número de bultos o pallets</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Columna 3: Personal -->
                <div class="col-md-3">
                    <div class="card shadow-sm h-100 border-info">
                        <div class="card-header bg-info text-white py-2">
                            <h6 class="mb-0 fw-semibold"><i class="fas fa-users me-2"></i>Datos del conductor</h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="mb-3">
                                <label for="idselecttransportista" class="form-label small fw-bold">Transportista</label>
                                <select class="form-select form-select-sm" id="idselecttransportista" name="idtransportista" required>
                                    <option value="">Seleccionar...</option>
                                    @forelse($transportes as $transporte)
                                        <option value="{{ $transporte->idtransportista }}" 
                                            {{ (isset($guia) && isset($guia->idtransportista) && $guia->idtransportista == $transporte->idtransportista) ? 'selected' : '' }}>
                                            {{ $transporte->nombre_razonsocial }}
                                        </option>
                                    @empty
                                        <option value="" disabled>No hay transportistas</option>
                                    @endforelse
                                </select>
                                <div class="invalid-feedback">Seleccione un transportista</div>
                            </div>
                            <div class="mb-3">
                                <label for="idselectidconductor" class="form-label small fw-bold">Conductor</label>
                                <select class="form-select form-select-sm" id="idselectidconductor" name="idconductor" required>
                                    <option value="">Seleccionar...</option>
                                    @if(isset($guia))
                                        @foreach ($conductores as $conductor)
                                            <option value="{{ $conductor->idconductor }}" 
                                                {{ ($guia->idconductor == $conductor->idconductor) ? 'selected' : '' }}>
                                                {{ $conductor->nombre }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="invalid-feedback">Seleccione un conductor</div>
                            </div>
                            <div>
                                <label for="idtxtobservaciones" class="form-label small fw-bold">Observaciones</label>
                                <input type="text" class="form-control form-control-sm" id="idtxtobservaciones"
                                    name="observaciones" value="{{ $guia->observaciones ?? '' }}">
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
                                    <option value="{{ $empresa->idtipoempresa }}" 
                                        {{ (isset($guia) && $guia->idtipoempresa == $empresa->idtipoempresa) ? 'selected' : '' }}>
                                        {{ $empresa->razonsocial }}
                                    </option>
                                @empty
                                    <option value="" disabled>No hay empresas</option>
                                @endforelse
                            </select>
                            <div class="invalid-feedback">Seleccione una empresa receptora</div>
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
                        <!-- Nombre del Producto (select) -->
                        <div class="col-md-4">
                            <label for="idselectnombreproducto" class="form-label small fw-bold">Nombre del Producto</label>
                            <select class="form-select form-select-sm" id="idselectnombreproducto" required>
                                <option value="">Seleccionar...</option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->idproducto }}" data-codigo="{{ $producto->codigoproducto }}">
                                        {{ $producto->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Código del Producto (autocompletado) -->
                        <div class="col-md-3">
                            <label for="idtxtcodigoproducto" class="form-label small fw-bold">Código</label>
                            <input type="text" class="form-control form-control-sm" id="idtxtcodigoproducto" readonly>
                            <input type="hidden" id="idproductocarritogiaremision">
                        </div>

                        <!-- Cantidad -->
                        <div class="col-md-2">
                            <label for="idtxtcantidadproducto" class="form-label small fw-bold">Cantidad</label>
                            <input type="number" class="form-control form-control-sm" id="idtxtcantidadproducto" required>
                        </div>

                        <!-- Estado -->
                        <div class="col-md-2">
                            <label for="idselectestadoproducto" class="form-label small fw-bold">Estado</label>
                            <select class="form-select form-select-sm" id="idselectestadoproducto" required>
                                <option value="Bueno">Bueno</option>
                            </select>
                        </div>

                        <!-- Botón Agregar -->
                        <div class="col-md-1">
                            <button type="button" class="btn btn-primary btn-sm h-100" id="idbtnagregarproducto" title="Agregar producto">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Tabla de productos agregados -->
                    <div class="border rounded overflow-y-auto" style="max-height:500px; overflow-y: auto; border: 1px solid #dee2e6;">
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
                                @if(isset($detalleGuia) && count($detalleGuia) > 0)
                                    @foreach($detalleGuia as $detalle)
                                        <tr data-id="{{ $loop->index }}">
                                            <td>{{ $detalle['codproducto'] ?? 'N/A' }}</td>
                                            <td>{{ $detalle['producto'] ?? 'N/A' }}</td>
                                            <td>{{ $detalle['cant'] ?? 0 }}</td>
                                            <td>{{ $detalle['condicion'] ?? 'Bueno' }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-danger btn-sm btn-eliminar">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-end mt-3 gap-2">
                <a href="{{ route('vistaguiasderemision') }}" class="btn btn-outline-danger btn-sm px-3">
                    <i class="fas fa-times-circle me-1"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-success btn-sm px-3">
                    <i class="fas fa-save me-1"></i> {{ isset($guia) ? 'Actualizar' : 'Guardar' }}
                </button>
            </div>
        </form>
    </div>

    @if(isset($detalleGuia) && count($detalleGuia) > 0)
        <script>
            // Cargar productos existentes en el array global
            document.addEventListener('DOMContentLoaded', function() {
                @foreach($detalleGuia as $index => $detalle)
                    productos.push({
                        id: {{ $index }},
                        idproducto: '{{ $detalle['idproducto'] ?? '' }}',
                        codigo: '{{ $detalle['codproducto'] ?? '' }}',
                        nombre: '{{ $detalle['producto'] ?? '' }}',
                        cantidad: {{ $detalle['cant'] ?? 0 }},
                        estado: '{{ $detalle['condicion'] ?? 'Bueno' }}'
                    });
                @endforeach
                contadorId = {{ count($detalleGuia) }};
            });
        </script>
    @endif
@endsection