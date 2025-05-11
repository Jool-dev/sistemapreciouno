<?php

namespace App\Models;

use App\Models\Global\GlobalModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transporte extends Model
{
    protected $table = 'transporte'; // Especifica el nombre_razonsocial exacto de la tabla
    protected $primaryKey = 'idtransportista'; // Si tu clave primaria no se llama "id"
    public $timestamps = false; // Desactiva timestamps si tu tabla no tiene created_at / updated_at

    // Opcional: si quieres proteger o permitir ciertas columnas
    protected $fillable = [
        'ruc_transportista',
        'nombre_razonsocial',
        'modalidadtraslado',
    ];

    public function mostrartransporte(array $parametros = []): array {
//        $query = DB::table('v_transporte');
        $query = DB::table('v_transporte')->where('estado', '!=', 'Eliminado');

        // Filtros condicionales
        if (isset($parametros['idtransportista'])) {
            $query->where('idtransportista', $parametros['idtransportista']);
        }

        if (isset($parametros['ruc_transportista'])) {
            $query->where('ruc_transportista', $parametros['ruc_transportista']);
        }

        if (isset($parametros['nombre_razonsocial'])) {
            $query->where('nombre_razonsocial', $parametros['nombre_razonsocial']);
        }

        if (isset($parametros['modalidadtraslado'])) {
            $query->where('modalidadtraslado', $parametros['modalidadtraslado']);
        }

        // Verificar si se pide paginación
        if (isset($parametros['paginado']) && $parametros['paginado'] === true) {
            $porPagina = $parametros['porPagina'] ?? 10;
            $transporte = $query->orderByDesc('idtransportista')->paginate($porPagina);

            return GlobalModel::returnArray(
                $transporte->count() > 0,
                $transporte->count() === 0 ? "No hay transportes registrados" : "OK",
                $transporte // Retorna el paginador
            );
        }

        // Si no hay paginado, obtener todo
        $transporte = $query->get()->map(fn($item) => (array) $item)->toArray();
        return GlobalModel::returnArray(
            !empty($transporte),
            empty($transporte) ? "No hay transportes registrados" : "OK",
            $transporte
        );
    }

    public function insertartransporte(array $data): array {
        // Definir variables de salida
        DB::statement("SET @idtransportista = 0;");
        DB::statement("SET @success = 0;");
        DB::statement("SET @message = '';");

        // Llamar al SP con parámetros IN + OUT
        DB::statement("CALL sp_transporteinsertar(?, ?, ?, @idtransportista, @success, @message)", [
            isset($data['ruc_transportista']) ? $data['ruc_transportista'] : null,
            isset($data['nombre_razonsocial']) ? $data['nombre_razonsocial'] : null,
            isset($data['modalidadtraslado']) ? $data['modalidadtraslado'] : null,
        ]);

        // Obtener resultados de las variables OUT
        $result = DB::select("SELECT @idtransportista as idtransportista, @success as success, @message as message");
        return GlobalModel::returnArray(
            $result[0]->success == 1,
            $result[0]->message,
            [
                [
                    "idtransportista" => $result[0]->idtransportista
                ]
            ]
        );
    }
}
