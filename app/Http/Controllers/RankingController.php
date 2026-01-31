<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Video;

class RankingController extends Controller
{
    public function index()
    {
        // Top 5 general (ordenado por votos desde la vista vw_ranking_concurso)
        $ranking = Video::join('vw_ranking_concurso', 'videos.id', '=', 'vw_ranking_concurso.id_video')
            ->select('vw_ranking_concurso.*', 'videos.url_video', 'videos.id as video_id')
            ->orderByDesc('vw_ranking_concurso.votos')
            ->take(5)
            ->get();

        // Concursos activos
        $concursos = DB::table('concursos')
            ->where('estado', 'activo')
            ->get();

        // Ranking por concursos
        $videosPorConcurso = [];
        foreach ($concursos as $concurso) {
            $videos = Video::with('usuario')
                ->withCount(['votos', 'favoritos', 'comentarios']) // 👈 traemos los totales
                ->where('id_concurso', $concurso->id)
                ->orderByDesc('votos_count') // 👈 orden principal por votos
                ->get();

            $videosPorConcurso[$concurso->id] = $videos;
        }

        return view('ranking.index', compact('ranking', 'concursos', 'videosPorConcurso'));
    }
}
