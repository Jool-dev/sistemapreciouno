<?php

namespace App\Http\Controllers;

use App\Models\Guiasderemision;
use Illuminate\Http\Request;
use Exception;

use App\Models\Conductores;
use App\Models\TipoEmpresa;
use App\Models\Productos;
use App\Models\Transporte;

class GuiasRemisionController extends Controller
{
    public function registrarguiaremision(Request $request)
    {
        try {
            $validated = $request->validate([
                'codigoguia' => 'required',
                'fechaemision' => 'required',
                'horaemision' => 'required',
                'razonsocialguia' => 'required',
                'numerotrasladotim' => 'required',
                'motivotraslado' => 'required',
                'pesobrutototal' => 'required',
                'volumenproducto' => 'required',
                'numerobultopallet' => 'required',
                'observaciones' => 'nullable',
                'idconductor' => 'required',
                'idtipoempresa' => 'required',
                "productos" => 'required|array',
            ]);

            $modeloguiaremision = new Guiasderemision();
            $guiasremision = $modeloguiaremision->insertarguiaremision([
                "codigoguia" => $validated['codigoguia'],
                "fechaemision" => $validated['fechaemision'],
                "horaemision" => $validated['horaemision'],
                "razonsocialguia" => $validated['razonsocialguia'],
                "numerotrasladotim" => $validated['numerotrasladotim'],
                "motivotraslado" => $validated['motivotraslado'],
                "pesobrutototal" => $validated['pesobrutototal'],
                "volumenproducto" => $validated['volumenproducto'],
                "numerobultopallet" => $validated['numerobultopallet'],
                "observaciones" => $validated['observaciones'] === null ? "" : $validated['observaciones'],
                "idconductor" => $validated['idconductor'],
                "idtipoempresa" => $validated['idtipoempresa'],
            ]);
            
            if ($guiasremision["data"] === null) {
                throw new Exception($guiasremision["message"]);
            }

            foreach ($validated['productos'] as $p) {
                $detalleguiasremision = $modeloguiaremision->insertardetalleguiaremision([
                    "idguia" => $guiasremision["data"][0]['idguia'],
                    "idproducto" => $p["idproducto"],
                    "condicion" => $p["estado"],
                    "cant" => $p["cantidad"]
                ]);

                if (!$detalleguiasremision["success"]) {
                    throw new \Exception("Error al registrar el detalleGuia");
                }
            }

            return response()->json([
                'success' => true,
                'message' => $guiasremision["message"],
                'data' => $guiasremision["data"]
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar la guía de remisión: ' . $ex->getMessage(),
                'error_details' => env('APP_DEBUG') ? $ex->getTrace() : null
            ], 500);
        }
    }

    public function vistaguias(Request $request)
    {
        $idguia = $request->query('idguia');

        $conductores = Conductores::all();
        $tipoempresa = TipoEmpresa::all();
        $productos = Productos::all();
        $transportes = Transporte::all();

        $guia = null;
        $detalleGuia = [];
        
        if ($idguia) {
            $modeloguiaremision = new Guiasderemision();
            $guiaData = $modeloguiaremision->mostrarguiasderemision(['idguia' => $idguia]);
            $guia = $guiaData['data'][0] ?? null;
            
            // Obtener el detalle de la guía para edición
            if ($guia) {
                $detalleData = $modeloguiaremision->mostrardetalleguia(['idguia' => $idguia]);
                $detalleGuia = $detalleData['data'] ?? [];
            }
        }

        return view('intranet.prevencionistas.addguiasremision', compact(
            'conductores', 'tipoempresa', 'productos', 'transportes', 'guia', 'detalleGuia'
        ));
    }

    public function eliminarguia(Request $request)
    {
        try {
            $validated = $request->validate([
                "idguia" => "required",
            ]);

            $modeloguiaremision = new Guiasderemision();
            $guiasremision = $modeloguiaremision->editarguia([
                "idguia" => $validated['idguia'],
                "estado" => "Eliminado"
            ]);

            if (!$guiasremision["success"]) {
                throw new Exception($guiasremision["message"]);
            }

            return response()->json([
                'success' => true,
                'message' => "Eliminado correctamente",
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la guia: ' . $ex->getMessage(),
                'error_details' => env('APP_DEBUG') ? $ex->getTrace() : null
            ], 500);
        }
    }
}