<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListaReproduccion extends Model
{
    protected $table = 'listas_reproduccion'; // nombre real de la tabla
    public $timestamps = false; // no usamos created_at/updated_at

    protected $fillable = [
        'usuario_id',
        'nombre',
        'descripcion',
    ];

    /**
     * Relación: una lista pertenece a un usuario
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Relación: una lista tiene muchos videos (pivot tabla lista_video)
     */
    public function videos()
    {
        return $this->belongsToMany(Video::class, 'lista_video', 'lista_id', 'video_id');
    }
}
