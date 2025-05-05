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
                    <option value="prevencionista">Prevencionista</option>
                    <option value="admin">Administrador</option>
                </select>
                @error('role') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div>
            <button type="submit" class="btn btn-success">
                {{ $isEditing ? 'Actualizar Usuario' : 'Crear Usuario' }}
            </button>
            @if($isEditing)
                <button type="button" class="btn btn-secondary" wire:click="resetForm">Cancelar</button>
            @endif
        </div>
    </form>

    <!-- Tabla de usuarios -->
    <table class="table table-bordered">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->email }}</td>
                <td>
                    <button wire:click="edit({{ $usuario->id }})" class="btn btn-warning btn-sm">Editar</button>
                    <button wire:click="delete({{ $usuario->id }})" class="btn btn-danger btn-sm"
                            onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
