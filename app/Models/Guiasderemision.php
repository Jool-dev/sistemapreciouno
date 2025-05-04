<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guiasderemision extends Model
{
    protected $table = 'guias_remision'; // Especifica el horaemision exacto de la tabla
    protected $primaryKey = 'idguia'; // Si tu clave primaria no se llama "id"
    public $timestamps = false; // Desactiva timestamps si tu tabla no tiene created_at / updated_at

    // Opcional: si quieres proteger o permitir ciertas columnas
    protected $fillable = [
        'tim',
        'fechaemision',
        'horaemision',
        'motivotraslado',
        'origen',
        'destino',
        'estado',
        'cantidadenviada'
    ];

    public function mostrarguiasderemision(array $parametros = []): array {
        $query = DB::table('v_');

        // Filtros condicionales
        if (isset($parametros['idguia'])) {
            $query->where('idguia', $parametros['idguia']);
        }

        if (isset($parametros['tim'])) {
            $query->where('tim', $parametros['tim']);
        }

        if (isset($parametros['fechaemision'])) {
            $query->where('fechaemision', $parametros['fechaemision']);
        }

        if (isset($parametros['horaemision'])) {
            $query->where('horaemision', $parametros['horaemision']);
        }

        if (isset($parametros['motivotraslado'])) {
            $query->where('motivotraslado', $parametros['motivotraslado']);
        }

        if (isset($parametros['origen'])) {
            $query->where('origen', $parametros['origen']);
        }

        if (isset($parametros['destino'])) {
            $query->where('destino', $parametros['destino']);
        }

        if (isset($parametros['estado'])) {
            $query->where('estado', $parametros['estado']);
        }

        if (isset($parametros['cantidadenviada'])) {
            $query->where('cantidadenviada', $parametros['cantidadenviada']);
        }

        // Verificar si se pide paginación
        if (isset($parametros['paginado']) && $parametros['paginado'] === true) {
            $porPagina = $parametros['porPagina'] ?? 10;
            $vehiculo = $query->orderByDesc('idguia')->paginate($porPagina);

            return GlobalModel::returnArray(
                $vehiculo->count() > 0,
                $vehiculo->count() === 0 ? "No hay Candidatos registrados" : "OK",
                $vehiculo // Retorna el paginador
            );
        }

        // Si no hay paginado, obtener todo
        $vehiculo = $query->get()->map(fn($item) => (array) $item)->toArray();
        return GlobalModel::returnArray(
            !empty($vehiculo),
            empty($vehiculo) ? "No hay Candidatos registrados" : "OK",
            $vehiculo
        );
    }

    public function insertarguias_remision(array $data): array {
        // Definir variables de salida
        DB::statement("SET @idguia = 0;");
        DB::statement("SET @success = 0;");
        DB::statement("SET @message = '';");

        // Llamar al SP con parámetros IN + OUT
        DB::statement("CALL sp_vehiculoinsertar(?, ?, ?, @idguia, @success, @message)", [
            isset($data['placa']) ? $data['placa'] : null,
            isset($data['tim']) ? $data['tim'] : null,
            isset($data['fechaemision']) ? $data['fechaemision'] : null
        ]);


        // Obtener resultados de las variables OUT
        $result = DB::select("SELECT @idguia as idguia, @success as success, @message as message");
        return GlobalModel::returnArray(
            $result[0]->success == 1,
            $result[0]->message,
            [
                [
                    "idguia" => $result[0]->idguia
                ]
            ]
        );
    }
}
