<?php 

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function index()
    {
        // 👉 Usuario autenticado
        $usuario = Auth::user();

        // 👉 Relación: videos favoritos del usuario
        $favoritos = $usuario->favoritos()->with('usuario')->get();

        // 👉 Relación: videos votados por el usuario
        $votados = $usuario->votosEmitidos()->with('video.usuario')->get()->pluck('video');

        // 👉 Relación: concursos en los que participa (derivados de sus videos)
        // Se obtienen los concursos a través de los videos subidos por el usuario
        $concursos = $usuario->concursosPorVideos()->with('videos.votos')->get()->unique('id');

        // 👉 Relación: videos subidos por el usuario
        $misVideos = $usuario->videos()->with('votos')->get();

        // 👉 Retorno a la vista perfil
        return view('perfil', compact('usuario', 'favoritos', 'votados', 'concursos', 'misVideos'));
    }
}
