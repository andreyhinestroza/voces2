<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\User;
use App\Models\Concurso; // o tu modelo de géneros

class ComunidadController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            // Si no está logueado, lo mandamos al login de Google
            return redirect()->route('auth.google');
        }

        // Si está logueado, sin importar el rol, carga la comunidad
        $videos = \App\Models\Video::with('usuario')
                    ->orderBy('fecha_subida', 'desc')
                    ->get();

        $artistas = \App\Models\User::where('rol', 'participante')->get();
        $generos = \App\Models\Concurso::all();

        return view('comunidad', compact('videos', 'artistas', 'generos'));
    }



    public function porGenero($genero)
    {
        $videos = Video::where('genero', $genero)->get();
        return view('comunidad_genero', compact('genero', 'videos'));
    }

   
    public function todos()
    {
        // Obtener todos los géneros únicos
        $generos = \App\Models\Video::select('genero')->distinct()->pluck('genero');

        $generoVideos = [];

        foreach ($generos as $nombreGenero) {
            // 3 videos aleatorios por género
            $videos = \App\Models\Video::with('usuario')
                        ->where('genero', $nombreGenero)
                        ->inRandomOrder()
                        ->take(3)
                        ->get();

            $generoVideos[] = [
                'genero' => $nombreGenero,
                'videos' => $videos
            ];
        }

        return view('comunidad_generos', compact('generoVideos'));
    }




    public function filtrarPorGenero($id)
    {
        $videos = \App\Models\Video::with('usuario')
                    ->where('id_concurso', $id)
                    ->orderBy('fecha_subida', 'desc')
                    ->get();

        $artistas = \App\Models\User::where('rol', 'participante')->get();
        $generos = \App\Models\Concurso::all();

        return view('comunidad', compact('videos', 'artistas', 'generos'));
    }

}


