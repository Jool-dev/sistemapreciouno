<?php

namespace App\Livewire\Usuarios;

use Livewire\Component;
use App\Models\User;

class Usuarios extends Component
{
    public $usuarios;
    public $usuario_id;
    public $name;
    public $email;
    public $password;
    public $isEditing = false;
    public $role = 'prevencionista'; // Añade esta propiedad

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->usuario_id,
            'role' => 'required|in:admin,prevencionista' // Añade esta regla
        ];

        if (!$this->isEditing) {
            $rules['password'] = 'required|min:6';
        }

        return $rules;
    }

    public function mount()
    {
        $this->loadUsuarios();
    }

    public function render()
    {
        return view('livewire.usuarios.usuarios');
    }

    public function loadUsuarios()
    {
        $this->usuarios = User::orderBy('id', 'desc')->get();
    }

    public function store()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => $this->role // Añade esto
        ]);

        $this->resetForm();
        $this->loadUsuarios();
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $this->usuario_id = $usuario->id;
        $this->name = $usuario->name;
        $this->email = $usuario->email;
        $this->role = $usuario->role; // Añade esto
        $this->password = '';
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate();

        $usuario = User::findOrFail($this->usuario_id);
        $usuario->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password ? bcrypt($this->password) : $usuario->password,
            'role' => $this->role // Añade esto
        ]);

        $this->resetForm();
        $this->loadUsuarios();
    }

    public function delete($id)
    {
        User::destroy($id);
        $this->resetForm();
        $this->loadUsuarios();
    }

    public function resetForm()
    {
        $this->usuario_id = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->role = 'prevencionista'; // Añade esto
        $this->isEditing = false;
    }
}
