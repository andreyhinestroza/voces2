<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Concurso;
use App\Models\Video;

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
        $concursos = $usuario->concursosPorVideos()->with('videos.votos')->get()->unique('id');

        // 👉 Relación: videos subidos por el usuario
        $misVideos = $usuario->videos()->with('votos')->get();

        // 👉 Retorno a la vista perfil
        return view('perfil', compact('usuario', 'favoritos', 'votados', 'concursos', 'misVideos'));
    }

    // 👉 Concursos activos
    public function concursosActivos()
    {
        return Concurso::where('estado', 'activo')
            ->where('activo', 1)
            ->get(['id','nombre','descripcion','fecha_inicio','fecha_fin']);
    }

    // 👉 Verificar si un video ya participa en un concurso
    public function verificarConcurso(Request $request)
    {
        $video = Video::findOrFail($request->video_id);
        return response()->json([
            'yaParticipa' => $video->id_concurso == $request->concurso_id
        ]);
    }

    // 👉 Inscribir video en concurso
    public function inscribirVideo(Request $request)
    {
        $video = Video::findOrFail($request->video_id);
        $video->id_concurso = $request->concurso_id;
        $video->save();

        return response()->json(['ok' => true, 'msg' => 'Video inscrito exitosamente']);
    }
}
