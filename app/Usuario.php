<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = "usuarios";

    /**
     * Atributos que podem ser atribuídos em massa, ou seja, que podem ser usados no método User::create()
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'email', 'cpf', 'id_grupo', 'grupo',
    ];

    /**
     * Atributos que serão omitidos caso a instância seja convertida em um array.
     *
     * @var array
     */
    protected $hidden = [
        'cpf', 'id_grupo', 'remember_token',
    ];
}
