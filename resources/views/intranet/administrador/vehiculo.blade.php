@extends('intranet/layout')
@section('title', 'Vehiculo')

@section('content')
    <div class="container-fluid py-2">
        <!-- Barra de búsqueda y acciones -->
        <div class="row mb-4 align-items-center">
            <!-- Campo de búsqueda -->
            <div class="col-md-5 mb-2 mb-md-0">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="Buscar por nombre o código..."
                        wire:model.live.debounce.500ms="search" aria-label="Buscar productos">
                </div>
            </div>

            <!-- Selector de items por página -->
            <div class="col-md-3 mb-2 mb-md-0">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-list-ol"></i>
                    </span>
                    <select class="form-select" wire:model.live="perPage" aria-label="Items por página">
                        <option value="10">10 por página</option>
                        <option value="25">25 por página</option>
                        <option value="50">50 por página</option>
                        <option value="100">100 por página</option>
                    </select>
                </div>
            </div>
            <!-- Botón de agregar -->
            <div class="col-md-4 text-md-end">
                <button type="button" class="btn btn-primary w-40 w-md-auto" data-bs-toggle="modal"
                    data-bs-target="#idmodalvehiculo">
                    <i class="fa-solid fa-plus me-2"></i>
                    Nuevo Vehículo
                </button>
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
                            <label for="placasecundaria" class="form-label">Placa Secundaria</label>
                            <input type="text" class="form-control" id="idtxtplacasecundaria" name="placasecundaria"
                                required>
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
