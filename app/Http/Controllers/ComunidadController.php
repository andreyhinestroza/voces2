<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\User;
use App\Models\Concurso;




class ComunidadController extends Controller
{
    /**
     * Página principal de Comunidad.
     * Muestra todos los concursos (activos e inactivos),
     * todos los videos y los artistas suscritos.
     */
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('auth.google');
        }

        $usuarioId = auth()->id();

        // Traer todos los concursos (activos e inactivos)
        $concursos = Concurso::all();

        // Agrupar videos por concurso
        $videosPorConcurso = [];
        foreach ($concursos as $concurso) {
            $videos = Video::with('usuario')
                ->withCount(['votos', 'favoritos', 'comentarios']) // agrega *_count
                ->with([
                    'favoritos' => function ($q) use ($usuarioId) {
                        $q->where('usuario_id', $usuarioId);
                    },
                    // Traer todos los comentarios con su usuario (sin filtrar por usuarioId)
                    'comentarios.usuario'
                ])
                ->where('id_concurso', $concurso->id)
                ->orderByDesc('votos_count')
                ->get();

            $videosPorConcurso[$concurso->id] = $videos;
        }


        // Artistas suscritos
        $artistas = User::where('rol', 'participante')->get();

        // Enviar todo a la vista
        return view('comunidad', compact('concursos', 'videosPorConcurso', 'artistas'));
    }



    /**
     * Filtrar videos por concurso (recibe el ID del concurso).
     * Se reutiliza la misma vista comunidad.blade.php.
     */
    public function filtrarPorConcurso($id)
    {
        // Traemos solo los videos de ese concurso
        $videos = Video::with('usuario')
                    ->where('id_concurso', $id)
                    ->orderBy('fecha_subida', 'desc')
                    ->get();

        // Artistas suscritos
        $artistas = User::where('rol', 'participante')->get();

        // Todos los concursos (para mostrar botones activos e inactivos)
        $concursos = Concurso::all();

        // Reutilizamos la misma vista comunidad.blade.php
        return view('comunidad', compact('videos', 'artistas', 'concursos'));
    }


    public function todos()
    {
        // Obtener todos los géneros únicos desde los videos
        $generos = Video::select('genero')->distinct()->pluck('genero');

        $generoVideos = [];

        foreach ($generos as $nombreGenero) {
            // Traer videos de cada género (ejemplo: 3 aleatorios)
            $videos = Video::with('usuario')
                        ->where('genero', $nombreGenero)
                        ->inRandomOrder()
                        ->take(3)
                        ->get();

            $generoVideos[] = [
                'genero' => $nombreGenero,
                'videos' => $videos
            ];
        }

        // Retornar la vista comunidad_generos.blade.php
        return view('comunidad_generos', compact('generoVideos'));
    }

}
