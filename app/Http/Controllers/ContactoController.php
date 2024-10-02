<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Mail\ContactoRecibido;
use Illuminate\Support\Facades\Mail;
use App\Models\Contact;
use Illuminate\Support\Facades\DB; //en los imports

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
        try {
            DB::beginTransaction();
            // Queries de Eloquent
            
            
            
            $input = $request->input();
            $input['publicidad'] = isset($input['publicidad']);
            Contact::create($input);

            
            Mail::send(new ContactoRecibido($request->input()));
            //throw new \Exception("Error de email");
            
            
            DB::commit();
            return redirect(route('contactado'), 302);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            // Manejar la excepción según sea necesario.
        }
        

    }
    public function contacted(){
        return view('mis-views.contactado');
    }
}
