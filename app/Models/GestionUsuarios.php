<?php

namespace App\Models;

use App\Models\Global\GlobalModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GestionUsuarios extends Model
{
    protected $table = 'users'; // Especifica el nombre exacto de la tabla
    protected $primaryKey = 'id'; // Definir la clave primaria si es necesario
    public $timestamps = false; // Desactiva timestamps si tu tabla no tiene created_at / updated_at

    // Permitir ciertas columnas
    protected $fillable = [
        'name',
        'email',
        'password',
        'idrol',
    ];

    // Mostrar usuarios
    public function mostrarusuarios(array $parametros = []): array
    {
        $query = DB::table('users');

        // Filtros condicionales
        if (isset($parametros['id'])) {
            $query->where('id', $parametros['id']);
        }

        if (isset($parametros['name'])) {
            $query->where('name', 'like', '%' . $parametros['name'] . '%');
        }

        if (isset($parametros['email'])) {
            $query->where('email', $parametros['email']);
        }

        if (isset($parametros['idrol'])) {
            $query->where('idrol', $parametros['idrol']);
        }

        // Verificar si se pide paginación
        if (isset($parametros['paginado']) && $parametros['paginado'] === true) {
            $porPagina = $parametros['porPagina'] ?? 10;
            $usuarios = $query->orderByDesc('id')->paginate($porPagina);

            return GlobalModel::returnArray(
                $usuarios->count() > 0,
                $usuarios->count() === 0 ? "No hay usuarios registrados" : "OK",
                $usuarios // Retorna el paginador
            );
        }

        // Si no hay paginado, obtener todo
        $usuarios = $query->get()->map(fn($item) => (array) $item)->toArray();
        return GlobalModel::returnArray(
            !empty($usuarios),
            empty($usuarios) ? "No hay usuarios registrados" : "OK",
            $usuarios
        );
    }

    // Metodo para insertar usuarios
    public function insertarusuarios(array $data): array
    {
        // Definir variables de salida
        DB::statement("SET @id = 0;");
        DB::statement("SET @success = 0;");
        DB::statement("SET @message = '';");

        // Llamar al SP con parámetros IN + OUT
        DB::statement("CALL sp_usuarioinsertar(?, ?, ?, ?, @id, @success, @message)", [
            isset($data['name']) ? $data['name'] : null,
            isset($data['email']) ? $data['email'] : null,
            isset($data['password']) ? $data['password'] : null,
            isset($data['idrol']) ? $data['idrol'] : null,
        ]);

        // Obtener resultados de las variables OUT
        $result = DB::select("SELECT @id as id, @success as success, @message as message");
        return GlobalModel::returnArray(
            $result[0]->success == 1,
            $result[0]->message,
            [
                [
                    "id" => $result[0]->id
                ]
            ]
        );
    }
}
