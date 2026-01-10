<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Video; // 👉 importa tu modelo Video

class RankingController extends Controller
{
    public function index()
    {
        // Ranking general
        $ranking = Video::join('vw_ranking_concurso', 'videos.id', '=', 'vw_ranking_concurso.id_video')
            ->select('vw_ranking_concurso.*', 'videos.url_video', 'videos.id as video_id')
            ->orderByDesc('vw_ranking_concurso.votos')
            ->take(5)
            ->get();

        // Concursos activos
        $concursos = DB::table('concursos')
            ->where('estado', 'activo')
            ->get();

        // Videos por concurso
        $videosPorConcurso = [];
        foreach ($concursos as $concurso) {
            $videos = Video::with('usuario')
                ->where('id_concurso', $concurso->id)
                ->orderByDesc(DB::raw('(SELECT COUNT(*) FROM votos WHERE votos.id_video = videos.id)'))
                ->get();

            $videosPorConcurso[$concurso->id] = $videos;
        }

        return view('ranking.index', compact('ranking', 'concursos', 'videosPorConcurso'));
    }

}
