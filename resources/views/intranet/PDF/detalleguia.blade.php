<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Guía de Remisión</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 11px;
            margin: 20px;
        }

        .header,
        .footer,
        .content,
        .transport {
            width: 100%;
            border-collapse: collapse;
        }

        .header td,
        .content td,
        .content th,
        .transport td {
            border: 1px solid #000;
            padding: 4px;
        }

        .title {
            text-align: center;
            font-weight: bold;
            font-size: 14px;
        }

        .bold {
            font-weight: bold;
        }

        .no-border td {
            border: none;
        }

        .section-title {
            margin-top: 10px;
            font-weight: bold;
            background: #eee;
            padding: 4px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>

    <table class="header">
        <tr>
            <td rowspan="3" style="width: 25%; text-align: center;">
                <strong>TOTTUS</strong><br>
                <small>{{ $guia->razonsocialguia ?? 'N/A' }}</small><br>
                R.U.C. Nº {{ $guia->razonsocialguia ?? 'N/A' }}
            </td>
            <td class="title" colspan="2">GUÍA DE REMISIÓN ELECTRÓNICA</td>
            <td style="width: 25%; text-align: center;">
                <strong>N° {{ $guia->codigoguia ?? 'T003-0000000' }}</strong>
            </td>
        </tr>
        <tr>
            <td colspan="3"><strong>Razón Social:</strong> {{ $guia->razonsocialguia ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td><strong>Fecha Emisión:</strong> {{ $guia->fechaemision ?? 'N/A' }}</td>
            <td><strong>Hora Emisión:</strong> {{ $guia->horaemision ?? 'N/A' }}</td>
            <td><strong>Motivo:</strong> {{ $guia->motivotraslado ?? 'Venta' }}</td>
        </tr>
    </table>

    <div class="section-title">DATOS DE PARTIDA Y LLEGADA</div>
    <table class="content">
        <tr>
            <td><strong>Dirección Partida:</strong> {{ $guia->direccionpartida ?? 'N/A' }}</td>
            <td><strong>Ubigeo:</strong> {{ $guia->ubigeopartida ?? '150118' }}</td>
        </tr>
        <tr>
            <td><strong>Dirección Llegada:</strong> {{ $guia->direccionllegada ?? 'N/A' }}</td>
            <td><strong>Ubigeo:</strong> {{ $guia->ubigeollegada ?? 'N/A' }}</td>
        </tr>
    </table>

    <div class="section-title">TRANSPORTISTA</div>
    <table class="transport">
        <tr>
            <td><strong>Empresa:</strong> {{ $tipoempresa->razonsocial ?? 'N/A' }}</td>
            <td><strong>RUC:</strong> {{ $tipoempresa->ruc ?? 'N/A' }}</td>
            <td><strong>Modalidad:</strong> Transporte Público</td>
        </tr>
        <tr>
            <td><strong>Conductor:</strong> {{ $conductor->nombre ?? 'N/A' }}</td>
            <td><strong>DNI:</strong> {{ $conductor->dni ?? 'N/A' }}</td>
            <td><strong>Placa:</strong> {{ $conductor->placa ?? 'N/A' }}</td>
        </tr>
    </table>

    <div class="section-title">PRODUCTOS TRANSPORTADOS</div>
    <table class="content">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Unidad</th>
                <th class="text-center">Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @forelse($detalleguia as $item)
                @php $item = (object)$item; @endphp
                <tr>
                    <td>{{ $item->codigoproducto ?? 'N/A' }}</td>
                    <td>{{ $item->producto ?? 'Sin descripción' }}</td>
                    <td>NIU</td>
                    <td class="text-center">{{ number_format($item->cant ?? 0, 0) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No se encontraron productos</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="section-title">DATOS ADICIONALES</div>
    <table class="content">
        <tr>
            <td><strong>Peso bruto total (kg):</strong> {{ $guia->pesobrutototal ?? 'N/A' }}</td>
            <td><strong>Volumen total (m³):</strong> {{ $guia->volumenproducto ?? 'N/A' }}</td>
            <td><strong>Bultos:</strong> {{ $guia->numerobultopallet ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td colspan="3"><strong>Observaciones:</strong> {{ $guia->observaciones ?? 'Ninguna' }}</td>
        </tr>
    </table>

</body>

</html>
