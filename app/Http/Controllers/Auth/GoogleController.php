<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GoogleController extends Controller
{
    /**
     * Redirige al usuario a Google
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Recibe la respuesta de Google y registra/actualiza al usuario
     */
    public function callback()
        {
            try {
                // Paso 1: obtener datos de Google
                $googleUser = Socialite::driver('google')->stateless()->user();
                \Log::info('Datos de Google: '.json_encode($googleUser));

                // Paso 2: crear/actualizar usuario en BD usando google_id como clave
                $user = User::where('google_id', $googleUser->id)->first();
                    if (!$user) {
                        $user = User::create([
                            'google_id' => $googleUser->id,
                            'nombre' => $googleUser->name,
                            'correo' => $googleUser->email,
                            'foto' => $googleUser->avatar,
                            'rol' => 'espectador', // solo al crear
                        ]);
                    } else {
                        $user->update([
                            'nombre' => $googleUser->name,
                            'correo' => $googleUser->email,
                            'foto' => $googleUser->avatar,
                            // 👈 no tocar el rol
                        ]);
                    }


                \Log::info('Usuario en BD: '.json_encode($user));

                // Paso 3: iniciar sesión
                Auth::login($user, true);
                \Log::info('Usuario autenticado: '.json_encode(Auth::user()));


                // Paso 4: redirigir
                return redirect()->intended('/');

            } catch (\Exception $e) {
                \Log::error('Error en login con Google: '.$e->getMessage());
                return redirect('/')->with('error', 'Error al iniciar sesión con Google');
            }
        }




    /**
     * Cierra sesión
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
