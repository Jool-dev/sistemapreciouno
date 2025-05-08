@extends('intranet/layout')
@section('title', 'Productos de Guía')

@section('content')
    <div class="container-fluid py-2">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Productos de Guía: {{ $guia->tim }}</h3>
            <a href="{{ route('vistaguiasderemision') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i> Volver
            </a>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Información de la Guía
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Fecha:</strong> {{ $guia->fechaemision }}</p>
                        <p><strong>Hora:</strong> {{ $guia->horaemision }}</p>
                        <p><strong>Origen:</strong> {{ $guia->origen }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Destino:</strong> {{ $guia->destino }}</p>
                        <p><strong>Motivo:</strong> {{ $guia->motivotraslado }}</p>
                        <p><strong>Estado:</strong>
                            <span class="badge bg-{{ $guia->estado == 'Entregado' ? 'success' : 'warning' }}">
                            {{ $guia->estado }}
                        </span>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Vehículo:</strong> {{ $guia->vehiculo->placa ?? 'N/A' }}</p>
                        <p><strong>Conductor:</strong> {{ $guia->conductor->nombre ?? 'N/A' }}</p>
                        <p><strong>Cantidad Total:</strong> {{ $guia->cantidadenviada }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                Lista de Productos
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>SKU</th>
                            <th>Cantidad Enviada</th>
                            <th>Cantidad Recibida</th>
                            <th>Estado Revisión</th>
                            <th>Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($guia->productos as $index => $producto)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $producto->nombre }}</td>
                                <td>{{ $producto->sku }}</td>
                                <td>{{ $producto->pivot->cantidadrecibida }}</td>
                                <td>{{ $producto->pivot->cantidadrecibida }}</td>
                                <td>
                                <span class="badge bg-{{ $producto->pivot->estadorevision == 'Aprobado' ? 'success' : 'warning' }}">
                                    {{ $producto->pivot->estadorevision }}
                                </span>
                                </td>
                                <td>
                                <span class="badge bg-{{ $producto->pivot->estado == 'Aprobado' ? 'success' : 'warning' }}">
                                    {{ $producto->pivot->estado }}
                                </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
