<?php

namespace App\Livewire\Usuarios;

use App\Models\User;
use Livewire\Component;

class Usuarios extends Component
{
    public $usuarios;
    public $name, $email, $password, $role;
    public $userId;
    public $isEditing = false;

    public function mount()
    {
        $this->loadUsuarios();
        $this->role = 'prevencionista';

    }

    public function loadUsuarios()
    {
        $this->usuarios = User::orderBy('name')->get();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:administrador,prevencionista',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => $this->role,
            'idrol' => $this->role === 'administrador' ? 1 : 2,
        ]);

        $this->reset(['name', 'email', 'password', 'role']);
        $this->isEditing = false;
        $this->loadUsuarios();
        $this->dispatch('usuarioGuardado');
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $this->userId = $usuario->id;
        $this->name = $usuario->name;
        $this->email = $usuario->email;
        $this->role = $usuario->role;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'role' => 'required|in:administrador,prevencionista',
        ]);

        $usuario = User::findOrFail($this->userId);

        // Evitar cambiar el rol del último usuario de su tipo
        if ($this->role !== $usuario->role) {
            $cuantos = User::where('role', $usuario->role)->count();
            if ($cuantos <= 1) {
                $this->dispatch('usuarioNoEditado', ['message' => 'No puedes cambiar el rol del último usuario ' . $usuario->role]);
                return;
            }
        }

        $usuario->update([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'idrol' => $this->role === 'administrador' ? 1 : 2,
        ]);

        $this->reset(['name', 'email', 'password', 'role', 'userId']);
        $this->isEditing = false;
        $this->loadUsuarios();
        $this->dispatch('usuarioEditado');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $cuantosRol = User::where('role', $user->role)->count();

        if ($cuantosRol <= 1) {
            $this->dispatch('usuarioNoEliminado', ['message' => 'No puedes eliminar al último usuario con rol ' . $user->role]);
            return;
        }

        $user->delete();
        $this->loadUsuarios();
        $this->dispatch('usuarioEliminado');
    }

    public function render()
    {
        return view('livewire.usuarios.usuarios');
    }
}
