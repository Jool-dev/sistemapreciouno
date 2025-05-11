<div class="container-fluid py-2">
    <!-- Tabla -->
{{--    <div class="table-responsive">--}}
{{--        <table class="table table-bordered">--}}
{{--            <thead class="table-dark">--}}
{{--            <tr>--}}
{{--                <th class="text-center align-middle">#</th>--}}
{{--                <th class="text-center align-middle">Codigo Guia</th>--}}
{{--                <th class="text-center align-middle">Fecha Emision</th>--}}
{{--                <th class="text-center align-middle">Hora Emision</th>--}}
{{--                <th class="text-center align-middle">Razon Social Guia</th>--}}
{{--                <th class="text-center align-middle">N° Pedido / Transferencia (TIM)</th>--}}
{{--                <th class="text-center align-middle">Motivo Traslado</th>--}}
{{--                <th class="text-center align-middle">Peso Bruto Total</th>--}}
{{--                <th class="text-center align-middle">Volumen Producto</th>--}}
{{--                <th class="text-center align-middle">N° Bulto / Pallet</th>--}}
{{--                <th class="text-center align-middle">Observaciones</th>--}}
{{--                <th class="text-center align-middle">Acciones</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @forelse($data as $guiasderemision)--}}
{{--                <tr>--}}
{{--                    <td class="text-center align-middle"><strong>{{ $guiasderemision['idguia'] }}</strong></td>--}}
{{--                    <td class="text-center align-middle"><strong>{{ $guiasderemision['codigoguia'] }}</strong></td>--}}
{{--                    <td class="text-center align-middle"><strong>{{ $guiasderemision['fechaemision'] }}</strong></td>--}}
{{--                    <td class="text-center align-middle"><strong>{{ $guiasderemision['horaemision'] }}</strong></td>--}}
{{--                    <td class="text-center align-middle"><strong>{{ $guiasderemision['razonsocialguia'] }}</strong></td>--}}
{{--                    <td class="text-center align-middle"><strong>{{ $guiasderemision['numerotrasladotim'] }}</strong></td>--}}
{{--                    <td class="text-center align-middle"><strong>{{ $guiasderemision['motivotraslado'] }}</strong></td>--}}
{{--                    <td class="text-center align-middle"><strong>{{ $guiasderemision['pesobrutototal'] }}</strong></td>--}}
{{--                    <td class="text-center align-middle"><strong>{{ $guiasderemision['volumenproducto'] }}</strong></td>--}}
{{--                    <td class="text-center align-middle"><strong>{{ $guiasderemision['numerobultopallet'] }}</strong></td>--}}
{{--                    <td class="text-center align-middle"><strong>{{ $guiasderemision['observaciones'] }}</strong></td>--}}
{{--                    <td class="text-center align-middle">--}}
{{--                        <a href="{{ route('vistadetalleguia') }}" class="btn btn-sm btn-info">--}}
{{--                            <i class="fa-solid fa-circle-info"></i></i> Ver Detalle--}}
{{--                        </a>--}}
{{--                        <a href="#" class="btn btn-sm btn-warning"><i class="fa-regular fa-pen-to-square"></i></i></a>--}}
{{--                        <a href="#" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></i></a>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @empty--}}
{{--                <tr>--}}
{{--                    <td colspan="7" class="text-center text-muted py-4">--}}
{{--                        No hay guias registrados.--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endforelse--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--    </div>--}}

{{--    <!-- Paginación -->--}}
{{--    <nav aria-label="Page navigation">--}}
{{--        <ul class="pagination justify-content-center mt-4">--}}
{{--            <li class="page-item disabled">--}}
{{--                <a class="page-link">Anterior</a>--}}
{{--            </li>--}}
{{--            <li class="page-item active"><a class="page-link" href="#">1</a></li>--}}
{{--            <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--            <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--            <li class="page-item">--}}
{{--                <a class="page-link" href="#">Siguiente</a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </nav>--}}
    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-dark text-center">
            <tr>
                <th>#</th>
                <th>Código</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Razón Social</th>
                <th>Pedido / TIM</th>
                <th>Motivo de traslado</th>
                <th>Peso (Kg)</th>
                <th>Volumen (m³)</th>
                <th>Bultos / Pallets</th>
                <th>Observaciones</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse($data as $guia)
                <tr class="text-center">
                    <td>{{ $guia['idguia'] }}</td>
                    <td>{{ $guia['codigoguia'] }}</td>
                    <td>{{ $guia['fechaemision'] }}</td>
                    <td>{{ $guia['horaemision'] }}</td>
                    <td class="text-start">{{ $guia['razonsocialguia'] }}</td>
                    <td>{{ $guia['numerotrasladotim'] }}</td>
                    <td>{{ $guia['motivotraslado'] }}</td>
                    <td>{{ $guia['pesobrutototal'] }}</td>
                    <td>{{ $guia['volumenproducto'] }}</td>
                    <td>{{ $guia['numerobultopallet'] }}</td>
                    <td class="text-start text-wrap" style="max-width: 200px;">{{ $guia['observaciones'] }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                            <a href="{{ route('vistadetalleguia') }}" class="btn btn-sm btn-outline-info" title="Ver Detalle">
                                <i class="fa-solid fa-circle-info"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-warning" title="Editar">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="12" class="text-center text-muted py-4">
                        No se encontraron guías registradas.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <nav aria-label="Navegación de página">
        <ul class="pagination justify-content-center mt-4">
            <li class="page-item disabled">
                <span class="page-link">Anterior</span>
            </li>
            <li class="page-item active">
                <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Siguiente</a>
            </li>
        </ul>
    </nav>

</div>
