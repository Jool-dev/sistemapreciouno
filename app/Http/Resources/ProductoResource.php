<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->idproducto,
            'codigo' => $this->codigoproducto,
            'nombre' => $this->nombre,
            'tipo_inventario' => $this->tipoinventario,
            'fecha_registro' => $this->fecharegistro,
            'estado' => $this->estado,
        ];
    }
}