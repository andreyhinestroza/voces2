<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ConcursoController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ParticipanteController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ComunidadController;


// Rutas de autenticación predeterminadas de Laravel
Route::get('/login', [GoogleController::class, 'redirect'])->name('login');

// 🌐 Ruta principal pública (index.blade.php)
Route::get('/', [ConcursoController::class, 'index'])->name('index');

// 🌐 Comunidad
Route::get('/comunidad', [ComunidadController::class, 'index'])->name('comunidad');
Route::get('/comunidad/todos', [ComunidadController::class, 'todos'])->name('comunidad.todos');
Route::get('/comunidad/genero/{genero}', [ComunidadController::class, 'porGenero'])->name('comunidad.genero');
Route::get('/comunidad/concurso/{id}', [ComunidadController::class, 'filtrarPorGenero'])->name('comunidad.concurso');

// 🌐 Ranking (accesible solo para usuarios autenticados)
Route::middleware(['auth'])->group(function () {
    Route::get('/ranking', [RankingController::class, 'index'])->name('ranking.index');
});

// 🔐 Rutas de autenticación con Google
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('auth.google.callback');
Route::get('/logout', [GoogleController::class, 'logout'])->name('logout');

// 👤 Perfil (solo autenticados)
Route::get('/perfil', [PerfilController::class, 'index'])
    ->name('perfil')
    ->middleware('auth');

// 🎤 Concursos y videos (solo autenticados)
Route::middleware('auth')->group(function () {
    Route::get('/concursos', [ConcursoController::class, 'index'])->name('concursos');
    Route::post('/videos', [VideoController::class, 'store'])->name('video.store');
});

// 📝 Convertirse en participante
Route::get('/convertirse-participante', [ParticipanteController::class, 'index'])
    ->name('convertirse.participante');
Route::post('/convertirse-participante', [ParticipanteController::class, 'store'])
    ->name('convertirse.participante.store');

// 🎥 Subida de videos
Route::get('/videos/create', [VideoController::class, 'create'])->name('video.create');
Route::post('/videos', [VideoController::class, 'store'])->name('video.store');
