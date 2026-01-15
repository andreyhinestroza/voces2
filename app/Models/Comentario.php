<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $table = 'comentarios';

    protected $fillable = ['usuario_id', 'video_id', 'comentario'];

    // Relaciones opcionales
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');
    }
}
