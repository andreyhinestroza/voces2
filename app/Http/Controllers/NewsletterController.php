<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsletterSubscriber;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $email = strtolower(trim($data['email']));

        $subscriber = NewsletterSubscriber::where('email', $email)->first();
        if ($subscriber) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Ya estás suscrito con ese correo.'], 200);
            }
            return back()->with('newsletter_message', 'Ya estás suscrito con ese correo.');
        }

        NewsletterSubscriber::create(['email' => $email]);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Gracias por suscribirte. Pronto recibirás noticias.'], 201);
        }

        return back()->with('newsletter_message', 'Gracias por suscribirte. Pronto recibirás noticias.');
    }
}
