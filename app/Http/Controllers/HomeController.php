<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function empresa(){
        $datos["nombre"]="Landy Marisol Ortiz Núñez";
        $datos["fecha"]="2026-02-03";
        $datos["actividad"]="Desarrollo de Software";
        $datos["descripcion_about"]="Empresa dedicada al desarrollo de sofware a la medida de sus clientes";
        $datos["texto_ejemplo"]="Aquí va la descripción del ejemplo";

        $usuarios=new Pagina();
        $datos["listadousuarios"]=$usuarios->ObtenerListado();
        return view('empresa',$datos);
    }

    public function __invoke(){
        return view('hello');
    }

    public function update (Request $request){
        $usuarios=new Pagina();
        $respuesta=$usuarios->BuscarId($request->id);
        if(!empty($respuesta)){
            $respuesta->name=$request->name;
            $respuesta->calle=$request->calle;
            $respuesta->save();
        }
        return $respuesta;
    }

    public function eliminarLogico($id){
        $usuario = Pagina::find($id);
        if($usuario){
            $usuario->is_active = 0;
            $usuario->save();
            return response()->json(['mensaje' => 'Eliminación lógica exitosa']);
        }
        return response()->json(['error' => 'Registro no encontrado'], 404);
    }

    public function eliminarFisico($id){
        $usuario = Pagina::find($id);
        if($usuario){
            $usuario->delete();
            return response()->json(['mensaje' => 'Eliminación física exitosa']);
        }
        return response()->json(['error' => 'Registro no encontrado'], 404);
    }
    
}
