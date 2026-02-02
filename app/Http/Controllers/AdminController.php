<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notificacion;

class AdminController extends Controller
{

    public function eliminarNotificacion($id)
    {
        $n = Notificacion::find($id);

        if (!$n) {
            return response()->json([
                'ok' => false,
                'msg' => 'Notificación no encontrada'
            ], 404);
        }

        $n->delete();

        return response()->json([
            'ok' => true,
            'msg' => 'Notificación eliminada correctamente',
            'id' => $id
        ]);
    }


    public function listarNotificaciones()
    {
        return Notificacion::orderBy('created_at', 'desc')->get();
    }

    public function crearNotificacion(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255'
        ]);

        $nueva = new Notificacion();
        $nueva->descripcion = $request->descripcion;
        $nueva->estado = 'activo';
        $nueva->save();

        return response()->json(['ok' => true]);
    }

    public function toggleEstado($id)
    {
        // Buscar la notificación por ID
        $n = Notificacion::find($id);

        // Validar existencia
        if (!$n) {
            return response()->json([
                'ok' => false,
                'msg' => 'Notificación no encontrada'
            ], 404);
        }

        // Cambiar estado
        $n->estado = $n->estado === 'activo' ? 'inactivo' : 'activo';
        $n->save();

        // Respuesta con datos útiles para el frontend
        return response()->json([
            'ok' => true,
            'msg' => 'Estado actualizado correctamente',
            'id' => $n->id,
            'descripcion' => $n->descripcion,
            'estado' => $n->estado,
            'tipo' => $n->tipo ?? 'general' // si existe el campo tipo
        ]);
    }

}
