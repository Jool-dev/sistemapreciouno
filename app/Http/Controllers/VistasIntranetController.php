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
}
