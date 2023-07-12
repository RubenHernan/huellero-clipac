<?php

namespace App\Models\Huellero;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHuella extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = [
        'cod_usuario',
        'nombres',
        'apellidos',
    ];
}
