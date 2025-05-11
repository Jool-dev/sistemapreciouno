<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Exception;

class VehiculoController extends Controller {
    public function mantenimientovehiculo(Request $request) {
        try{
            $validated = $request->validate([
                "idvehiculo" => "nullable",
                'placa' => 'required',
                'placasecundaria' => 'required',
            ]);

            $modelovehiculo = new Vehiculo();
            if($validated['idvehiculo'] === null){
                $vehiculo = $modelovehiculo->insertarvehiculos([
                    "placa" => $validated['placa'],
                    "placasecundaria" => $validated['placasecundaria'],
                ]);
            }
            else{
                $vehiculo = $modelovehiculo->editarvehiculo([
                    "idvehiculo" => $validated['idvehiculo'],
                    "placa" => $validated['placa'],
                    "placasecundaria" => $validated['placasecundaria'],
                ]);
            }

            if(!$vehiculo["success"]){
               throw new Exception($vehiculo["message"]);
            }

            return response()->json([
                'success' => true,
                'message' => $vehiculo["message"],
            ]);
        }
        catch (\Exception $ex){
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar el vehiculo: '.$ex->getMessage(),
                'error_details' => env('APP_DEBUG') ? $ex->getTrace() : null
            ], 500);
        }
    }

    public function eliminarvehiculo(Request $request) {
        try {
            $validated = $request->validate([
                "idvehiculo" => "nullable",
            ]);

            $modelovehiculo = new Vehiculo();
            $vehiculo = $modelovehiculo->editarvehiculo([
                "idvehiculo" => $validated['idvehiculo'],
                "estado" => "Eliminado"
            ]);

            if(!$vehiculo["success"]){
                throw new Exception($vehiculo["message"]);
            }

            return response()->json([
                'success' => true,
                'message' => "Eliminado correctamente",
            ]);
        }
        catch (\Exception $ex){
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el vehiculo: '.$ex->getMessage(),
                'error_details' => env('APP_DEBUG') ? $ex->getTrace() : null
            ], 500);
        }
    }
}
