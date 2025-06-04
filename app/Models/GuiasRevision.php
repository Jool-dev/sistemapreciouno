<?php

namespace App\Models;

use App\Models\Global\GlobalModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GuiasRevision extends Model
{
    protected $table = 'productos'; // Especifica el cantidadrecibida exacto de la tabla
    protected $primaryKey = 'iddetalleguia'; // Si tu clave primaria no se llama "id"
    public $timestamps = false; // Desactiva timestamps si tu tabla no tiene created_at / updated_at

    // Opcional: si quieres proteger o permitir ciertas columnas
    protected $fillable = [
        'cantidadrecibida',
        'estadorevision',
        'estado'
    ];

    public function mostraguia(array $parametros = []): array
    {
        $query = DB::table('v_detalle_guias');

        // Filtros condicionales
        if (isset($parametros['iddetalleguia']) && $parametros['iddetalleguia']) {
            $query->where('iddetalleguia', $parametros['iddetalleguia']);
        }

        if (isset($parametros['cantidadrecibida'])) {
            $query->where('cantidadrecibida', $parametros['cantidadrecibida']);
        }

        if (isset($parametros['estadorevision'])) {
            $query->where('estadorevision', $parametros['estadorevision']);
        }

        if (isset($parametros['estado'])) {
            $query->where('estado', $parametros['estado']);
        }

        if (isset($parametros['fecharegistro'])) {
            $query->where('fecharegistro', $parametros['fecharegistro']);
        }

        // Verificar si se pide paginación
        if (isset($parametros['paginado']) && $parametros['paginado'] === true) {
            $porPagina = $parametros['porPagina'] ?? 10;
            $producto = $query->orderByDesc('iddetalleguia')->paginate($porPagina);

            return GlobalModel::returnArray(
                $producto->count() > 0,
                $producto->count() === 0 ? "No hay productos registrados" : "OK",
                $producto // Retorna el paginador
            );
        }

        // Si no hay paginado, obtener todo
        $producto = $query->get()->map(fn($item) => (array) $item)->toArray();
        return GlobalModel::returnArray(
            !empty($producto),
            empty($producto) ? "No hay guias de revision registrados" : "OK",
            $producto
        );
    }

    public function insertarguiarevision(array $data): array
    {
        // Definir variables de salida
        DB::statement("SET @iddetalleguia = 0;");
        DB::statement("SET @success = 0;");
        DB::statement("SET @message = '';");

        // Llamar al SP con parámetros IN + OUT
        DB::statement("CALL sp_productosinsertar(?, ?, ?, ?, @iddetalleguia, @success, @message)", [
            isset($data['cantidadrecibida']) ? $data['cantidadrecibida'] : null,
            isset($data['estadorevision']) ? $data['estadorevision'] : null,
            isset($data['estado']) ? $data['estado'] : null,
            isset($data['fecharegistro']) ? $data['fecharegistro'] : null
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

    public function insertardetalleguiarevicion_validacion(array $data): array
    {
        // Definir variables de salida
        DB::statement("SET @idvalidacionguia = 0;");
        DB::statement("SET @success = 0;");
        DB::statement("SET @message = '';");

        // Llamar al SP con parámetros IN + OUT
        DB::statement("CALL sp_validacioninsertar(?, ?, ?, ?, @idvalidacionguia, @success, @message)", [
            isset($data['idguia']) ? $data['idguia'] : null,
            isset($data['idproducto']) ? $data['idproducto'] : null,
            isset($data['cant']) ? $data['cant'] : null,
            isset($data['condicion']) ? $data['condicion'] : null
        ]);


        // Obtener resultados de las variables OUT
        $result = DB::select("SELECT @idvalidacionguia as idvalidacionguia, @success as success, @message as message");
        return GlobalModel::returnArray(
            $result[0]->success == 1,
            $result[0]->message,
            [
                [
                    "idvalidacionguia" => $result[0]->idvalidacionguia
                ]
            ]
        );
    }
}
