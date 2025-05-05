<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;
use Exception;

class ProductoController extends Controller
{
    public function registrarProducto(Request $request) {
        try{
            $validated = $request->validate([
                'nombre' => 'required',
                'sku' => 'required',
                'estado' => 'required',
                'fecharegistro' => 'required'
            ]);

            $modeloproducto = new Productos();
            $producto = $modeloproducto->insertarproductos([
                "nombre" => $validated['nombre'],
                "sku" => $validated['sku'],
                "estado" => $validated['estado'],
                "fecharegistro" => $validated['fecharegistro']
            ]);

            if(!$producto["success"]){
                throw new Exception($producto["message"]);
            }

            return response()->json([
                'success' => true,
                'message' => $producto["message"],
            ]);
        }catch (\Exception $ex){
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar el producto: '.$ex->getMessage(),
                'error_details' => env('APP_DEBUG') ? $ex->getTrace() : null
            ], 500);
        }
    }
}
