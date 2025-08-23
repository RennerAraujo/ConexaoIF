<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $table = 'usuarios';


    protected $fillable = [
        'nome',
        'matricula',
        'email',
        'senha',
        'perfil_path',
        'role',
    ];


    protected $hidden = [
        'senha',
        'remember_token',
    ];


    protected $casts = [
        'senha' => 'hashed',
    ];

    /**
     * Informa ao sistema de autenticação que o nome da nossa coluna de senha é 'senha'.
     *
     * @return string
     */
    public function getAuthPasswordName(): string
    {
        return 'senha';
    }
}
