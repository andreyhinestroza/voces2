<?php 

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ParticipanteController extends Controller
{
    public function index()
    {
        // Vista con confirmación para convertirse en participante
        return view('participante.index');
    }

    public function store()
    {
        $user = Auth::user();
        $user->rol = 'participante';
        $user->save();

        return redirect()->route('video.create')
                         ->with('success', 'Ahora eres participante y puedes subir videos.');
    }
}
