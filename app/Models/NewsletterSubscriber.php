<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    protected $table = 'newsletter'; // nombre exacto de la tabla
    protected $fillable = ['email', 'descripcion', 'estado'];
}
