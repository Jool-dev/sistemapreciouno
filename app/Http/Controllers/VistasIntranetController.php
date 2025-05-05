<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VistasIntranetController extends Controller
{
    public function vistalogin()
    {
        return view('auth.login');
    }

    public function vistadashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('vistalogin');
        }
        return view('intranet.dashboard');
    }

    public function vistavehiculo()
    {
        if (!Auth::check()) {
            return redirect()->route('vistalogin');
        }
        return view('intranet.vehiculo');
    }

    public function vistausuarios()
    {
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
        return view('intranet.prevencionistas.guiasremision');
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
