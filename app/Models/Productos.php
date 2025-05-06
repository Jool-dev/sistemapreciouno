<?php

namespace App\Models;

use App\Models\Global\GlobalModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Productos extends Model
{
    protected $table = 'productos'; // Especifica el nombre exacto de la tabla
    protected $primaryKey = 'idproducto'; // Si tu clave primaria no se llama "id"
    public $timestamps = false; // Desactiva timestamps si tu tabla no tiene created_at / updated_at

    // Opcional: si quieres proteger o permitir ciertas columnas
    protected $fillable = [
        'codigoproducto',
        'nombre',
        'tipocodproducto',
        'tipoinventario',
        'fecharegistro'
    ];

    public function mostraproducto(array $parametros = []): array {
        $query = DB::table('v_producto');

        // Filtros condicionales
        if (isset($parametros['idproducto'])) {
            $query->where('idproducto', $parametros['idproducto']);
        }

        if (isset($parametros['codigoproducto'])) {
            $query->where('codigoproducto', $parametros['codigoproducto']);
        }

        if (isset($parametros['nombre'])) {
            $query->where('nombre', $parametros['nombre']);
        }

        if (isset($parametros['tipocodproducto'])) {
            $query->where('tipocodproducto', $parametros['tipocodproducto']);
        }

        if (isset($parametros['tipoinventario'])) {
            $query->where('tipoinventario', $parametros['tipoinventario']);
        }

        if (isset($parametros['fecharegistro'])) {
            $query->where('fecharegistro', $parametros['fecharegistro']);
        }

        // Verificar si se pide paginación
        if (isset($parametros['paginado']) && $parametros['paginado'] === true) {
            $porPagina = $parametros['porPagina'] ?? 10;
            $producto = $query->orderByDesc('idproducto')->paginate($porPagina);

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
            empty($producto) ? "No hay productos registrados" : "OK",
            $producto
        );
    }

    public function insertarproductos(array $data): array {
        // Definir variables de salida
        DB::statement("SET @idproducto = 0;");
        DB::statement("SET @success = 0;");
        DB::statement("SET @message = '';");

        // Llamar al SP con parámetros IN + OUT
        DB::statement("CALL sp_productosinsertar(?, ?, ?, ?, @idproducto, @success, @message)", [
            isset($data['nombre']) ? $data['nombre'] : null,
            isset($data['sku']) ? $data['sku'] : null,
            isset($data['estado']) ? $data['estado'] : null,
            isset($data['fecharegistro']) ? $data['fecharegistro'] : null
        ]);


        // Obtener resultados de las variables OUT
        $result = DB::select("SELECT @idproducto as idproducto, @success as success, @message as message");
        return GlobalModel::returnArray(
            $result[0]->success == 1,
            $result[0]->message,
            [
                [
                    "idproducto" => $result[0]->idproducto
                ]
            ]
        );
    }
}
