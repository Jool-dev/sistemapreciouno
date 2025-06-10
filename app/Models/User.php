<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Global\GlobalModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'idrol'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function login(array $parametros): array
    {
        global $message, $usuario;
        $usuario = $this->existeusuario($parametros["login"]);
        if ($usuario["data"] === null) {
            $message = "El Login no existe";
        } else if (Hash::check($parametros["password"], $usuario["data"]->password)) {
            $message = "OK";
        } else {
            $message = "La Clave es Incorrecta";
        }

        return GlobalModel::returnArray(!empty($usuario), $message, $usuario["data"]);
    }
    public function existeusuario($login): array
    {
        $query = DB::table('v_usuario');
        $usuario = $query->where('email', $login)->get()->map(function ($item) {
            return (array) $item;
        })->toArray();

        return GlobalModel::returnArray(
            !empty($usuario),
            empty($usuario) ? "No Existe Usuario" : "Existe Usuario",
            $usuario
        );
    }
}
