<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VistasIntranetController extends Controller
{
    public function vistalogin()
    {
        return view('auth.login');
    }

    public function vistadashboard()
    {
        return view('intranet.dashboard');
    }

    public function vistavehiculo()
    {
        return view('intranet.vehiculo');
    }

    public function vistausuarios()
    {
        return view('intranet.usuarios');
    }

    public function vistaproducto(){
        return view('intranet.productos');
    }

    public function vistaguiasderemision(){
        return view('intranet.guiasremision');
    }

    public function vistarevisionguias(){
        return view('intranet.revisionguias');
    }
}
