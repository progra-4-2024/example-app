<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('mi-controller', ['texto' => 'hola-mundo']);
    return redirect('/mi-primer-controller');
    return view('welcome');
});

use App\Http\Controllers\PrimerController;
//Route::get('/mi-primer-controller', [PrimerController::class, 'index']);
Route::any('/mi-primer-controller/{texto?}', [PrimerController::class, 'show'])
->where(['texto' => '[a-z0-9-]+'])
->name('mi-controller');
Route::redirect('/here', '/there');

use App\Http\Controllers\ContactoController;
Route::get('/contacto', [ContactoController::class, 'index']);
Route::post('/contacto', [ContactoController::class, 'send']);
Route::get('/contactado', [ContactoController::class, 'contacted'])->name('contactado');


use App\Models\Marca;
Route::get('/ejemplo-relaciones', function(){
    echo '<pre>';
    
    echo '############# Marca ########################################'.PHP_EOL;
    $marca = Marca::find(1);
    print_r($marca->toArray());


    echo '############# Modelos a partir de una Marca ################'.PHP_EOL;
    $modelos = $marca->modelos;
    print_r($modelos->toArray());


    echo '############# Un Modelo especifico a partir de una marca ################'.PHP_EOL;
    $corola = $marca->modelos()->where('nombre','Corolla')->first(); //get para obtener varios
    print_r($corola->toArray());


    echo '############# La marca a partir de un modelo ###############'.PHP_EOL;
    $marca2 = $modelos[0]->marca; //tambien $corola->marca   funciona
    print_r($marca2->toArray());


    echo '############# Una marca que traiga embebidos los modelos ###############'.PHP_EOL;
    $marca3 = Marca::where('id',1)->with('modelos')->first();
    print_r($marca3->toArray());


    echo '</pre>';
});
