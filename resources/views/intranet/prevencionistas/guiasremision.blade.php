@extends('intranet.prevencionistas.prevencionista')
@section('title','Guiasderemision')

@section('content')
    <div class="container-fluid py-2">
        <!-- Título y botón -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Guías de Remisión</h3>
            <a href="{{route('vistaaddguiaremision')}}">Agregar nueva Guia</a>
            {{--  <button href="{{route('vistaaddguiaremision')}}" type="button" class="btn btn-primary">
                <i class="fa-solid fa-plus-minus"></i>
                Agregar Nueva Guía
            </button>  --}}
        </div>

        <!-- Barra de búsqueda unificada -->
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Buscar por número de guía, producto, estado...">
                    <button class="btn btn-outline-secondary" type="button">Buscar</button>
                </div>
            </div>
        </div>

        {{--tabla--}}
        @livewire('guias-remision.guias-remision')
    </div>
@endsection
