@extends('intranet/layout')
@section('title', 'Conductores')

@section('content')
    <div class="container-fluid py-2">
        <!-- Título -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Conductores</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#idmodalConductoress">
                <i class="fa-solid fa-plus-minus"></i>
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
        @livewire('conductoress.conductoress')
    </div>

    <!-- Modal -->
    <div class="modal fade" id="idmodalConductoress" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Conductor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="idformConductores" class="needs-validation">
                        @csrf
                        <input type="hidden" id="idconductor" name="idconductor" value="">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="idtxtnombre" name="nombre" required>
                        </div>

                        <div class="mb-3">
                            <label for="dni" class="form-label">DNI</label>
                            <input type="text" class="form-control" id="idtxtdni" name="dni" required>
                        </div>

                        <div class="row">
                            <div class="row">
                                <div class="mb-3">
                                    <label for="idtransporte" class="form-label">Transporte</label>
                                    <select class="form-select" id="idselecttransporte" name="idtransporte" required>
                                        <option value="">Seleccione un transporte...</option>
                                        @forelse($transportes as $transporte)
                                            <option value="{{ $transporte['idtransportista'] }}">
                                                {{ $transporte['ruc_transportista'] }} - {{ $transporte['nombre_razonsocial'] }}
                                            </option>
                                        @empty
                                            <option value="" disabled>No hay transportes disponibles</option>
                                        @endforelse
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="idvehiculo" class="form-label">Vehículo</label>
                                    <select class="form-select" id="idselectvehiculo" name="idvehiculo" required>
                                        <option value="">Seleccione un vehículo...</option>
                                        @forelse($vehiculos as $vehiculo)
                                            <option value="{{ $vehiculo['idvehiculo'] }}">
                                                {{ $vehiculo['placa'] }} - {{ $vehiculo['marca'] }}
                                            </option>
                                        @empty
                                                <option value="" disabled>No hay vehiculos disponibles</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
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
