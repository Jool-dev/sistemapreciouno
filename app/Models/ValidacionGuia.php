<?php

namespace App\Models;

use App\Models\Global\GlobalModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ValidacionGuia extends Model
{
    protected $table = 'validacion'; // Especifica el nombre_razonsocial exacto de la tabla
    protected $primaryKey = 'idvalidacion'; // Si tu clave primaria no se llama "id"
    public $timestamps = false; // Desactiva timestamps si tu tabla no tiene created_at / updated_at

    // Opcional: si quieres proteger o permitir ciertas columnas
    protected $fillable = [
        'cantrecibidarevision',
        'modalidadtraslado',
        'idguia',
        'idproducto',
        'idtipocondicion',
    ];

    public function mostrarvalidacionguia(array $parametros = []): array {
//        $query = DB::table('v_transporte');
//        $query = DB::table('v_validacion')->where('estado', '!=', 'Eliminado');
        $query = DB::table('v_validacion')
            ->leftJoin('tipocondicion', 'v_validacion.idtipocondicion', '=', 'tipocondicion.idtipocondicion')
            ->select('v_validacion.*', 'tipocondicion.nombretipocondicion')
            ->where('v_validacion.estado', '!=', 'Eliminado');

        // Filtros condicionales
        if (isset($parametros['idvalidacion'])) {
            $query->where('idvalidacion', $parametros['idvalidacion']);
        }

        if (isset($parametros['cantrecibidarevision'])) {
            $query->where('cantrecibidarevision', $parametros['cantrecibidarevision']);
        }

        if (isset($parametros['modalidadtraslado'])) {
            $query->where('modalidadtraslado', $parametros['modalidadtraslado']);
        }

        if (isset($parametros['idguia'])) {
            $query->where('idguia', $parametros['idguia']);
        }

        if (isset($parametros['idproducto'])) {
            $query->where('idproducto', $parametros['idproducto']);
        }

        if (isset($parametros['idtipocondicion'])) {
            $query->where('idtipocondicion', $parametros['idtipocondicion']);
        }

        // Verificar si se pide paginación
        if (isset($parametros['paginado']) && $parametros['paginado'] === true) {
            $porPagina = $parametros['porPagina'] ?? 10;
            $validacion = $query->orderByDesc('idvalidacion')->paginate($porPagina);

            return GlobalModel::returnArray(
                $validacion->count() > 0,
                $validacion->count() === 0 ? "No hay validaciones registradas" : "OK",
                $validacion // Retorna el paginador
            );
        }

        // Si no hay paginado, obtener todo
        $validacion = $query->get()->map(fn($item) => (array) $item)->toArray();
        return GlobalModel::returnArray(
            !empty($validacion),
            empty($validacion) ? "No hay validaciones registradas" : "OK",
            $validacion
        );
    }

    // Método para obtener productos por condición
    public function obtenerProductosPorCondicion($idguia)
    {
        $validacion = $this->mostrarvalidacionguia(['idguia' => $idguia]);

        if (!$validacion['success']) {
            return [
                'success' => false,
                'message' => $validacion['message'],
                'data' => []
            ];
        }

        $productos = collect($validacion['data']);

        return [
            'success' => true,
            'message' => 'OK',
            'data' => [
                'productosBuenos' => $productos->where('idtipocondicion', 1)->all(),
                'productosDañados' => $productos->where('idtipocondicion', 2)->all(),
                'productosRegulares' => $productos->where('idtipocondicion', 3)->all(),
            ]
        ];
    }
}
