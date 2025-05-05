<?php

namespace App\Livewire\Vehiculo;

use App\Models\Vehiculo;
use Livewire\Attributes\On;
use Livewire\Component;

class Vechiculo extends Component {
    public array $vehiculos = [];

    #[On('listarvehiculoDesdeJS')]
    public function listar(): void {
        $modelovecino = new Vehiculo();
        $data = $modelovecino->mostravehiculo();
        $this->vehiculos = $data["data"] == null ? [] : $data["data"];
        $this->render();
    }

    public function mount(): void {
        $this->listar();
    }

    public function render() {
        return view('livewire.vehiculo.vechiculo', [
            'vehiculos' => $this->vehiculos
        ]);
    }
}

//class Vechiculo extends Component
//{
//    #[On('listarvehiculoDesdeJS')]
//    public function listar() {}
//
//    public function render() {
//        $modelovecino = new Vehiculo();
//        $data = $modelovecino->mostravehiculo();
//        return view('livewire.vehiculo.vechiculo', [
//            'data' => $data["data"] == null ? [] : $data["data"]
//        ]);
//    }
//}
