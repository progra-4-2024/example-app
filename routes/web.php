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


