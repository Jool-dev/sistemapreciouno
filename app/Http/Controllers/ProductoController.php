<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;
use Exception;

class ProductoController extends Controller
{
    //Para registrar el producto
    public function registrarproducto(Request $request) {
        try{
            $validated = $request->validate([
//                "idvehiculo" => "nullable",
                'codigoproducto' => 'required',
                'nombre' => 'required',
                'tipoinventario' => 'required',
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
        }
        catch (\Exception $ex){
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar el producto: '.$ex->getMessage(),
                'error_details' => env('APP_DEBUG') ? $ex->getTrace() : null
            ], 500);
        }
    }

    //Para eliminar el producto
    public function eliminarproducto($id)
    {
        try {
            $modelo = new Productos();
            $resultado = $modelo->eliminarproducto($id);

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

    public function buscarproductocodigo(Request $request) {
        try{
            $validated = $request->validate([
                'codigoproducto' => 'required',
            ]);

            $modeloproducto = new Productos();
            $producto = $modeloproducto->mostraproducto([
                "codigoproducto" => $validated["codigoproducto"]
            ]);

            if($producto["data"] === null){
                return response()->json([
                    'success' => true,
                    "message" => "CodigoNo encontrado",
                    "data" => null
                ]);
            }else{
                return response()->json([
                    'success' => true,
                    'message' => $producto["message"],
                    'data' => $producto["data"]
                ]);
            }
        }catch (\Exception $ex){
            return response()->json([
                'success' => false,
                'message' => 'Error al buscar por codigo el producto: '.$ex->getMessage(),
                'error_details' => env('APP_DEBUG') ? $ex->getTrace() : null
            ], 500);
        }
    }
}
