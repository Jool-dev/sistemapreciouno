<?php

namespace App\Livewire\Conductoress;

use App\Models\Conductores;
use Livewire\Attributes\On;
use App\Models\Transporte;
use App\Models\Vehiculo;
use Livewire\Component;

class Conductoress extends Component
{
    #[On('listarconductoresDesdeJS')]
    public function listar() {}

    public function render()
    {
        $modeloconductores = new Conductores();
        //      Obtener datos principales (sin cambiar tu lógica actual)
        $data = $modeloconductores->mostrarconductores();

        //      Obtener transportes y vehículos activos (nuevo)
        $transportes = Transporte::where('estado', 'activo')->get();
        $vehiculos = Vehiculo::where('estado', 'activo')->get();
        return view('livewire.conductoress.conductoress', [
            'data' => $data["data"] == null ? [] : $data["data"],
            'transportes' => $transportes,
            'vehiculos' => $vehiculos,
        ]);
    }
}
