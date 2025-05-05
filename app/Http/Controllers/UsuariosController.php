<?php

namespace App\Http\Controllers;

use App\Livewire\Usuarios\Gestionusuario;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function verificarusuario(Request $request) {
        try{
            $validated = $request->validate([
                "id" => "nullable",
                'name' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]);

            $gestionusuario = new gestionusuario();
            if($validated['id'] === null){
                $usuario = $gestionusuario->insertarvehiculos([
                    "name" => $validated['name'],
                    "email" => $validated['email'],
                    "password" => $validated['password']
                ]);
            }
            else{
                $usuario = $gestionusuario->editarvehiculo([
                    "id" => $validated['id'],
                    "name" => $validated['name'],
                    "email" => $validated['email'],
                    "password" => $validated['password']
                ]);
            }

            if(!$usuario["success"]){
                throw new Exception($usuario["message"]);
            }

            return response()->json([
                'success' => true,
                'message' => $usuario["message"],
            ]);
        }
        catch (\Exception $ex){
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar los votos: '.$ex->getMessage(),
                'error_details' => env('APP_DEBUG') ? $ex->getTrace() : null
            ], 500);
        }
    }

    public function eliminarvehiculo(Request $request) {
        try {
            $validated = $request->validate([
                "id" => "nullable",
            ]);

            $gestionusuario = new Vehiculo();
            $usuario = $gestionusuario->editarvehiculo([
                "id" => $validated['id'],
                "estado" => "Eliminado"
            ]);

            if(!$usuario["success"]){
                throw new Exception($usuario["message"]);
            }

            return response()->json([
                'success' => true,
                'message' => "Eliminado correctamente",
            ]);
        }
        catch (\Exception $ex){
            return response()->json([
                'success' => false,
                'message' => 'Error al Eliminar los usuarios: '.$ex->getMessage(),
                'error_details' => env('APP_DEBUG') ? $ex->getTrace() : null
            ], 500);
        }
    }
}
