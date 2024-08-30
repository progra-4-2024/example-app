<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;
class PrimerController extends Controller
{
    function index(){
        throw new \Exception("test de error");
        return view('mis-views.primer-view', [
            'texto' => 'Hola Mundo'
        ]);
    }
    function show(Request $request, $texto='nada'){
        
        $validator = Validator::make(
            $request->input(), //array con valores
            [
                'name' => array('required', 'min:5'),
                'email' => 'required|email:rfc,dns',
            ] //array con reglas
        );
        if ($validator->fails()){
            $messages = $validator->getMessageBag()->getMessages();
            $failed = $validator->failed();
        }


        Cache::put('key', 'value', 600); 
        $header = $request->header('accept-language');
        $url = route('mi-controller', ['texto' => 'hola-mundo']);
        $records = [];
        $users = [
            (object) ['id'=>1, 'name'=>'Pedro'],
            (object) ['id'=>2, 'name'=>'Pablo'],
        ];
        $request->flash();

        $contador = session('contador',0);
        $contador++;
        session(['contador'=>$contador]);
        $contadorCache = cache('contador',0);
        $contadorCache++;
        cache(['contador'=>$contadorCache]);
        
        Artisan::call('mail:send -i -n');

        return view('mis-views.primer-view', [
            'texto' => '<script>alert(document.cookie);</script>Hola Mundo = ' . $texto . ' - ' . $header . ' - ' . $url,
            'records' => $records,
            'users' => $users,
            'contador' => $contador,
            'contadorCache' => $contadorCache,
            'messages' => $messages,
        ]);
    }
}
