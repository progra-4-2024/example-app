<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Mail\ContactoRecibido;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function index()
    {
        return view('mis-views.contacto');
    }
    public function send(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'email' => 'required|email:rfc,dns',
            'mensaje' => 'required',
        ]);
        
        //enviar mensaje
        Mail::send(new ContactoRecibido($request->input()));

        
        return redirect(route('contactado'), 302);

    }
    public function contacted(){
        return view('mis-views.contactado');
    }
}
