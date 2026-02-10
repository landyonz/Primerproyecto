<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PrincipalController;

Route::get('/', function () {
    return view('welcome');
})->name('vista_inicio');

Route::get('/contact',function(){
    $nombre="Alejandro Góngora Escalante";
    return view('contact',['nombre'=>$nombre,'carrera'=>'Doctor en Sistemas Computacionales']);
})->name('contact');

Route::get('/hello',HomeController::class);//index
Route::get('/post/mensaje',[PostController::class,'Mensaje']);//metodo
Route::get('/empresa',[HomeController::class,'empresa'])->name('empresa');
Route::get('/post/about/{param?}/{nombre?}', [PostController::class, 'About']);
Route::get('/contact', function() {
    $nombre = 'Landy';
    return view('contact', ['nombre' => $nombre, 'carrera' => 'Lati sistemas de info']);
})->name('contact');