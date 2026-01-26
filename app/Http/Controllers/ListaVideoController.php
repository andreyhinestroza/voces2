<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListaVideo;

class ListaVideoController extends Controller
{
    /**
     * Agregar un video a una lista de reproducción
     */
    public function agregarVideo(Request $request, $id)
    {
        $request->validate([
            'video_id' => 'required|integer|exists:videos,id',
        ]);

        // Evita duplicados
        $existe = ListaVideo::where('lista_id', $id)
                            ->where('video_id', $request->video_id)
                            ->exists();

        if (!$existe) {
            ListaVideo::create([
                'lista_id' => $id,
                'video_id' => $request->video_id,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Video agregado correctamente']);
    }

    /**
     * Eliminar un video de una lista de reproducción
     */
    public function eliminarVideo($id, $videoId)
    {
        $deleted = ListaVideo::where('lista_id', $id)
                             ->where('video_id', $videoId)
                             ->delete();

        return response()->json([
            'success' => $deleted > 0,
            'message' => $deleted ? 'Video eliminado correctamente' : 'El video no estaba en la lista'
        ]);
    }
}
