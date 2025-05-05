<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;
use Exception;

class ProductoController extends Controller
{
    //Para registrar el producto
    public function registrarProducto(Request $request) {
        try{
            $validated = $request->validate([
                'nombre' => 'required',
                'sku' => 'required',
                'estado' => 'required',
                'fecharegistro' => 'required'
            ]);

            $modeloproducto = new Productos();
            $producto = $modeloproducto->insertarproductos($validated);

            if(!$producto["success"]){
                throw new Exception($producto["message"]);
            }

            return response()->json([
                'success' => true,
                'message' => $producto["message"],
                'data' => $producto["data"]
            ]);
        }catch (\Exception $ex){
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar el producto: '.$ex->getMessage(),
                'error_details' => env('APP_DEBUG') ? $ex->getTrace() : null
            ], 500);
        }
    }
    //Para eliminar el producto
    public function eliminarProducto($id)
    {
        try {
            $modelo = new Productos();
            $resultado = $modelo->eliminarProducto($id);

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
                'message' => 'Error al eliminar el producto: '.$ex->getMessage()
            ], 500);
        }
    }
}
