<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GuiaRemisionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->idguia,
            'codigo' => $this->codigoguia,
            'fecha_emision' => $this->fechaemision,
            'hora_emision' => $this->horaemision,
            'razon_social' => $this->razonsocialguia,
            'numero_tim' => $this->numerotrasladotim,
            'motivo_traslado' => $this->motivotraslado,
            'peso_bruto_total' => (float) $this->pesobrutototal,
            'volumen_producto' => (float) $this->volumenproducto,
            'numero_bulto_pallet' => $this->numerobultopallet,
            'observaciones' => $this->observaciones,
            'estado' => $this->estado,
            'conductor' => new ConductorResource($this->whenLoaded('conductor')),
            'empresa' => new EmpresaResource($this->whenLoaded('tipoempresa')),
            'productos' => ProductoResource::collection($this->whenLoaded('productos')),
        ];
    }
}