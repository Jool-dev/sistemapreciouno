@extends('intranet/layout')
@section('title', 'Vehiculo')

@section('content')
    <div class="container-fluid py-2">
        <!-- Título -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Vehiculos</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#idmodalvehiculo" id="btnnuevovehiculo">
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
        @livewire('vehiculo.vechiculo')
    </div>

    <!-- Modal -->
    <div class="modal fade" id="idmodalvehiculo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="idlabeltitlemodalvehiculo">Nuevo Vehiculo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="idformvechiculo" class="needs-validation">
                        @csrf
                        <input type="hidden" id="idvehiculo" name="idvehiculo" value="">
                        <div class="mb-3">
                            <label for="placa" class="form-label">Placa</label>
                            <input type="text" class="form-control" id="idtxtplaca" name="placa" required>
                        </div>

                        <div class="mb-3">
                            <label for="marca" class="form-label">Marca</label>
                            <input type="text" class="form-control" id="idtxtmarca" name="marca" required>
                        </div>

                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo</label>
                            <select class="form-select" id="idselecttipo" name="tipo" required>
                                <option value="">Seleccione un Tipo</option>
                                <option value="malogrado">Malogrado</option>
                                <option value="excelente">Excelente</option>
                            </select>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary ">Guardar</button>
                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
