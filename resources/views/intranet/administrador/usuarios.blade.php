@extends('intranet.layout')
@section('title', 'Usuarios')

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
                    <input type="text"
                           class="form-control"
                           placeholder="Buscar por nombre o código..."
                           wire:model.live.debounce.500ms="search"
                           aria-label="Buscar usuarios">
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
                <button type="button"
                        class="btn btn-primary w-40 w-md-auto"
                        data-bs-toggle="modal"
                        data-bs-target="#idmodalUsuarios">
                    <i class="fa-solid fa-plus me-2"></i>
                    Nuevo Usuario
                </button>
            </div>
        </div>
        <!-- Componente Livewire -->
        @livewire('usuarios.usuarios')
    </div>
    <!-- Modal -->
    <div class="modal fade" id="#idmodalUsuarios" tabindex="-1" aria-labelledby="idlabeltitlemodalusuarios" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="idlabeltitlemodalusuarios">Agregar Nuevo Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="idformusuario" class="needs-validation">
                        @csrf
                        <input type="hidden" id="idusuario" name="idusuario" value="">
                        <div class="mb-3">
                            <label for="codigousuario" class="form-label">Codigo usuario</label>
                            <input type="text" class="form-control" id="idtxtcodigousuario" name="codigousuario" required>
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Del usuario</label>
                            <input type="text" class="form-control" id="idtxtnombre" name="nombre" required>
                        </div>

                        <div class="mb-3">
                            <label for="tipoinventario" class="form-label">Tipo De Inventario</label>
                            <select class="form-select" id="idselectinventario" name="tipoinventario" required>
                                <option value="">Seleccione un tipo de inventario para el usuario</option>
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

@push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            window.livewire.on('closeModal', () => {
                // Aquí puedes agregar lógica para cerrar modales si usas alguno
            });
        });
    </script>
@endpush
