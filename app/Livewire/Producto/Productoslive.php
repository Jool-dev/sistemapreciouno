<?php

namespace App\Livewire\Producto;

use App\Models\Productos;
use Livewire\Attributes\On;
use Livewire\Component;

class Productoslive extends Component
{
    #[On('listarproductoDesdeJS')]
    public function listar() {}

    public function render()
    {
        $modeloproducto = new Productos();
        $data = $modeloproducto->mostraproducto();
        return view('livewire.producto.productoslive', [
            'data' => $data["data"] == null ? [] : $data["data"]
        ]);
    }
}
