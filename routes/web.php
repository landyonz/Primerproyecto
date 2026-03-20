<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PrincipalController;
use App\Models\Pagina;

Route::get('/', function () {
    return view('welcome');
})->name('vista_inicio');

Route::get('/contact',function(){
    $nombre="Landy Marisol Ortiz Núñez";
    return view('contact',['nombre'=>$nombre,'carrera'=>'LATI']);
})->name('contact');

Route::get('/principal', function(){
    $datos=["titulo"=>"Tienda Virtual - Vista Principal","mensaje"=>"Bienvenido a la vista principal"];
    return view('principal',$datos);
})->name('principal');

Route::get('/empresa',[HomeController::class,'empresa'])->name('empresa');

//Definimos el método a utilizar
Route::get('nuevoregistro', function(){
    $pagina=new Pagina;
    $pagina->name='Landy';
    $pagina->email='landy@gmail.com';
    $pagina->email_verified_at=date('Y-m-d');
    $pagina->password='123456';
    $pagina->avatar='user.png';
    $pagina->telefono='123456';
    $pagina->calle='111';
    $pagina->save();
    return $pagina;
});

//Definimos el método para buscar por el id
// Para obtener unicamente un registro
Route::get('buscarpaginaid',function(){
    $post=Pagina::find(3);
    return $post;
});

//Definimos el método para buscar por un campo determinado
Route::get('buscarxname',function(){
    $post=Pagina::where('name','Landy')->first();
    return $post;
});

//Para recuperar más de un registro
Route::get('obtenertodos', function(){
    $post = Pagina::all();
    return $post;
});

//Definimos el método para cambiar un registro
Route::get('updatename', function(){
    $post = Pagina::where('name','Landy')->first();
    $post->email = 'landy@gmail.com';
    $post->save();
    return $post;
});

//Definimos un método para obtener una lista conforme a un criterio determinado
// Para obtener más de un registro
Route::get('filter', function(){
    //$post=Pagina::where('calle','like','%123%')->get();
    $post=Pagina::where('calle','like','%123%')->orderBy('id','desc')->get();
    return $post;
});

// Para especificar unicamente los campos que quiera
Route::get('trescampos', function(){
    $post = Pagina::select('name','email','telefono')->get();
    return $post;
});

// Conforme a una selección solamente traerme un cierto número de registros
Route::get('filtroxnumreg', function(){
    $post = Pagina::select('name','email')->orderBy('name')->take(2)->get();
    return $post;
});

//Para eliminar un determinado registro
Route::get('eliminar_registro', function(){
    $post = Pagina::find(5);
    $post->delete();
    return "Registro eliminado";
});

//Obtener la fecha conforme a un formato
Route::get('obtenerfechaformato', function(){
    $post = Pagina::select('name','email','created_at')->find(3);
    //return $post->created_at->format('d-m-Y');
    //return $post->created_at->format('d/m/Y');
    return $post;
});

//Obtener el valor de is active
Route::get('Obtenerestatus', function(){
    $post = Pagina::find(1);
    //return $post->created_at->format('d-m-Y');
    //return $post->is_active;
    //dd función de depuración que muestra el contenido de una variable
    dd($post->is_active);
});

Route::put('/actualizar-dato/{id}',[HomeController::class,'update'])->name('actualizar.dato');
Route::put('/eliminar-logico/{id}', [HomeController::class, 'eliminarLogico']);
Route::delete('/eliminar-fisico/{id}', [HomeController::class, 'eliminarFisico']);