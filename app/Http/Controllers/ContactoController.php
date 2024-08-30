<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
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
        
        return redirect(route('contactado'), 302);

    }
    public function contacted(){
        return view('mis-views.contactado');
    }
}
