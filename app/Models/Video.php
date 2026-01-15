<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Video extends Model
{
    protected $table = 'videos';
    public $timestamps = false; // tu tabla no tiene created_at/updated_at

    protected $fillable = [
        'id_usuario',
        'id_concurso',
        'titulo',
        'url_video',
        'fecha_subida',
        'genero',
    ];

    // Accesor: obtener la URL embebida de YouTube
    public function getEmbedUrlAttribute()
    {
        $url = $this->url_video;

        if (Str::contains($url, 'embed/')) {
            return $url;
        }

        if (Str::contains($url, 'youtu.be/')) {
            $id = Str::after($url, 'youtu.be/');
            $id = Str::before($id, '?');
            return "https://www.youtube.com/embed/{$id}?enablejsapi=1";
        }

        if (Str::contains($url, 'watch?v=')) {
            $id = Str::after($url, 'v=');
            $id = Str::before($id, '&');
            return "https://www.youtube.com/embed/{$id}?enablejsapi=1";
        }

        return null;
    }

    // Relación: un video pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    // Relación: un video pertenece a un concurso
    public function concurso()
    {
        return $this->belongsTo(Concurso::class, 'id_concurso', 'id');
    }

    // Opcional: si quieres que Eloquent trate fecha_subida como created_at
    const CREATED_AT = 'fecha_subida';
    const UPDATED_AT = null;

    // Relación: votos recibidos por el video
    public function votos()
    {
        return $this->hasMany(Voto::class, 'id_video');
    }

    // Relación: favoritos recibidos por el video
    public function favoritos()
    {
        return $this->hasMany(Favorito::class, 'video_id');
    }

    // Relación: comentarios recibidos por el video
    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'video_id');
    }

    // Accesor: contar votos fácilmente
    public function getVotosCountAttribute()
    {
        return $this->votos()->count();
    }
}
