<?php

namespace App\Models;

use App\Models\Global\GlobalModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Vehiculo extends Model {
    protected $table = 'vehiculos'; // Especifica el nombre exacto de la tabla
    protected $primaryKey = 'idvehiculo'; // Si tu clave primaria no se llama "id"
    public $timestamps = false; // Desactiva timestamps si tu tabla no tiene created_at / updated_at

    // Opcional: si quieres proteger o permitir ciertas columnas
    protected $fillable = [
        'placa',
        "marca",
        'tipo'
    ];

    public function mostravehiculo(array $parametros = []): array {
        $query = DB::table('v_vehiculo');
//        $query = DB::table('v_vehiculo')->where('estado', '!=', 'Eliminado');

        // Filtros condicionales
        if (isset($parametros['idvehiculo'])) {
            $query->where('idvehiculo', $parametros['idvehiculo']);
        }

        if (isset($parametros['marca'])) {
            $query->where('marca', $parametros['marca']);
        }

        if (isset($parametros['tipo'])) {
            $query->where('tipo', $parametros['tipo']);
        }

        // Verificar si se pide paginación
        if (isset($parametros['paginado']) && $parametros['paginado'] === true) {
            $porPagina = $parametros['porPagina'] ?? 10;
            $vehiculo = $query->orderByDesc('idvehiculo')->paginate($porPagina);

            return GlobalModel::returnArray(
                $vehiculo->count() > 0,
                $vehiculo->count() === 0 ? "No hay Vehiculos registrados" : "OK",
                $vehiculo // Retorna el paginador
            );
        }

        // Si no hay paginado, obtener todo
        $vehiculo = $query->get()->map(fn($item) => (array) $item)->toArray();
        return GlobalModel::returnArray(
            !empty($vehiculo),
            empty($vehiculo) ? "No hay Vehiculos registrados" : "OK",
            $vehiculo
        );
    }

    public function insertarvehiculos(array $data): array {
        // Definir variables de salida
        DB::statement("SET @idvehiculo = 0;");
        DB::statement("SET @success = 0;");
        DB::statement("SET @message = '';");

        // Llamar al SP con parámetros IN + OUT
        DB::statement("CALL sp_vehiculoinsertar(?, ?, ?, @idvehiculo, @success, @message)", [
            isset($data['placa']) ? $data['placa'] : null,
            isset($data['marca']) ? $data['marca'] : null,
            isset($data['tipo']) ? $data['tipo'] : null
        ]);


        // Obtener resultados de las variables OUT
        $result = DB::select("SELECT @idvehiculo as idvehiculo, @success as success, @message as message");
        return GlobalModel::returnArray(
            $result[0]->success == 1,
            $result[0]->message,
            [
                [
                    "idvehiculo" => $result[0]->idvehiculo
                ]
            ]
        );
    }

    public function editarvehiculo(array $datos): array {
        if (!isset($datos['idvehiculo'])) {
            return GlobalModel::returnArray(false, 'idvehiculo es obligatorio');
        }

        $id = $datos['idvehiculo'];
        unset($datos['idvehiculo']); // No queremos actualizar la PK

        if (empty($datos)) {
            return GlobalModel::returnArray(false, 'No hay datos para actualizar');
        }

        $vehiculo = self::find($id);
        if (!$vehiculo) {
            return GlobalModel::returnArray(false, 'Vehiculo no encontrado');
        }

        // Llenamos solo los campos que existan
        foreach ($datos as $key => $value) {
            if (Schema::hasColumn('vehiculos', $key) && !is_null($value)) {
                $vehiculo->$key = $value;
            }
        }

        $vehiculo->save();
        return GlobalModel::returnArray(
            true,
            'Vehiculo Editado correctamente',
            $vehiculo
        );
    }
}
