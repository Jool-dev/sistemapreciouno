@extends('intranet/layout')
@section('title', 'Productos')

@section('content')
    <div class="container-fluid py-2">
        <!-- Título -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Productos</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#idmodalProductos">
                <i class="fa-solid fa-plus-minus"></i>
                Agregar Nuevo Producto
            </button>
        </div>

        <!-- Barra de búsqueda -->
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text"
                       class="form-control"
                       placeholder="Buscar por nombre o código..."
                       wire:model.live.debounce.500ms="search">
            </div>
            <div class="col-md-2">
                <select class="form-select" wire:model.live="perPage">
                    <option value="10">10 por página</option>
                    <option value="25">25 por página</option>
                    <option value="50">50 por página</option>
                    <option value="100">100 por página</option>
                </select>
            </div>
        </div>

        <!-- Tabla (el ordenamiento va dentro del componente Livewire) -->
        @livewire('producto.productoslive')
    </div>

    <!-- Modal -->
    <div class="modal fade" id="idmodalProductos" tabindex="-1" aria-labelledby="idlabeltitlemodalproductos" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="idlabeltitlemodalproductos">Agregar Nuevo Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="idformproducto" class="needs-validation">
                        @csrf
                        <input type="hidden" id="idproducto" name="idproducto" value="">
                        <div class="mb-3">
                            <label for="codigoproducto" class="form-label">Codigo Producto</label>
                            <input type="text" class="form-control" id="idtxtcodigoproducto" name="codigoproducto" required>
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Del Producto</label>
                            <input type="text" class="form-control" id="idtxtnombre" name="nombre" required>
                        </div>

                        <div class="mb-3">
                            <label for="tipoinventario" class="form-label">Tipo De Inventario</label>
                            <select class="form-select" id="idselectinventario" name="tipoinventario" required>
                                <option value="">Seleccione un tipo de inventario para el producto</option>
                                <option value="Tottus Oriente">Tottus Oriente</option>
                                <option value="Tottus">Tottus</option>
                            </select>
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
