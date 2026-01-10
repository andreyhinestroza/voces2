<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Concurso extends Model
{
    protected $table = 'concursos';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        // otros campos que tengas
    ];

    // 👉 Relación: un concurso tiene muchos videos
    public function videos()
    {
        return $this->hasMany(Video::class, 'id_concurso');
    }
}
