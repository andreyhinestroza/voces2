<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Video;

class VideoController extends Controller
{
    /**
     * Mostrar formulario de creación de video
     */
    public function create()
    {
        if (Auth::user()->rol !== 'participante') {
            return redirect()->route('convertirse.participante')
                             ->with('error', 'Debes ser participante para subir videos.');
        }

        $concursos = \App\Models\Concurso::all();
        return view('videos.create', compact('concursos'));
    }

    /**
     * Guardar un nuevo video
     */
    public function store(Request $request)
{
    // Validación flexible para enlaces de YouTube
    $request->validate([
        'titulo' => 'required|string|max:255',
        'url_video' => [
            'required',
            'url',
            'regex:/^(https?:\/\/)?(www\.)?(youtube\.com\/watch\?v=|youtu\.be\/)[\w\-]+.*$/'
        ],
        'genero' => 'required|string|max:100',
        'id_concurso' => 'nullable|integer',
    ], [
        'titulo.required' => 'El título del video es obligatorio.',
        'url_video.required' => 'Debes ingresar el enlace de YouTube.',
        'url_video.url' => 'El enlace debe ser una URL válida.',
        'url_video.regex' => 'El enlace debe ser un enlace válido de YouTube (watch?v= o youtu.be).',
        'genero.required' => 'Selecciona un género musical.',
        'id_concurso.integer' => 'El concurso seleccionado no es válido.',
    ]);

    // Crear el registro en la tabla videos
    Video::create([
        'id_usuario'   => Auth::user()->id,
        'id_concurso'  => $request->id_concurso == 0 ? null : $request->id_concurso,
        'titulo'       => $request->titulo,
        'url_video'    => $request->url_video,
        'fecha_subida' => now(),
        'genero'       => $request->genero,
    ]);

    // Redirigir con mensaje de éxito
    return redirect()->back()->with('success', '¡Tu video ha sido subido exitosamente!');
}


    /**
     * Listar videos disponibles para agregar a listas
     */
    public function listarDisponibles()
    {
        // Incluimos el accessor embed_url para que el frontend no tenga que calcularlo
        $videos = Video::all()->map(function ($video) {
            return [
                'id' => $video->id,
                'titulo' => $video->titulo,
                'genero' => $video->genero,
                'embed_url' => $video->embed_url, // accessor en el modelo
            ];
        });

        return response()->json($videos);
    }
}
