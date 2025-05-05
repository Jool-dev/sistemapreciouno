@extends('intranet/layout')
@section('title', 'Productos')

@section('content')
    <div class="container-fluid py-2">
        <!-- Título -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Productos</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#idmodalProductos">
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
        @livewire('producto.productoslive')
    </div>

    <!-- Modal -->
    <div class="modal fade" id="idmodalProductos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="idformproducto" class="needs-validation">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="idtxtnombre" name="nombre" required>
                        </div>

                        <div class="mb-3">
                            <label for="sku" class="form-label">SKU</label>
                            <input type="text" class="form-control" id="idtxtsku" name="sku" required>
                        </div>

                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="idselectestado" name="estado" required>
                                <option value="">Seleccione un estado</option>
                                <option value="malogrado">Sin daño</option>
                                <option value="excelente">Con daño</option>
                            </select>
                        </div>

{{--                        <div class="mb-3">--}}
{{--                            <label for="fecharegistro" class="form-label">Fecha de registro</label>--}}
{{--                            <input type="text" class="form-control" id="idtxtfecharegistro" name="fecharegistro" required>--}}
{{--                        </div>--}}

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <button type="reset" class="btn btn-secondary">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
