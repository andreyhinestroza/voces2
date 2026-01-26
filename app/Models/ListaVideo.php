<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListaVideo extends Model
{
    protected $table = 'lista_video';

    protected $fillable = ['lista_id', 'video_id'];

    public $timestamps = false;
}
