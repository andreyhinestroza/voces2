<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Favorito;
use App\Models\Voto;
use App\Models\ListaReproduccion;




class UsuarioController extends Controller
{


    // Editar lista
    public function editarLista(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $lista = ListaReproduccion::where('usuario_id', auth()->id())->findOrFail($id);
        $lista->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('listas.reproduccion')->with('success', 'Lista actualizada correctamente');
    }

    // Eliminar lista
    public function eliminarLista($id)
    {
        $lista = ListaReproduccion::where('usuario_id', auth()->id())->findOrFail($id);
        $lista->delete();

        return redirect()->route('listas.reproduccion')->with('success', 'Lista eliminada correctamente');
    }

    // Agregar video a lista
    public function agregarVideo(Request $request, $listaId)
    {
        $request->validate([
            'video_id' => 'required|exists:videos,id',
        ]);

        $lista = ListaReproduccion::where('usuario_id', auth()->id())->findOrFail($listaId);
        $lista->videos()->attach($request->video_id);

        return redirect()->route('listas.reproduccion')->with('success', 'Video agregado a la lista');
    }

    // Quitar video de lista
    public function quitarVideo($listaId, $videoId)
    {
        $lista = ListaReproduccion::where('usuario_id', auth()->id())->findOrFail($listaId);
        $lista->videos()->detach($videoId);

        return redirect()->route('listas.reproduccion')->with('success', 'Video eliminado de la lista');
    }


    public function guardarLista(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        ListaReproduccion::create([
            'usuario_id' => auth()->id(),
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('listas.reproduccion')->with('success', 'Lista creada correctamente');
    }

    public function videosMeGustan()
    {
        $usuarioId = auth()->id();
        $videos = Video::with('usuario')
            ->whereHas('favoritos', function($q) use ($usuarioId) {
                $q->where('usuario_id', $usuarioId);
            })
            ->get();

        return view('usuario.videos_megustan', compact('videos'));
    }

    public function videosVotados()
    {
        $usuarioId = auth()->id();
        $videos = Video::with('usuario')
            ->whereHas('votos', function($q) use ($usuarioId) {
                $q->where('id_usuario', $usuarioId);
            })
            ->get();

        return view('usuario.videos_votados', compact('videos'));
    }

    public function listasReproduccion()
    {
        $usuarioId = auth()->id();

        $listas = ListaReproduccion::with(['videos.usuario'])->where('usuario_id', $usuarioId)->get();

        return view('usuario.listas', compact('listas'));
    }

}


