<div>
    @php
        $usuario = session('usuariologeado')['data'][0] ?? null;
        $rol = $usuario['idrol'] == 1 ? 'administrador' : 'prevencionista';
    @endphp

    @if ($rol === 'administrador')
        <div class="container">
            <!-- Formulario de crear/editar -->
            <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}" class="mb-4">
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <input wire:model="name" type="text" class="form-control" placeholder="Nombre">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-3 mb-2">
                        <input wire:model="email" type="email" class="form-control" placeholder="Email">
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-3 mb-2">
                        <input wire:model="password" type="password" class="form-control" placeholder="Contraseña">
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-3 mb-2">
                        <select wire:model="role" class="form-control">
                            <option value="administrador">Administrador</option>
                            <option value="prevencionista">Prevencionista</option>
                        </select>
                        @error('role') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ $isEditing ? 'Actualizar' : 'Guardar' }}
                </button>
            </form>

            <!-- Tabla de usuarios -->
            <table class="table">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->idrol }}</td>
                        <td>
                            <button wire:click="edit({{ $usuario->id }})" class="btn btn-sm btn-warning">Editar</button>
                            <button wire:click="delete({{ $usuario->id }})" class="btn btn-sm btn-danger">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-danger">
            No tienes permisos para acceder a esta sección.
        </div>
    @endif
</div>
