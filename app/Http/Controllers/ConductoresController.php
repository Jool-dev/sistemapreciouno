<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Conductores;
use Illuminate\Support\Facades\DB;

class ConductoresController extends Controller
{
    //Para registrar el conductor
    public function mantenimientoconductor(Request $request) {
        try{
            $validated = $request->validate([
                "idconductor" => "nullable",
                'nombre' => 'required',
                'dni' => 'required',
                'idtransportista' => 'required',
                'idvehiculo' => 'required'
            ]);

            // Verificar si el DNI ya existe
            $existeConductor = DB::table('conductores')
                ->where('dni', $validated['dni'])
                ->exists();

            if ($existeConductor) {
                throw new \Exception('Ya existe un conductor con este DNI');
            }

            $modeloconductor = new Conductores();
//            $conductor = $modeloconductor->insertarconductores($validated);
            if($validated['idconductor'] === null){
                $conductor = $modeloconductor->insertarconductores([
                    "nombre" => $validated['nombre'],
                    "dni" => $validated['dni'],
                    "idtransportista" => $validated['idtransportista'],
                    "idvehiculo" => $validated['idvehiculo']
                ]);
            }
            else{
                $conductor = $modeloconductor->editarconductores([
                    "idconductor" => $validated['idconductor'],
                    "nombre" => $validated['nombre'],
                    "dni" => $validated['dni'],
                    "idtransportista" => $validated['idtransportista'],
                    "idvehiculo" => $validated['idvehiculo']
                ]);
            }
            if(!$conductor["success"]){
                throw new Exception($conductor["message"]);
            }

            return response()->json([
                'success' => true,
                'message' => $conductor["message"],
                'data' => $conductor["data"]
            ]);
        }catch (\Exception $ex){
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar el conductor: '.$ex->getMessage(),
                'error_details' => env('APP_DEBUG') ? $ex->getTrace() : null
            ], 500);
        }
    }
    //Para eliminar el conductor
    public function eliminarConductor($id)
    {
        try {
            $modeloconductor = new Conductores();
            $resultado = $modeloconductor->editarconductores($id);

            if(!$resultado["success"]){
                throw new Exception($resultado["message"]);
            }

            return response()->json([
                'success' => true,
                'message' => $resultado["message"]
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el Conductor: '.$ex->getMessage()
            ], 500);
        }
    }
}
