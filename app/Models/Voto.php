<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voto extends Model
{
    protected $table = 'votos';
    protected $fillable = ['id_usuario', 'id_concurso', 'id_video', 'fecha_voto'];

    // Relación: un voto pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    // Relación: un voto pertenece a un video
    public function video()
    {
        return $this->belongsTo(Video::class, 'id_video');
    }

    // Relación: un voto pertenece a un concurso
    public function concurso()
    {
        return $this->belongsTo(Concurso::class, 'id_concurso');
    }
}
