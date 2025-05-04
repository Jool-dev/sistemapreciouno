<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Exception;

class VehiculoController extends Controller {
    public function registrarVehiculo(Request $request) {
        try{
            $validated = $request->validate([
                'placa' => 'required',
                'marca' => 'required',
                'tipo' => 'required'
            ]);

            $modelovehiculo = new Vehiculo();
            $vehiculo = $modelovehiculo->insertarvehiculos([
                "placa" => $validated['placa'],
                "marca" => $validated['marca'],
                "tipo" => $validated['tipo']
            ]);

            if(!$vehiculo["success"]){
               throw new Exception($vehiculo["message"]);
            }

            return response()->json([
                'success' => true,
                'message' => $vehiculo["message"],
            ]);
        }catch (\Exception $ex){
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar los votos: '.$ex->getMessage(),
                'error_details' => env('APP_DEBUG') ? $ex->getTrace() : null
            ], 500);
        }
    }
}
