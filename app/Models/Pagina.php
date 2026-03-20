<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pagina extends Model
{

    protected $table= 'paginas';
    public function ObtenerListado(){
        $listadousuarios = Pagina::where('is_active', 1)->get();
        return $listadousuarios;
    }

    public function BuscarId($id){
        $usuario = Pagina::find($id);
        return $usuario;
    }

    //Creamos un atributo mediante cast para el guardado y la obtención de los datos
    protected function casts(): array{
        return [
            'created_at' => 'datetime:d-m-Y',
            'is_active' => 'boolean'
        ];
    }

    protected function name(): Attribute{
        return Attribute::make(
            set:function($value){ //Mutador
                return strtolower($value);
            },
            get:function($value){ //Accesor
                return ucfirst($value);
            }
        );
}

}
