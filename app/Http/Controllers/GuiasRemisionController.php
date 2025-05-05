<?php

namespace App\Http\Controllers;
use App\Models\Guiasderemision;
use Illuminate\Http\Request;
use Exception;

class GuiasRemisionController extends Controller
{
    // public function mostrarGuiasRemision(Request $request)
    // {
    //     try {
    //         $validated = $request->validate([
    //             'idguia' => 'nullable|integer',
    //             'tim' => 'nullable|string',
    //             'fechaemision' => 'nullable|date',
    //             'horaemision' => 'nullable|string',
    //             'motivotraslado' => 'nullable|string',
    //             'origen' => 'nullable|string',
    //             'destino' => 'nullable|string',
    //             'estado' => 'nullable|string'
    //         ]);

    //         $modeloguiaremision = new Guiasderemision();
    //         $guiasremision = $modeloguiaremision->mostrarguiasderemision($validated);

    //         return response()->json([
    //             'success' => true,
    //             'data' => $guiasremision
    //         ]);
    //     } catch (\Exception $ex) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Error al mostrar las guías de remisión: '.$ex->getMessage(),
    //             'error_details' => env('APP_DEBUG') ? $ex->getTrace() : null
    //         ], 500);
    //     }
    // }

    public function registrarGuiaRemision(Request $request)
    {
        try {
            $validated = $request->validate([
                'tim' => 'required',
                'fechaemision' => 'required',
                'horaemision' => 'required',
                'motivotraslado' => 'required',
                'origen' => 'required',
                'destino' => 'required',
                'estado' => 'required',
                'cantidadenviada' => 'required'
            ]);

            $modeloguiaremision = new Guiasderemision();
            $guiasremision = $modeloguiaremision->insertarGuiasRemision([
                "tim" => $validated['tim'],
                "fechaemision" => $validated['fechaemision'],
                "horaemision" => $validated['horaemision'],
                "motivotraslado" => $validated['motivotraslado'],
                "origen" => $validated['origen'],
                "destino" => $validated['destino'],
                "estado" => $validated['estado'],
                "cantidadenviada" => $validated['cantidadenviada']
            ]);
            if (!$guiasremision["success"]) {
                throw new Exception($guiasremision["message"]);
            }
            // Si la inserción fue exitosa, puedes devolver una respuesta adecuada

            return response()->json([
                'success' => true,
                'message' => $guiasremision["message"]
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar la guía de remisión: '.$ex->getMessage(),
                'error_details' => env('APP_DEBUG') ? $ex->getTrace() : null
            ], 500);
        }
    }
}
