<?php

namespace App\Livewire\Guiasderemision;

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
        $this->emit('listarGuiasRemisionDesdeJS', [
            'data' => $data["data"] == null ? [] : $data["data"]
        ]);
        return view('livewire.guias-remision.guias-remision');
    }
    
}
