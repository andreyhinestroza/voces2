<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios'; // Nombre real de tu tabla
    public $timestamps = false;    // Si no usas created_at/updated_at

    protected $fillable = [
        'nombre',
        'correo',
        'rol',
        'foto',
        'fecha_registro',
        'password',
    ];

    /**
     * 👉 Casts: convierte automáticamente campos a tipos nativos.
     * Con esto, fecha_registro será tratado como objeto Carbon.
     */
    protected $casts = [
        'fecha_registro' => 'datetime',
    ];

    // Relación: un usuario tiene muchos videos
    public function videos()
    {
        return $this->hasMany(Video::class, 'id_usuario');
    }

    // Relación: favoritos del usuario
    public function favoritos()
    {
        return $this->belongsToMany(Video::class, 'favoritos', 'usuario_id', 'video_id');
    }

    // Relación: votos emitidos por el usuario
    public function votosEmitidos()
    {
        return $this->hasMany(Voto::class, 'id_usuario');
    }

    // Relación: concursos a través de sus videos (Opción A)
    public function concursosPorVideos()
    {
        return $this->hasManyThrough(
            Concurso::class,   // Modelo destino
            Video::class,      // Modelo intermedio
            'id_usuario',      // FK en videos que apunta a usuarios
            'id',              // PK en concursos
            'id',              // PK en usuarios
            'id_concurso'      // FK en videos que apunta a concursos
        );
    }
}
