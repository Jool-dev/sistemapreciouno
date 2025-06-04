<?php

namespace App\Http\Controllers;

use App\Livewire\Usuarios\Gestionusuario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{
    public function validarLogin(Request $request)
    {

        global $success, $message, $idrol;

        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        try {

            if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
                $modeloUsuario = new User();
                $usuario = $modeloUsuario->existeusuario($validated['email']);
                if ($usuario["data"] !== null) {
                    // Guardar en sesión personalizada
                    session(['usuariologeado' => $usuario]);
                }
                $success = true;
                $message = "OK";
                $idrol = $usuario["data"][0]["idrol"];
            } else {
                $success = false;
                $message = "Las Credenciales son incorrectas";
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'idrol' => $idrol,
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => 'Error en iniciar sesion: ' . $ex->getMessage(),
                'error_details' => env('APP_DEBUG') ? $ex->getTrace() : null
            ], 500);
        }
    }
    public function verificarusuario(Request $request)
    {
        try {
            $validated = $request->validate([
                "id" => "nullable",
                'name' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]);

            $gestionusuario = new gestionusuario();
            if ($validated['id'] === null) {
                $usuario = $gestionusuario->insertarvehiculos([
                    "name" => $validated['name'],
                    "email" => $validated['email'],
                    "password" => $validated['password']
                ]);
            } else {
                $usuario = $gestionusuario->editarvehiculo([
                    "id" => $validated['id'],
                    "name" => $validated['name'],
                    "email" => $validated['email'],
                    "password" => $validated['password']
                ]);
            }

            if (!$usuario["success"]) {
                throw new Exception($usuario["message"]);
            }

            return response()->json([
                'success' => true,
                'message' => $usuario["message"],
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar los datos: ' . $ex->getMessage(),
                'error_details' => env('APP_DEBUG') ? $ex->getTrace() : null
            ], 500);
        }
    }

    public function eliminarusuario(Request $request)
    {
        try {
            $validated = $request->validate([
                "id" => "nullable",
            ]);

            $gestionusuario = new Vehiculo();
            $usuario = $gestionusuario->editarvehiculo([
                "id" => $validated['id'],
                "estado" => "Eliminado"
            ]);

            if (!$usuario["success"]) {
                throw new Exception($usuario["message"]);
            }

            return response()->json([
                'success' => true,
                'message' => "Eliminado correctamente",
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => 'Error al Eliminar los usuarios: ' . $ex->getMessage(),
                'error_details' => env('APP_DEBUG') ? $ex->getTrace() : null
            ], 500);
        }
    }
}
