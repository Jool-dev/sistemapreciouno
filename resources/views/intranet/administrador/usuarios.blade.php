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
                           id="filtroTabla"
                           class="form-control"
                           placeholder="Buscar usuario">
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
                        data-bs-target="#idmodalUsuarios">
                    <i class="fa-solid fa-plus me-2"></i>
                    Nuevo Usuario
                </button>
            </div>
        </div>
        <div class="enable-scroll">
            <!-- Tabla (el ordenamiento va dentro del componente Livewire) -->
            @livewire('usuarios.gestionusuario')
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="idmodalUsuarios" tabindex="-1" aria-labelledby="idlabeltitleidmodalUsuarios"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="idlabeltitleidmodalUsuarios">Agregar Nuevo Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form id="idformusuario" class="needs-validation">
                        @csrf
                        <input type="hidden" id="idusuario" name="idusuario" value="">

                        <div class="mb-3">
                            <label for="idtxtnombre" class="form-label">Nombre del Usuario</label>
                            <input type="text" class="form-control" id="idtxtnombre" name="nombre" required>
                        </div>

                        <div class="mb-3">
                            <label for="idtxtemail" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="idtxtemail" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="idtxtpassword" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="idtxtpassword" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="idselectrol" class="form-label">Rol</label>
                            <select class="form-select" id="idselectrol" name="idrol" required>
                                <option value="">Seleccione un rol</option>
                                <option value="1">Administrador</option>
                                <option value="2">Prevnecionista</option>
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const input = document.getElementById("filtroTabla");
        const tabla = document.querySelector("table");
        const filas = tabla.querySelectorAll("tbody tr");

        input.addEventListener("keyup", function () {
            const valor = this.value.toLowerCase();

            filas.forEach(fila => {
                const textoFila = fila.textContent.toLowerCase();
                fila.style.display = textoFila.includes(valor) ? "" : "none";
            });
        });
    });
</script>
