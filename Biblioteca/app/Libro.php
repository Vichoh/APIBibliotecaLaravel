<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    
    protected $table = 'libros';

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = [

    	'titulo', 'anno', 'autor_id', 'genero_id'

    ];

    public function genero(){

    	return $this->belongsTo('App\Genero');
    }


    public function autor(){

    	return $this->belongsTo('App\Autor');
    }

    public function estados(){


        return $this->belongsToMany('App\Estado', 'libros_usuarios_estados')
            ->withPivot('usuario_id', 'fecha_prestamo', 'fecha_devolucion');
    }


    public function usuarios(){

        return $this->belongsToMany('App\Usuario', 'libros_usuarios_estados')
            ->withPivot('estado_id', 'fecha_prestamo', 'fecha_devolucion');
    }

}
