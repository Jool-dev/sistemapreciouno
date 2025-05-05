@extends('intranet/layout')
@section('title','Guiasderemision')

@section('content')
    <div class="container-fluid py-2">
        <!-- Título -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Guias de Remision</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#idmodalguiasremision">
                Agregar Nuevo
            </button>
        </div>

        <!-- Barra de búsqueda -->
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Buscar...">
            </div>
        </div>

        <!-- Tabla -->
        @livewire('guias-remision.guias-remision')
    </div>

    <!-- Modal -->
    <div class="modal fade" id="idmodalguiasremision" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Guia de Remision</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="idformguiasremision" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="tim" class="form-label">Guia de Remision</label>
                            <input type="text" class="form-control" id="idtxttim" name="tim" required>
                            <div class="invalid-feedback">Por favor ingrese la tim de la guia de remision.</div>
                        </div>

                        <div class="mb-3">
                            <label for="fechaemision" class="form-label">Fecha emision</label>
                            <input type="date" class="form-control" id="fechaemision" name="fechaemision" required>
                            <div class="invalid-feedback">Por favor ingrese la fecha de emision.</div>
                        </div>

                        <div class="mb-3">
                            <label for="horaemision" class="form-label">Direccion de Destino</label>
                            <input type="time" class="form-control" id="horaemision" name="horaemision" required>
                            <div class="invalid-feedback">Por favor ingrese la hora de emision.</div>
                        </div>

                        <div class="mb-3">
                            <label for="idtxtfechadestino" class="form-label">Fecha de Destino</label>
                            <input type="text" class="form-control" id="idtxtfechadestino" name="fechadestino" required>
                            <div class="invalid-feedback">Por favor ingrese la fecha de destino.</div>
                        </div>

                        <div class="mb-3">
                            <label for="idselectvehiculo" class="form-label">Vehiculo</label>
                            <select class="form-select" id="idselectvehiculo" name="vehiculo_id" required>
                                <!-- Opciones se llenan con Livewire -->
                            </select>
                            <div class="invalid-feedback">Por favor seleccione un vehiculo.</div>
                        </div>

                        <div class="mb-3">
                            <label for="idselecttransportista" class="form-label">Transportista</label>
                            <select class="form-select" id="idselecttransportista" name="transportista_id" required>
                                <!-- Opciones se llenan con Livewire -->
                            </select>
                            <div class="invalid-feedback">Por favor seleccione un transportista.</div>
                        </div>

                        <div class="mb-3">
                            <label for="idselectdestinatario" class="form-label">Destinatario</label>
                            <select class="form-select" id="idselectdestinatario" name="destinatario_id" required>
                                <!-- Opciones se llenan con Livewire -->
                            </select>
                            <div class="invalid-feedback">Por favor seleccione un destinatario.</div>
                        </div>

                        <div class="mb-3">
                            <label for="idselectmotivo" class="form-label">Motivo</label>
                            <select class="form-select" id="idselectmotivo" name="motivo_id" required>
                                <!-- Opciones se llenan con Livewire -->
                            </select>
                            <div class="invalid-feedback">Por favor seleccione un motivo.</div>
                        </div>

                        <div class="mb-3">
                            <label for="idtxtobservacion" class="form-label">Observacion</label>
                            <textarea class="form-control" id="idtxtobservacion" name="observacion" rows="3"></textarea>
                            <div class="invalid-feedback">Por favor ingrese una observacion.</div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
