<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voto extends Model
{
    protected $table = 'votos';

    protected $fillable = ['id_usuario', 'id_video', 'id_concurso', 'fecha_voto'];

    // 🚫 Desactivar timestamps automáticos
    public $timestamps = false;

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function video()
    {
        return $this->belongsTo(Video::class, 'id_video');
    }

    public function concurso()
    {
        return $this->belongsTo(Concurso::class, 'id_concurso');
    }
}
