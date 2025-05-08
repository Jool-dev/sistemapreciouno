<?php

namespace App\Models;

use App\Models\Global\GlobalModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TipoEmpresa extends Model
{
    protected $table = 'tipoempresa'; // Especifica el provincia exacto de la tabla
    protected $primaryKey = 'idtipoempresa'; // Si tu clave primaria no se llama "id"
    public $timestamps = false; // Desactiva timestamps si tu tabla no tiene created_at / updated_at

    // Opcional: si quieres proteger o permitir ciertas columnas
    protected $fillable = [
        'direccion',
        'provincia',
        'departamento',
        'ubigeo',
        'razonsocial',
        'ruc',
        'codigoestablecimiento',
    ];

    public function mostrartipoempresa(array $parametros = []): array {
//        $query = DB::table('v_tipoempresa');
        $query = DB::table('v_tipoempresa')->where('estado', '!=', 'Eliminado');

        // Filtros condicionales
        if (isset($parametros['idtipoempresa'])) {
            $query->where('idtipoempresa', $parametros['idtipoempresa']);
        }

        if (isset($parametros['direccion'])) {
            $query->where('direccion', $parametros['direccion']);
        }

        if (isset($parametros['provincia'])) {
            $query->where('provincia', $parametros['provincia']);
        }

        if (isset($parametros['departamento'])) {
            $query->where('departamento', $parametros['departamento']);
        }

        if (isset($parametros['ubigeo'])) {
            $query->where('ubigeo', $parametros['ubigeo']);
        }

        if (isset($parametros['codigoestablecimiento'])) {
            $query->where('codigoestablecimiento', $parametros['codigoestablecimiento']);
        }

        // Verificar si se pide paginación
        if (isset($parametros['paginado']) && $parametros['paginado'] === true) {
            $porPagina = $parametros['porPagina'] ?? 10;
            $tipoempresa = $query->orderByDesc('idtipoempresa')->paginate($porPagina);

            return GlobalModel::returnArray(
                $tipoempresa->count() > 0,
                $tipoempresa->count() === 0 ? "No hay ninguna empresa registrada" : "OK",
                $tipoempresa // Retorna el paginador
            );
        }

        // Si no hay paginado, obtener todo
        $tipoempresa = $query->get()->map(fn($item) => (array) $item)->toArray();
        return GlobalModel::returnArray(
            !empty($tipoempresa),
            empty($tipoempresa) ? "No hay ninguna empresa registrada" : "OK",
            $tipoempresa
        );
    }

    public function insertartipoempresa(array $data): array {
        // Definir variables de salida
        DB::statement("SET @idtipoempresa = 0;");
        DB::statement("SET @success = 0;");
        DB::statement("SET @message = '';");

        // Llamar al SP con parámetros IN + OUT
        DB::statement("CALL sp_transporteinsertar(?, ?, @idtipoempresa, @success, @message)", [
            isset($data['direccion']) ? $data['direccion'] : null,
            isset($data['provincia']) ? $data['provincia'] : null,
        ]);

        // Obtener resultados de las variables OUT
        $result = DB::select("SELECT @idtipoempresa as idtipoempresa, @success as success, @message as message");
        return GlobalModel::returnArray(
            $result[0]->success == 1,
            $result[0]->message,
            [
                [
                    "idtipoempresa" => $result[0]->idtipoempresa
                ]
            ]
        );
    }
}
