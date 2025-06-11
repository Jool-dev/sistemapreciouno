<?php

namespace App\Services;

use App\Models\Guiasderemision;
use App\Models\GuiasRevision;
use Illuminate\Support\Facades\DB;

class GuiaRemisionService
{
    public function createGuiaWithProducts(array $guiaData, array $productos): array
    {
        DB::beginTransaction();
        
        try {
            $modeloguiaremision = new Guiasderemision();
            $guiasremision = $modeloguiaremision->insertarguiaremision($guiaData);
            
            if ($guiasremision["data"] === null) {
                throw new \Exception($guiasremision["message"]);
            }

            foreach ($productos as $producto) {
                $detalleguiasremision = $modeloguiaremision->insertardetalleguiaremision([
                    "idguia" => $guiasremision["data"][0]['idguia'],
                    "idproducto" => $producto["idproducto"],
                    "condicion" => $producto["estado"],
                    "cant" => $producto["cantidad"]
                ]);

                if (!$detalleguiasremision["success"]) {
                    throw new \Exception("Error al registrar el detalleGuia");
                }
            }
            
            DB::commit();
            return $guiasremision;
            
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    
    public function validateGuia(int $idguia, array $productos): array
    {
        DB::beginTransaction();
        
        try {
            $modeloguiarevision = new GuiasRevision();
            
            foreach ($productos as $producto) {
                $detalleguiasremision = $modeloguiarevision->insertardetalleguiarevicion_validacion([
                    "idguia" => $idguia,
                    "idproducto" => $producto["idproducto"],
                    "condicion" => $this->determinarCondicion($producto["estado"]),
                    "cant" => $producto["cantidad"]
                ]);

                if (!$detalleguiasremision["success"]) {
                    throw new \Exception($detalleguiasremision["message"]);
                }
            }
            
            DB::commit();
            return ['success' => true, 'message' => 'Validación completada'];
            
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    
    private function determinarCondicion($estado): int
    {
        return match (strtolower($estado)) {
            'bueno', '1' => 1,
            'dañado', '2' => 2,
            'regular', '3' => 3,
            default => 3,
        };
    }
}