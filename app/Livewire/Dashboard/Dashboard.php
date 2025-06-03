<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $totalGuiasEmitidas;
    public $totalRevisiones;
    public $guiasSinDanio;
    public $guiasConDanio;
    public $ultimasGuias;
    public $guiascondiscrepancias;

    public function mount()
    {
        $this->totalGuiasEmitidas = DB::table('guiaremision')
            ->where('estado', '!=', 'Eliminado')
            ->count();

        $this->totalRevisiones = DB::table('guiaremision')
            ->where('estado', '=', 'Confirmado')
            ->count();

        $this->guiasSinDanio = DB::table('guiaremision as g')
            ->join('validacion as v', 'g.idguia', '=', 'v.idguia')
            ->where('v.idtipocondicion', 1)
            ->where('g.estado', '!=', 'Eliminado')
            ->distinct()
            ->count('g.idguia');

        $this->guiasConDanio = DB::table('guiaremision as g')
            ->join('validacion as v', 'g.idguia', '=', 'v.idguia')
            ->where('v.idtipocondicion', 2)
            ->where('g.estado', '!=', 'Eliminado')
            ->distinct()
            ->count('g.idguia');

        $this->ultimasGuias = DB::table('guiaremision')
            ->select(DB::raw('DATE(fechaemision) as fecha'), DB::raw('COUNT(*) as total'))
            ->where('estado', '!=', 'Eliminado')
            ->groupBy('fecha')
            ->orderBy('fecha', 'asc')
            ->limit(15)
            ->get();

        $this->guiascondiscrepancias = DB::table('guiaremision as g')
            ->select(
                'g.codigoguia',
                DB::raw('COUNT(DISTINCT d.idproducto) as cantidad_productos'),
                DB::raw('COUNT(v.idvalidacion) as cantidad_discrepancias')
            )
            ->leftJoin('detalleguia as d', 'd.idguia', '=', 'g.idguia')
            ->leftJoin('validacion as v', 'v.idguia', '=', 'g.idguia')
            ->groupBy('g.codigoguia')
            ->limit(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard');
    }
}
