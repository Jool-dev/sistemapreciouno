<?php

namespace App\Http\Controllers;

use App\Models\Conductores;
use App\Models\DetalleGuia;
use App\Models\Guiasderemision;
use App\Models\Productos;
use App\Models\TipoEmpresa;
use App\Models\ValidacionGuia;
use App\Models\Vehiculo;
use App\Models\Transporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VistasIntranetController extends Controller
{
    public function vistalogin()
    {
        if (session()->has('usuariologeado')) {
            $rol = strtolower(session('usuariologeado')['data'][0]['rol'] ?? '');

            switch ($rol) {
                case 'administrador':
                case 'superadmin':
                    return redirect()->route('vistadashboard');
                case 'prevencionista':
                    return redirect()->route('vistaguiasderemision');
                default:
                    return redirect()->route('/');
            }
        }

        return view('auth.login');
    }

    public function vistadashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('vistalogin');
        }

        return view('intranet.administrador.dashboard');
    }

    public function vistavehiculo()
    {
        if (!Auth::check()) {
            return redirect()->route('vistalogin');
        }
        return view('intranet.administrador.vehiculo');
    }

    public function vistausuarios()
    {
        if (!Auth::check()) {
            return redirect()->route('vistalogin');
        }
        return view('intranet.administrador.usuarios');
    }

    public function vistaproducto()
    {
        if (!Auth::check()) {
            return redirect()->route('vistalogin');
        }
        return view('intranet.administrador.productos');
    }

    public function vistaconductor()
    {
        if (!Auth::check()) {
            return redirect()->route('vistalogin');
        }
        //      Metodo directo usando eloquent
        $vehiculos = \App\Models\Vehiculo::where('estado', 'activo')->get();
        $transportes = \App\Models\Transporte::where('estado', 'activo')->get();

        return view('intranet.administrador.conductores', compact('transportes', 'vehiculos'));
    }

    public function vistaguiasderemision()
    {
        if (!Auth::check()) {
            return redirect()->route('vistalogin');
        }

        return view('intranet.prevencionistas.guiasremision');
    }

    public function vistaaddguiaremision()
    {
        $transportes = Transporte::all();
        $conductores = Conductores::all();
        $tipoempresa = TipoEmpresa::all();
        $productos = Productos::all();

        return view('intranet.prevencionistas.addguiasremision', compact('transportes', 'conductores', 'tipoempresa', 'productos'));
    }

    public function vistadetalleguia($idguia = null)
    {
        if (!is_numeric($idguia)) {
            abort(400, 'ID de guía inválido');
        }

        if (!Auth::check()) {
            return redirect()->route('vistalogin');
        }
        // Inicializar modelos
        $modeloguiaremision = new Guiasderemision();
        $modelConductores = new Conductores();
        $modelTipoEmpresa = new TipoEmpresa();
        $modelTransporte = new Transporte();
        $modelValidacion = new ValidacionGuia();

        // Obtener datos principales de la guía
        $guiaData = $modeloguiaremision->mostrarguiasderemision(['idguia' => $idguia]);
        $guia = !empty($guiaData["data"]) ? (object)$guiaData["data"][0] : (object)[];

        // Obtener detalles de productos asociados
        $detalleguiaData = $modeloguiaremision->mostrardetalleguia(["idguia" => $idguia]);
        $detalleguia = array_map(function ($item) {
            return (object)$item;
        }, $detalleguiaData["data"] ?? []);

        //solucion para evitar duplicidad visual
        $detalleguia = array_map('unserialize', array_unique(array_map('serialize', $detalleguia)));

        // Obtener datos del conductor
        $conductorData = $modelConductores->mostrarconductores(["idguia" => $idguia]);
        $conductor = !empty($conductorData["data"]) ? (object)$conductorData["data"][0] : (object)[];

        // Obtener datos del tipo de empresa
        $tipoempresaData = $modelTipoEmpresa->mostrartipoempresa(["idguia" => $idguia]);
        $tipoempresa = !empty($tipoempresaData["data"]) ? (object)$tipoempresaData["data"][0] : (object)[];

        // Obtener datos del transporte
        $transporteData = $modelTransporte->mostrartransporte(["idguia" => $idguia]);
        $transporte = !empty($transporteData["data"]) ? (object)$transporteData["data"][0] : (object)[];

        // Obtener datos de validación con productos por condición
        $validacionData = $modelValidacion->mostrarvalidacionguia(["idguia" => $idguia]);
        $validacion = !empty($validacionData["data"]) ? (object)$validacionData["data"][0] : (object)[];

        // Obtener productos agrupados por condición
        $productosPorCondicion = $modelValidacion->obtenerProductosPorCondicion($idguia);
        $productosBuenos = $productosPorCondicion['success'] ? $productosPorCondicion['data']['productosBuenos'] : [];
        $productosDanados = $productosPorCondicion['success'] ? $productosPorCondicion['data']['productosDañados'] : [];
        $productosRegulares = $productosPorCondicion['success'] ? $productosPorCondicion['data']['productosRegulares'] : [];
        $productosSinCondicion = $productosPorCondicion['success'] && isset($productosPorCondicion['data']['productosSinCondicion'])
            ? $productosPorCondicion['data']['productosSinCondicion']
            : [];


        // Pasar todos los datos a la vista
        return view('intranet.prevencionistas.detalleguia', [
            'guia' => $guia,
            'detalleguia' => $detalleguia,
            'conductor' => $conductor,
            'tipoempresa' => $tipoempresa,
            'transporte' => $transporte,
            'validacion' => $validacion,
            'productosBuenos' => $productosBuenos,
            'productosRegulares' => $productosRegulares,
            'productosDanados' => $productosDanados,
            'productosSinCondicion' => $productosSinCondicion,
        ]);
    }

    public function vistarevisionguias($idguia = null)
    {
        if (!is_numeric($idguia)) {
            abort(400, 'ID de guía inválido');
        }

        if (!Auth::check()) {
            return redirect()->route('vistalogin');
        }

        $modeloguiaremision = new Guiasderemision();
        $guia = $modeloguiaremision->mostrarguiasderemision([
            'idguia' => $idguia
        ]);

        $detalleguia = $modeloguiaremision->mostrardetalleguia([
            "idguia" => $idguia
        ]);

        $detalleguia = array_map(function ($item) {
            return (object)$item;
        }, $detalleguia["data"] == null ? [] : $detalleguia["data"]);

        $guia = !empty($guia["data"]) ? (object)$guia["data"][0] : (object)[];
        return view('intranet.prevencionistas.revisionguias', compact('detalleguia', 'guia'));
    }
}
