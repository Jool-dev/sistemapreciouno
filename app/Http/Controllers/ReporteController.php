<?php

namespace App\Http\Controllers;

use App\Models\Guiasderemision;
use Illuminate\Http\Request;
use PDF;

class ReporteController extends Controller
{
    public function generarPdfGuia($id)
    {
        $modelo = new Guiasderemision();

        // Obtener la guía por ID
        $guiaResult = $modelo->mostrarguiasderemision(['idguia' => $id]);
        if (!$guiaResult['success'] || empty($guiaResult['data'])) {
            abort(404, 'Guía de remisión no encontrada');
        }

        $guia = (object)$guiaResult['data'][0]; // Convertir a objeto para acceder con ->

        // Obtener el detalle de la guía
        $detalleResult = $modelo->mostrardetalleguia(['idguia' => $id]);
        $detalleguia = $detalleResult['data'] ?? [];

        // Obtener datos del conductor (asumiendo que v_guiaremision ya incluye estos datos)
        $conductor = (object)[
            'nombre' => $guia->nombre_conductor ?? 'N/A',
            'dni' => $guia->dni_conductor ?? 'N/A',
            'estado' => $guia->estado_conductor ?? 'N/A'
        ];

        // Obtener datos de la empresa transportista (asumiendo que v_guiaremision ya incluye estos datos)
        $tipoempresa = (object)[
            'razonsocial' => $guia->razonsocial_empresa ?? 'N/A',
            'ruc' => $guia->ruc_empresa ?? 'N/A',
            'estado' => $guia->estado_empresa ?? 'N/A'
        ];

        // Preparar datos para la vista
        $datos = [
            'guia' => $guia,
            'conductor' => $conductor,
            'tipoempresa' => $tipoempresa,
            'detalleguia' => $detalleguia,
        ];

        // Generar PDF usando DomPDF
        $pdf = PDF::loadView('intranet.prevencionistas.PDF.detalleguia', $datos)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'sans-serif'
            ]);

        $filename = 'Reporte_Guia_' . $guia->idguia . '_' . date('Ymd') . '.pdf';

        return $pdf->download($filename);
    }
}
