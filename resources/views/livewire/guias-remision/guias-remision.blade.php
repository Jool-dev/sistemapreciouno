<div class="container-fluid py-2">
    <!-- Tabla -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
            <tr>
                <th class="text-center align-middle">#</th>
                <th class="text-center align-middle">Codigo Guia</th>
                <th class="text-center align-middle">Fecha Emision</th>
                <th class="text-center align-middle">Hora Emision</th>
                <th class="text-center align-middle">Razon Social Guia</th>
                <th class="text-center align-middle">N° Pedido / Transferencia (TIM)</th>
                <th class="text-center align-middle">Motivo Traslado</th>
                <th class="text-center align-middle">Peso Bruto Total</th>
                <th class="text-center align-middle">Volumen Producto</th>
                <th class="text-center align-middle">N° Bulto / Pallet</th>
                <th class="text-center align-middle">Observaciones</th>
                <th class="text-center align-middle">Estado</th>
                <th class="text-center align-middle">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse($data as $guiasderemision)
                <tr>
                    <td class="text-center align-middle"><strong>{{ $guiasderemision['idguia'] }}</strong></td>
                    <td class="text-center align-middle"><strong>{{ $guiasderemision['codigoguia'] }}</strong></td>
                    <td class="text-center align-middle"><strong>{{ $guiasderemision['fechaemision'] }}</strong></td>
                    <td class="text-center align-middle"><strong>{{ $guiasderemision['horaemision'] }}</strong></td>
                    <td class="text-center align-middle"><strong>{{ $guiasderemision['razonsocialguia'] }}</strong></td>
                    <td class="text-center align-middle"><strong>{{ $guiasderemision['numerotrasladotim'] }}</strong></td>
                    <td class="text-center align-middle"><strong>{{ $guiasderemision['motivotraslado'] }}</strong></td>
                    <td class="text-center align-middle"><strong>{{ $guiasderemision['pesobrutototal'] }}</strong></td>
                    <td class="text-center align-middle"><strong>{{ $guiasderemision['volumenproducto'] }}</strong></td>
                    <td class="text-center align-middle"><strong>{{ $guiasderemision['numerobultopallet'] }}</strong></td>
                    <td class="text-center align-middle"><strong>{{ $guiasderemision['observaciones'] }}</strong></td>
                    <td class="text-center align-middle">
                        <a href="{{ route('guias.detalle', $guiasderemision['idguia']) }}">
                            <i class="fa-solid fa-eye"></i> Ver Productos
                        </a>
                        <a href="#" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i> Editar</a>
                        <a href="#" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Eliminar</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        No hay guias registrados.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center mt-4">
            <li class="page-item disabled">
                <a class="page-link">Anterior</a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Siguiente</a>
            </li>
        </ul>
    </nav>
</div>
