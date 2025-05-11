<?php

namespace App\Http\Controllers;

use App\Models\Transporte;
use Illuminate\Http\Request;
use Exception;

class TransporteController extends Controller
{
    //Para registrar el transporte
    public function registrartransporte(Request $request) {
        try{
            $validated = $request->validate([
//                "idtransportista" => "nullable",
                'ruc_transportista' => 'required',
                'nombre_razonsocial' => 'required',
                'modalidadtraslado' => 'required',
            ]);

            $modelotransporte = new transportes();
            $transporte = $modelotransporte->insertartransportes($validated);

            if(!$transporte["success"]){
                throw new Exception($transporte["message"]);
            }

            return response()->json([
                'success' => true,
                'message' => $transporte["message"],
                'data' => $transporte["data"]
            ]);
        }catch (\Exception $ex){
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar el transporte: '.$ex->getMessage(),
                'error_details' => env('APP_DEBUG') ? $ex->getTrace() : null
            ], 500);
        }
    }
}
