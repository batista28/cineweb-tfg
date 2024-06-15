<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function showContactForm()
    {
        return view('contacto');
    }

    public function submitContactForm(Request $request)
    {
        // Validación de los campos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mensaje' => 'required|string',
        ]);

        // Aquí puedes manejar el envío del mensaje, por ejemplo, enviar un correo electrónico
        // o almacenarlo en una base de datos, dependiendo de tus necesidades

        return redirect()->back()->with('success', '¡Mensaje enviado correctamente!');
    }
}
