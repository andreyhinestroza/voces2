<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table = 'notificaciones'; // nombre exacto de la tabla
    protected $fillable = ['descripcion', 'tipo', 'estado'];
}

