<?php

namespace App\Models;

use App\Models\Global\GlobalModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DetalleGuia extends Model
{
    protected $table = 'detalle_guias';
    protected $primaryKey = 'iddetalleguia';

    public function guia()
    {
        return $this->belongsTo(Guiasderemision::class, 'idguia');
    }

    public function producto()
    {
        return $this->belongsTo(Productos::class, 'idproducto');
    }
}
