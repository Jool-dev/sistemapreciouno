<?php

namespace App\Http\Controllers;

use App\Models\Guiasderemision;
use App\Models\GuiasRevision;
use Exception;
use Illuminate\Http\Request;

class RevisionDeGuiasController extends Controller
{
    public function registrarguiarevicion_validacion(Request $request) {
        try {
            $validated = $request->validate([
                'idguia' => 'nullable',
                "productos" => 'required|array',
            ]);

            $modeloguiaremision = new GuiasRevision();
            foreach ($validated['productos'] as $p) {
                $detalleguiasremision = $modeloguiaremision->insertardetalleguiarevicion_validacion([
                    "idguia" => $validated['idguia'],
                    "idproducto" => $p["idproducto"],
                    "condicion" => $this->determinarCondicion($p["estado"]),
                    "cant" => $p["cantidad"]
                ]);

                if(!$detalleguiasremision["success"]) {
                    throw new \Exception($detalleguiasremision["message"]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => $detalleguiasremision["message"],
                'data' => $detalleguiasremision["data"]
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar la guía de remisión: '.$ex->getMessage(),
                'error_details' => env('APP_DEBUG') ? $ex->getTrace() : null
            ], 500);
        }
    }

    protected function determinarCondicion($estado): int {
        switch(strtolower($estado)) {
            case 'bueno':
            case '1':
                return 1;
            case 'dañado':
            case '2':
                return 2;
            case 'regular':
            case '3':
            default:
                return 3;
        }
    }
}
