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
        'tipoinventario',
        'fecharegistro',
    ];

    public function mostraproducto(array $parametros = []): array
    {
        $query = DB::table('v_producto');

        // Búsqueda
        if (!empty($parametros['search'])) {
            $searchTerm = $parametros['search'];
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nombre', 'like', '%' . $searchTerm . '%')
                    ->orWhere('codigoproducto', 'like', '%' . $searchTerm . '%');
            });
        }

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

        if (isset($parametros['tipoinventario'])) {
            $query->where('tipoinventario', $parametros['tipoinventario']);
        }

        if (isset($parametros['fecharegistro'])) {
            $query->where('fecharegistro', $parametros['fecharegistro']);
        }

        // Ordenamiento (se aplica antes de paginar o get)
        $orderBy = $parametros['orderBy'] ?? 'idproducto';
        $orderDirection = $parametros['orderDirection'] ?? 'asc';
        $query->orderBy($orderBy, $orderDirection);

        // Si se solicita paginación
        if (isset($parametros['paginado']) && $parametros['paginado'] === true) {
            $porPagina = $parametros['porPagina'] ?? 10;
            $paginator = $query->paginate($porPagina);

            return GlobalModel::returnArray(
                $paginator->isNotEmpty(),
                $paginator->isEmpty() ? "No hay productos registrados" : "OK",
                $paginator
            );
        }


        // Sin paginación
        $resultados = $query->get();
        return GlobalModel::returnArray(
            $resultados->isNotEmpty(),
            $resultados->isEmpty() ? "No hay productos registrados" : "OK",
            $resultados->toArray()
        );
    }

    public function insertarproductos(array $data): array
    {
        // Definir variables de salida
        DB::statement("SET @idproducto = 0;");
        DB::statement("SET @success = 0;");
        DB::statement("SET @message = '';");

        // Llamar al SP con parámetros IN + OUT
        DB::statement("CALL sp_productosinsertar(?, ?, ?, ?, @idproducto, @success, @message)", [
            isset($data['codigoproducto']) ? $data['codigoproducto'] : null,
            isset($data['nombre']) ? $data['nombre'] : null,
            isset($data['tipoinventario']) ? $data['tipoinventario'] : null,
            isset($data['fecharegistro']) ? $data['fecharegistro'] : null,
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
