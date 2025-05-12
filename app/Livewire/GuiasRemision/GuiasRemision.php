<?php

namespace App\Livewire\GuiasRemision;

use App\Models\Conductores;
use App\Models\Guiasderemision;
use App\Models\TipoEmpresa;
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

        // Obtener vehículos y conductores activos (nuevo)
        $conductores = Conductores::where('estado', 'activo')->get();
        $tipoempresa = TipoEmpresa::where('estado', 'activo')->get();

        return view('livewire.guias-remision.guias-remision', [
            'data' => $data["data"] == null ? [] : $data["data"],
            'conductores' => $conductores,
            'tipoempresa' => $tipoempresa,
        ]);
    }

}
