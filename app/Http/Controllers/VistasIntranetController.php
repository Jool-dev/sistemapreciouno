<?php

namespace App\Http\Controllers;

use App\Models\Conductores;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VistasIntranetController extends Controller
{
    public function vistalogin() {
        return view('auth.login');
    }

    public function vistadashboard() {
        if (!Auth::check()) {
            return redirect()->route('vistalogin');
        }
        return view('intranet.dashboard');
    }

    public function vistavehiculo()  {
        if (!Auth::check()) {
            return redirect()->route('vistalogin');
        }
        return view('intranet.vehiculo');
    }

    public function vistausuarios() {
        if (!Auth::check()) {
            return redirect()->route('vistalogin');
        }
        return view('intranet.usuarios');
    }

    public function vistaproducto(){
        if (!Auth::check()) {
            return redirect()->route('vistalogin');
        }
        return view('intranet.productos');
    }

    public function vistaguiasderemision(){
        if (!Auth::check()) {
            return redirect()->route('vistalogin');
        }

        $modelovehiculos = new Vehiculo();
        $modelConductores = new Conductores();

        $data = $modelovehiculos->mostravehiculo();
        $data2 = $modelConductores->mostraconductores();

        // Convertir arrays a objetos stdClass
        $vehiculos = array_map(function($item) {
            return (object)$item;
        }, $data["data"]);

        $conductores = array_map(function($item) {
            return (object)$item;
        }, $data2["data"]);
        return view('intranet.prevencionistas.guiasremision', compact('vehiculos', 'conductores'));
    }

    public function vistarevisionguias(){
        if (!Auth::check()) {
            return redirect()->route('vistalogin');
        }
        return view('intranet.prevencionistas.revisionguias');
    }

    public function vistaprevencionista(){
        if (!Auth::check()) {
            return redirect()->route('vistalogin');
        }
        return view('intranet.prevencionistas.prevencionista');
    }
}
