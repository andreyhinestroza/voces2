<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorito;
use App\Models\Voto;
use App\Models\Comentario;

class InteraccionController extends Controller
{
    public function toggleFavorito(Request $request)
    {
        $usuarioId = auth()->id();
        if (!$usuarioId) {
            return response()->json(['ok' => false, 'msg' => 'No autenticado'], 401);
        }

        $videoId = $request->video_id;
        if (!$videoId) {
            return response()->json(['ok' => false, 'msg' => 'video_id requerido'], 422);
        }

        $existe = Favorito::where('usuario_id', $usuarioId)->where('video_id', $videoId)->first();

        if ($existe) {
            $existe->delete();
            $estado = 'quitado';
        } else {
            Favorito::create(['usuario_id' => $usuarioId, 'video_id' => $videoId]);
            $estado = 'puesto';
        }

        return response()->json([
            'ok' => true,
            'estado' => $estado,
            'total' => Favorito::where('video_id', $videoId)->count()
        ]);
    }

    public function toggleVoto(Request $request)
    {
        $usuarioId  = auth()->id();
        $idVideo    = $request->video_id;
        $idConcurso = $request->concurso_id;

        if (!$usuarioId || !$idVideo || !$idConcurso) {
            return response()->json(['ok' => false, 'msg' => 'video_id y concurso_id requeridos'], 422);
        }

        try {
            $voto = Voto::where('id_usuario', $usuarioId)
                        ->where('id_video', $idVideo)
                        ->where('id_concurso', $idConcurso)
                        ->first();

            if ($voto) {
                $voto->delete();
                $estado = 'quitado';
            } else {
                Voto::updateOrCreate(
                    ['id_usuario' => $usuarioId, 'id_video' => $idVideo, 'id_concurso' => $idConcurso],
                    ['fecha_voto' => now()]
                );
                $estado = 'puesto';
            }

            return response()->json([
                'ok' => true,
                'estado' => $estado,
                'total' => Voto::where('id_video', $idVideo)->where('id_concurso', $idConcurso)->count()
            ]);
        } catch (\Exception $e) {
            if (str_contains($e->getMessage(), 'Duplicate entry')) {
                return response()->json([
                    'ok' => false,
                    'msg' => 'Solo puedes votar una vez por concurso.'
                ], 409);
            }

            return response()->json([
                'ok' => false,
                'msg' => 'Error al registrar voto',
                'error' => $e->getMessage()
            ], 500);
        }
    }







    public function guardarComentario(Request $request)
    {
        $usuarioId = auth()->id();
        if (!$usuarioId) {
            return response()->json(['ok' => false, 'msg' => 'No autenticado'], 401);
        }

        $videoId = $request->video_id;
        $texto   = trim($request->comentario);
        if (!$videoId || $texto === '') {
            return response()->json(['ok' => false, 'msg' => 'Datos incompletos'], 422);
        }

        $coment = Comentario::where('usuario_id', $usuarioId)->where('video_id', $videoId)->first();

        if ($coment) {
            $coment->update(['comentario' => $texto]);
            $estado = 'actualizado';
        } else {
            Comentario::create(['usuario_id' => $usuarioId, 'video_id' => $videoId, 'comentario' => $texto]);
            $estado = 'puesto';
        }

        return response()->json([
            'ok' => true,
            'estado' => $estado,
            'total' => Comentario::where('video_id', $videoId)->count()
        ]);
    }

    public function eliminarComentario($videoId)
    {
        $usuarioId = auth()->id();
        if (!$usuarioId) {
            return response()->json(['ok' => false, 'msg' => 'No autenticado'], 401);
        }

        $coment = Comentario::where('usuario_id', $usuarioId)->where('video_id', $videoId)->first();

        if ($coment) {
            $coment->delete();
            return response()->json([
                'ok' => true,
                'estado' => 'quitado',
                'total' => Comentario::where('video_id', $videoId)->count()
            ]);
        }

        return response()->json(['ok' => false, 'error' => 'No hay comentario para eliminar'], 404);
    }
}
