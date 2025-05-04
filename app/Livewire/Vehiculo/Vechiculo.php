<?php

namespace App\Livewire\Vehiculo;

use App\Models\Vehiculo;
use Livewire\Attributes\On;
use Livewire\Component;

class Vechiculo extends Component
{
    #[On('listarvehiculoDesdeJS')]
    public function listar() {}

    public function render() {
        $modelovecino = new Vehiculo();
        $data = $modelovecino->mostravehiculo();
        return view('livewire.vehiculo.vechiculo', [
            'data' => $data["data"] == null ? [] : $data["data"]
        ]);
    }
}
