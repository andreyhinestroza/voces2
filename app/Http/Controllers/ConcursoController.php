<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Concurso;

class ConcursoController extends Controller
{
    /**
     * Página principal: muestra 3 géneros aleatorios con un video cada uno
     */
    public function index()
    {
        // Obtener 3 géneros aleatorios desde los videos
        $generos = Video::select('genero')
                        ->distinct()
                        ->inRandomOrder()
                        ->take(3)
                        ->pluck('genero');

        $generoVideos = [];
        foreach ($generos as $nombreGenero) {
            $video = Video::with('usuario')
                        ->where('genero', $nombreGenero)
                        ->inRandomOrder()
                        ->first();
            if ($video) {
                $generoVideos[] = [
                    'genero' => $nombreGenero,
                    'video'  => $video
                ];
            }
        }

        // Traer concursos activos
        $concursos = Concurso::where('activo', 1)->get();

        // Traer los 6 videos más recientes
        $videosRecientes = Video::with('usuario')
                                ->orderByDesc('fecha_subida')
                                ->take(6)
                                ->get();

        return view('index', compact('generoVideos', 'concursos', 'videosRecientes'));
    }



    /**
     * Vista que muestra todos los géneros y sus videos agrupados
     */
    public function todos()
    {
        $generos = Video::select('genero')->distinct()->pluck('genero');

        $generoVideos = [];

        foreach ($generos as $nombreGenero) {
            $videos = Video::with('usuario')
                        ->where('genero', $nombreGenero)
                        ->orderByDesc('fecha_subida')
                        ->take(3)
                        ->get();

            $generoVideos[] = [
                'genero' => $nombreGenero,
                'videos' => $videos
            ];
        }

        return view('comunidad_generos', compact('generoVideos'));
    }   
}
