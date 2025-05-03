<?php

namespace App\Models\Global;

use DateTime;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class GlobalModel extends Model {

    public static function eliminarFoto(?string $ruta): bool {
        if (!$ruta) {
            return false; // No hay ruta proporcionada
        }

        // Extraer solo la parte relativa del path, si viene como URL completa
        $rutaRelativa = str_replace(asset('storage') . '/', '', $ruta);

        // Verificamos si el archivo existe antes de intentar borrarlo
        if (Storage::disk('public')->exists($rutaRelativa)) {
            return Storage::disk('public')->delete($rutaRelativa);
        }

        return false; // No se encontró el archivo
    }

    public static function returnArray($success, $message, $data = "hola",  $parametros = []): array {
        $response = array(
            "success" => $success == null ? false : $success,
            "message" => $message == null ? "returnArray: no Enviada" : $message,
        );

        if (!empty($parametros)) {
            foreach ($parametros as $key => $value) {
                $response[$key] = $value;
            }
        }

        if($data != "hola"){
            $response["data"] = empty($data) ? null : $data;
        }

        return $response;
    }

    public static function respuestaJson( bool $success, string $message, $data = null,  array $additionalParams = [], int $httpCode = 200): JsonResponse {
        // Estructura base de la respuesta
        $response = [
            'result' => [
                'success' => $success,
                'message' => $message ?: ($success ? 'Operación exitosa' : 'Error en la operación'),
            ]
        ];

        // Agregar datos si se proporcionaron
        if ($data !== null && $data !== "hola") {
            $response['result']['data'] = $data;
        }

        // Agregar parámetros adicionales
        if (!empty($additionalParams)) {
            foreach ($additionalParams as $key => $value) {
                $response['result'][$key] = $value;
            }
        }

        return response()->json($response, $httpCode);
    }

    /**
     * @throws Exception
     */
    public static function traducirDiasSemana($fecha, $idiomaDestino = 'es'): array|string {
        // Mapas de traducción de los días de la semana
        $diasSemana = [
            'en' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            'es' => ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
            'pt' => ['Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado', 'Domingo'],
            'fr' => ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'],
            'de' => ['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag', 'Sonntag'],
        ];

        // Si el idioma destino no está soportado, lanzar un error
        if (!isset($diasSemana[$idiomaDestino])) {
            throw new Exception("Idioma no soportado para traducción de días de la semana.");
        }

        // Reemplazar los días de la semana del inglés al idioma deseado
        return str_replace($diasSemana['en'], $diasSemana[$idiomaDestino], $fecha);
    }

    /**
     * @throws Exception
     */
    public static function traducirMeses($nombreMes, $idiomaDestino = 'es'): string
    {
        // Mapas de traducción de los meses
        $meses = [
            'en' => [
                'January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'
            ],
            'es' => [
                'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
            ],
        ];

        // Verificar si el idioma destino está soportado
        if (!isset($meses[$idiomaDestino])) {
            throw new Exception("Idioma no soportado para traducción de meses.");
        }

        // Buscar el índice del mes en inglés y retornar su traducción
        $indice = array_search($nombreMes, $meses['en']);
        return $indice !== false ? $meses[$idiomaDestino][$indice] : $nombreMes;
    }

    public static function formatearFecha($fecha): string {
        // Convertir la fecha en un objeto DateTime
        $date = new DateTime($fecha);

        // Extraer día, mes en inglés y año
        $dia = $date->format('d');
        $mesIngles = $date->format('F'); // Mes en inglés
        $anio = $date->format('Y');

        // Traducir el mes usando la función existente
        $mesEspanol = self::traducirMeses($mesIngles, 'es');

        // Retornar fecha formateada
        return strtoupper("$dia de $mesEspanol, $anio");
    }

    public static function formatearHora($fecha): string {
        // Convertir la fecha en un objeto DateTime
        try {
            $date = new DateTime($fecha);
        } catch (\DateMalformedStringException $e) {

        }

        // Obtener la hora en formato 12h con AM/PM
        return $date->format('h:i A'); // 'h' para hora en 12h, 'i' para minutos, 'A' para AM/PM
        // Salida: "05:36 PM"
    }
}
