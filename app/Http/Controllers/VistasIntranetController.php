<?php

namespace App\Http\Controllers;

use App\Models\Conductores;
use App\Models\TipoEmpresa;
use App\Models\Vehiculo;
use App\Models\Transporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VistasIntranetController extends Controller
{
    public function vistalogin() {
        if (session()->has('usuariologeado')) {
            $rol = strtolower(session('usuariologeado')['data'][0]['rol']);

            // Redirigir según el rol
            switch ($rol) {
                case 'administrador':
                    return redirect()->route('vistadashboard');
                case 'prevencionista':
                    return redirect()->route('vistaguiasderemision');
                default:
                    return redirect()->route('/');
            }
        }

        return view('auth.login');
    }

    public function vistadashboard() {
        if (!Auth::check()) {
            return redirect()->route('vistalogin');
        }
        return view('intranet.administrador.dashboard');
    }

    public function vistavehiculo()  {
        if (!Auth::check()) {
            return redirect()->route('vistalogin');
        }
        return view('intranet.administrador.vehiculo');
    }

    public function vistausuarios() {
        if (!Auth::check()) {
            return redirect()->route('vistalogin');
        }
        return view('intranet.administrador.usuarios');
    }

    public function vistaproducto(){
        if (!Auth::check()) {
            return redirect()->route('vistalogin');
        }
        return view('intranet.administrador.productos');
    }

    public function vistadetalleguia(){
        if (!Auth::check()) {
            return redirect()->route('vistalogin');
        }
        return view('intranet.prevencionistas.detalleguia');
    }

    public function vistaconductor(){
        if (!Auth::check()) {
            return redirect()->route('vistalogin');
        }
//      Metodo directo usando eloquent
        $vehiculos = \App\Models\Vehiculo::where('estado', 'activo')->get();
        $transportes = \App\Models\Transporte::where('estado', 'activo')->get();

//        // Instanciamos los modelos
//        $modeloTransportes = new Transporte();
//        $modelovehiculos = new Vehiculo();
//
//        // Obtenemos datos usando métodos personalizados
//        $data1 = $modeloTransportes->mostrartransporte();
//        $data2 = $modelovehiculos->mostravehiculo();
//
//        // Convertimos arrays a objetos stdClass
//        $transportes = array_map(function($item) {
//            return (object)$item;
//        }, $data1["data"] == null ? [] : $data1["data"]);
//
//        $vehiculos = array_map(function($item) {
//            return (object)$item;
//        }, $data2["data"] == null ? [] : $data2["data"]);

        return view('intranet.administrador.conductores', compact('transportes', 'vehiculos'));
    }

    public function vistaguiasderemision(){
        if (!Auth::check()) {
            return redirect()->route('vistalogin');
        }

        $modelovehiculos = new Vehiculo();
        $modelConductores = new Conductores();

        $data = $modelovehiculos->mostravehiculo();
        $data2 = $modelConductores->mostrarconductores();

        // Convertir arrays a objetos stdClass
        $vehiculos = array_map(function($item) {
            return (object)$item;
        }, $data["data"] == null ? [] : $data["data"]);

        $conductores = array_map(function($item) {
            return (object)$item;
        }, $data2["data"] == null ? [] : $data2["data"]);

        return view('intranet.prevencionistas.guiasremision', compact('vehiculos', 'conductores'));
    }

    public function vistaaddguiaremision(){
        if (!Auth::check()) {
            return redirect()->route('vistalogin');
        }
        //ESTO JALA LOS DATOS FORANEOS
        $modelConductores = new Conductores();
        $modelTipoEmpresa = new TipoEmpresa();


        $data = $modelConductores->mostrarconductores();
        $data2 = $modelTipoEmpresa->mostrartipoempresa();

        // Convertir arrays a objetos stdClass
        $conductores = array_map(function($item) {
            return (object)$item;
        }, $data["data"] == null ? [] : $data["data"]);

        $tipoempresa = array_map(function($item) {
            return (object)$item;
        }, $data2["data"] == null ? [] : $data2["data"]);

        return view('intranet.prevencionistas.addguiasremision', compact('conductores', 'tipoempresa'));
    }

    public function vistarevisionguias(){
        if (!Auth::check()) {
            return redirect()->route('vistalogin');
        }
        return view('intranet.prevencionistas.revisionguias');
    }

//    public function vistaprevencionista(){
//        if (!Auth::check()) {
//            return redirect()->route('vistalogin');
//        }
//        return view('intranet.prevencionistas.guiasremision');
//    }
}
