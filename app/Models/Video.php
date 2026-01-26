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

        // Si ya es embed
        if (Str::contains($url, 'embed/')) {
            return $url;
        }

        // Extraer ID de cualquier URL de YouTube
        parse_str(parse_url($url, PHP_URL_QUERY), $vars);
        if (!empty($vars['v'])) {
            return "https://www.youtube.com/embed/{$vars['v']}";
        }

        return null;
    }




    public function getYoutubeIdAttribute()
    {
        // Extrae el ID del video desde la URL
        parse_str(parse_url($this->url_video, PHP_URL_QUERY), $vars);
        return $vars['v'] ?? null;
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
