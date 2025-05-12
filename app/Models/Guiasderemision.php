<?php

namespace App\Models;

use App\Models\Global\GlobalModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Guiasderemision extends Model {
    protected $table = 'guiaremision'; // Especifica el horaemision exacto de la tabla
    protected $primaryKey = 'idguia'; // Si tu clave primaria no se llama "id"
    public $timestamps = false; // Desactiva codigoguiaestamps si tu tabla no tiene created_at / updated_at

    // Opcional: si quieres proteger o permitir ciertas columnas
    protected $fillable = [
        'codigoguia',
        'fechaemision',
        'horaemision',
        'razonsocialguia',
        'numerotrasladotim',
        'motivotraslado',
        'pesobrutototal',
        'volumenproducto',
        'numerobultopallet',
        'observaciones',
        'idconductor',
        'idtipoempresa',
    ];
    public function mostrarguiasderemision(array $parametros = []): array {
//        $query = DB::table('v_guiaremision');
        $query = DB::table('v_guiaremision')->where('estado', '!=', 'Eliminado');

        // Filtros condicionales
        if (isset($parametros['idguia'])) {
            $query->where('idguia', $parametros['idguia']);
        }

        if (isset($parametros['codigoguia'])) {
            $query->where('codigoguia', $parametros['codigoguia']);
        }

        if (isset($parametros['fechaemision'])) {
            $query->where('fechaemision', $parametros['fechaemision']);
        }

        if (isset($parametros['horaemision'])) {
            $query->where('horaemision', $parametros['horaemision']);
        }

        if (isset($parametros['razonsocialguia'])) {
            $query->where('razonsocialguia', $parametros['razonsocialguia']);
        }

        if (isset($parametros['numerotrasladotim'])) {
            $query->where('numerotrasladotim', $parametros['numerotrasladotim']);
        }

        if (isset($parametros['motivotraslado'])) {
            $query->where('motivotraslado', $parametros['motivotraslado']);
        }

        if (isset($parametros['pesobrutototal'])) {
            $query->where('pesobrutototal', $parametros['pesobrutototal']);
        }

        if (isset($parametros['volumenproducto'])) {
            $query->where('volumenproducto', $parametros['volumenproducto']);
        }

        if (isset($parametros['numerobultopallet'])) {
            $query->where('numerobultopallet', $parametros['numerobultopallet']);
        }

        if (isset($parametros['observaciones'])) {
            $query->where('observaciones', $parametros['observaciones']);
        }

        if (isset($parametros['idconductor'])) {
            $query->where('idconductor', $parametros['idconductor']);
        }

        if (isset($parametros['idtipoempresa'])) {
            $query->where('idtipoempresa', $parametros['idtipoempresa']);
        }

        // Verificar si se pide paginación
        if (isset($parametros['paginado']) && $parametros['paginado'] === true) {
            $porPagina = $parametros['porPagina'] ?? 10;
            $guiasderemision = $query->orderByDesc('idguia')->paginate($porPagina);

            return GlobalModel::returnArray(
                $guiasderemision->count() > 0,
                $guiasderemision->count() === 0 ? "No hay guias de remision registradas" : "OK",
                $guiasderemision // Retorna el paginador
            );
        }

        // Si no hay paginado, obtener todo
        $guiasderemision = $query->orderByDesc('idguia')->get()->map(fn($item) => (array) $item)->toArray();
        return GlobalModel::returnArray(
            !empty($guiasderemision),
            empty($guiasderemision) ? "No hay guias de remision registradas" : "OK",
            $guiasderemision
        );
    }

    public function mostrardetalleguia(array $parametros = []): array {
        $query = DB::table('v_detalleguia');

        // Filtros condicionales
        if (isset($parametros['idguia'])) {
            $query->where('idguia', $parametros['idguia']);
        }

        // Verificar si se pide paginación
        if (isset($parametros['paginado']) && $parametros['paginado'] === true) {
            $porPagina = $parametros['porPagina'] ?? 10;
            $guiasderemision = $query->orderByDesc('idguia')->paginate($porPagina);

            return GlobalModel::returnArray(
                $guiasderemision->count() > 0,
                $guiasderemision->count() === 0 ? "No hay DetallesGuias" : "OK",
                $guiasderemision // Retorna el paginador
            );
        }

        // Si no hay paginado, obtener todo
        $guiasderemision = $query->get()->map(fn($item) => (array) $item)->toArray();
        return GlobalModel::returnArray(
            !empty($guiasderemision),
            empty($guiasderemision) ? "No hay un Detalle Guia" : "OK",
            $guiasderemision
        );
    }

    public function insertarguiaremision(array $data): array {
        // Definir variables de salida
        DB::statement("SET @idguia = 0;");
        DB::statement("SET @success = 0;");
        DB::statement("SET @message = '';");

        // Llamar al SP con parámetros IN + OUT
        DB::statement("CALL sp_guiaremision(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, @idguia, @success, @message)", [
            isset($data['codigoguia']) ? $data['codigoguia'] : null,
            isset($data['fechaemision']) ? $data['fechaemision'] : null,
            isset($data['horaemision']) ? $data['horaemision'] : null,
            isset($data['razonsocialguia']) ? $data['razonsocialguia'] : null,
            isset($data['numerotrasladotim']) ? $data['numerotrasladotim'] : null,
            isset($data['motivotraslado']) ? $data['motivotraslado'] : null,
            isset($data['pesobrutototal']) ? $data['pesobrutototal'] : null,
            isset($data['volumenproducto']) ? $data['volumenproducto'] : null,
            isset($data['numerobultopallet']) ? $data['numerobultopallet'] : null,
            isset($data['observaciones']) ? $data['observaciones'] : "",
            isset($data['idconductor']) ? $data['idconductor'] : null,
            isset($data['idtipoempresa']) ? $data['idtipoempresa'] : null,
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

    public function insertardetalleguiaremision(array $data): array {
        // Definir variables de salida
        DB::statement("SET @iddetalleguia = 0;");
        DB::statement("SET @success = 0;");
        DB::statement("SET @message = '';");

        // Llamar al SP con parámetros IN + OUT
        DB::statement("CALL sp_detaleguiaremisioninsertar(?, ?, ?, ?, @iddetalleguia, @success, @message)", [
            isset($data['idguia']) ? $data['idguia'] : null,
            isset($data['idproducto']) ? $data['idproducto'] : null,
            isset($data['condicion']) ? $data['condicion'] : null,
            isset($data['cant']) ? $data['cant'] : null,
        ]);


        // Obtener resultados de las variables OUT
        $result = DB::select("SELECT @iddetalleguia as iddetalleguia, @success as success, @message as message");
        return GlobalModel::returnArray(
            $result[0]->success == 1,
            $result[0]->message,
            [
                [
                    "iddetalleguia" => $result[0]->iddetalleguia
                ]
            ]
        );
    }

    public function editarguia(array $datos): array {
        if (!isset($datos['idguia'])) {
            return GlobalModel::returnArray(false, 'idguia es obligatorio');
        }

        $id = $datos['idguia'];
        unset($datos['idguia']); // No queremos actualizar la PK

        if (empty($datos)) {
            return GlobalModel::returnArray(false, 'No hay datos para actualizar');
        }

        $guia = self::find($id);
        if (!$guia) {
            return GlobalModel::returnArray(false, 'Guia no encontrado');
        }

        // Llenamos solo los campos que existan
        foreach ($datos as $key => $value) {
            if (Schema::hasColumn('guiaremision', $key) && !is_null($value)) {
                $guia->$key = $value;
            }
        }

        $guia->save();
        return GlobalModel::returnArray(
            true,
            'Guia Editada correctamente',
            $guia
        );
    }
}
