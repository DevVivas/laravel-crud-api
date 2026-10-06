<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = 'estudiante';
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'lenguaje',
    ];
}
