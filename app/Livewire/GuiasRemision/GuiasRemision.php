<?php

namespace App\Livewire\GuiasRemision;

use App\Models\Guiasderemision;
use Livewire\Component;
use Livewire\Attributes\On;

//nombre de la clase de Livewire en HTTP lo demas es del modelo
class GuiasRemision extends Component
{
    #[On('listarGuiasRemisionDesdeJS')]
    public function listar() {}

    public function render() {
        $modeloguiaremision = new Guiasderemision();
        $data = $modeloguiaremision->mostrarguiasderemision();
        return view('livewire.guias-remision.guias-remision', [
            'data' => $data["data"] == null ? [] : $data["data"]
        ]);
    }

}
