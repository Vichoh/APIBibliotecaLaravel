<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';

    public $timestamps = false;

    protected $primarykey = 'id';

    protected $fillable = [

    	'descripcion'
    ];


    public function libros(){

    	return $this->belongsToMany('App\Libro', 'libros_usuarios_estados')
    		->withPivot('usuario_id', 'fecha_prestamo', 'fecha_devolucion');
    }




    public function usuarios(){

    	return $this->belongsToMany('App\usuario', 'libros_usuarios_estados')
    		->withPivot('estado_id', 'fecha_prestamo', 'fecha_devolucion');
    }
}
