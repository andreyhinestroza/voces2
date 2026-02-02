<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notificacion;
use App\Models\Concurso;
use App\Models\Newsletter;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    // ============================
    // 📌 NOTIFICACIONES (tu lógica intacta)
    // ============================

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
        $n = Notificacion::find($id);

        if (!$n) {
            return response()->json([
                'ok' => false,
                'msg' => 'Notificación no encontrada'
            ], 404);
        }

        $n->estado = $n->estado === 'activo' ? 'inactivo' : 'activo';
        $n->save();

        return response()->json([
            'ok' => true,
            'msg' => 'Estado actualizado correctamente',
            'id' => $n->id,
            'descripcion' => $n->descripcion,
            'estado' => $n->estado,
            'tipo' => $n->tipo ?? 'general'
        ]);
    }

    // ============================
    // 📌 CONCURSOS (tu lógica intacta)
    // ============================

    public function listarConcursos()
    {
        return Concurso::orderBy('fecha_inicio', 'desc')->get();
    }

    public function crearConcurso(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|max:120|unique:concursos,nombre',
                'descripcion' => 'required|string',
                'inicio' => 'required|date',
                'fin' => 'required|date|after_or_equal:inicio'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'ok' => false,
                'msg' => 'Ya existe un concurso con ese nombre. Ingresa otro.'
            ], 422);
        }

        $nuevo = new Concurso();
        $nuevo->nombre = $request->nombre;
        $nuevo->descripcion = $request->descripcion;
        $nuevo->fecha_inicio = $request->inicio;
        $nuevo->fecha_fin = $request->fin;
        $nuevo->estado = 'borrador';
        $nuevo->save();

        return response()->json([
            'ok' => true,
            'msg' => 'Concurso creado correctamente',
            'id' => $nuevo->id,
            'estado' => $nuevo->estado,
            'nombre' => $nuevo->nombre
        ]);
    }



    public function toggleConcurso($id)
    {
        $c = Concurso::find($id);

        if (!$c) {
            return response()->json([
                'ok' => false,
                'msg' => 'Concurso no encontrado'
            ], 404);
        }

        $c->estado = $c->estado === 'activo' ? 'borrador' : 'activo';
        $c->save();

        return response()->json([
            'ok' => true,
            'msg' => 'Estado actualizado correctamente',
            'id' => $c->id,
            'estado' => $c->estado,
            'nombre' => $c->nombre
        ]);
    }

    public function eliminarConcurso($id)
    {
        $c = Concurso::find($id);

        if (!$c) {
            return response()->json([
                'ok' => false,
                'msg' => 'Concurso no encontrado'
            ], 404);
        }

        $c->delete();

        return response()->json([
            'ok' => true,
            'msg' => 'Concurso eliminado correctamente',
            'id' => $id
        ]);
    }

    // ============================
    // 📌 NEWSLETTER (nuevo)
    // ============================

    public function suscribirNewsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email'
        ]);

        $nuevo = new Newsletter();
        $nuevo->email = $request->email;
        $nuevo->save();

        return redirect()->back()->with('newsletter_message', '¡Te has suscrito correctamente al boletín!');
    }

    public function listarNewsletter()
    {
        return Newsletter::orderBy('created_at', 'desc')->get();
    }

    public function eliminarNewsletter($id)
    {
        $n = Newsletter::find($id);

        if (!$n) {
            return response()->json([
                'ok' => false,
                'msg' => 'Suscriptor no encontrado'
            ], 404);
        }

        $n->delete();

        return response()->json([
            'ok' => true,
            'msg' => 'Suscriptor eliminado correctamente',
            'id' => $id
        ]);
    }
}
