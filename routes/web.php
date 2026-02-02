<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ConcursoController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ParticipanteController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ComunidadController;
use App\Http\Controllers\InteraccionController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ListaVideoController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\AdminController;


// 🌐 API para newsletter (Admin)
Route::post('/newsletter/suscribir', [AdminController::class, 'suscribirNewsletter']);
Route::get('/api/newsletter', [AdminController::class, 'listarNewsletter']);
Route::delete('/api/newsletter/{id}', [AdminController::class, 'eliminarNewsletter']);
Route::post('/newsletter/enviar', [AdminController::class, 'enviarNewsletter']);

// 🌐 API para concursos (Admin)
Route::get('/api/concursos', [AdminController::class, 'listarConcursos']);
Route::post('/api/concursos', [AdminController::class, 'crearConcurso']);
Route::post('/api/concursos/{id}/toggle', [AdminController::class, 'toggleConcurso']);
Route::delete('/api/concursos/{id}', [AdminController::class, 'eliminarConcurso']);


// 🌐 API para notificaciones (Admin)
Route::get('/api/notificaciones', [AdminController::class, 'listarNotificaciones']);
Route::post('/api/notificaciones', [AdminController::class, 'crearNotificacion']);
Route::post('/api/notificaciones/{id}/toggle', [AdminController::class, 'toggleEstado']);
Route::delete('/api/notificaciones/{id}', [AdminController::class, 'eliminarNotificacion']);


// 🌐 Newsletter Subscription
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])
    ->name('newsletter.subscribe');

// 🌐 Admin - Listar notificaciones   
Route::get('/api/notificaciones', [AdminController::class, 'listarNotificaciones']);


Route::middleware('auth')->group(function () {
    // ⭐ Interacciones
    Route::post('/interacciones/favorito',   [InteraccionController::class, 'toggleFavorito'])->name('interacciones.favorito');
    Route::post('/interacciones/voto',       [InteraccionController::class, 'toggleVoto'])->name('interacciones.voto');
    Route::post('/interacciones/comentario', [InteraccionController::class, 'guardarComentario'])->name('interacciones.comentario');

    // ⭐ CRUD de listas
    Route::post('/listas-reproduccion/{id}/editar', [UsuarioController::class, 'editarLista'])->name('listas.editar');
    Route::delete('/listas-reproduccion/{id}', [UsuarioController::class, 'eliminarLista'])->name('listas.eliminar');
    Route::post('/listas-reproduccion', [UsuarioController::class, 'guardarLista'])->name('listas.guardar');
    Route::get('/listas-reproduccion', [UsuarioController::class, 'listasReproduccion'])->name('listas.reproduccion');

    // ⭐ Gestión de videos en listas (solo con ListaVideoController)
    Route::get('/videos-disponibles', [VideoController::class, 'listarDisponibles'])->name('videos.disponibles');
    Route::post('/listas-reproduccion/{id}/videos', [ListaVideoController::class, 'agregarVideo'])->name('listas.agregarVideo');
    Route::delete('/listas-reproduccion/{id}/videos/{videoId}', [ListaVideoController::class, 'eliminarVideo'])->name('listas.quitarVideo');

    // ⭐ Videos que me gustan / votados
    Route::get('/videos-megustan', [UsuarioController::class, 'videosMeGustan'])->name('videos.megustan');
    Route::get('/videos-votados', [UsuarioController::class, 'videosVotados'])->name('videos.votados');

    // ⭐ Historial
    Route::get('/historial', [ComunidadController::class, 'historial'])->name('usuario.historial');

    // ⭐ Ranking
    Route::get('/ranking', [RankingController::class, 'index'])->name('ranking.index');

    // ⭐ Perfil
    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');

    // ⭐ Concursos y videos
    Route::get('/concursos', [ConcursoController::class, 'index'])->name('concursos');
    
});

// 🔐 Autenticación con Google
Route::get('/login', [GoogleController::class, 'redirect'])->name('login');
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('auth.google.callback');
Route::get('/logout', [GoogleController::class, 'logout'])->name('logout');

// 🌐 Ruta principal pública
Route::get('/', [ConcursoController::class, 'index'])->name('index');

// 🌐 Comunidad Route::get('/comunidad', [ConcursoController::class, 'index'])->name('comunidad');

Route::get('/comunidad', [ComunidadController::class, 'index'])->name('comunidad');
Route::get('/comunidad/todos', [ComunidadController::class, 'todos'])->name('comunidad.todos');
Route::get('/comunidad/genero/{genero}', [ComunidadController::class, 'porGenero'])->name('comunidad.genero');
Route::get('/comunidad/concurso/{id}', [ComunidadController::class, 'filtrarPorGenero'])->name('comunidad.concurso');

// 📝 Convertirse en participante
Route::get('/convertirse-participante', [ParticipanteController::class, 'index'])->name('convertirse.participante');
Route::post('/convertirse-participante', [ParticipanteController::class, 'store'])->name('convertirse.participante.store');

// 🎥 Subida de videos
Route::get('/videos/create', [VideoController::class, 'create'])->name('video.create');
Route::post('/video/store', [VideoController::class, 'store'])->name('video.store');

// 🌐 API para perfil
Route::get('/api/concursos-activos', [PerfilController::class, 'concursosActivos']);
Route::get('/api/verificar-concurso', [PerfilController::class, 'verificarConcurso']);
Route::post('/api/inscribir-video', [PerfilController::class, 'inscribirVideo']);

