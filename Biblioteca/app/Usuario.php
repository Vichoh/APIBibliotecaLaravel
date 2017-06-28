<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = [

    	'nombre', 'apellido', 'rut', 'telefono'
    ];


    public function libros(){

    	return $this->belongsToMany('\App\Libro', 'libros_usuarios_estados')
    		->withPivot('estado_id', 'fecha_prestamo', 'fecha_devolucion');
    }

    public function estados(){

    	return $this->belongsToMany('\App\Estado', 'libros_usuarios_estados')
    		->withPivot('libro_id', 'fecha_prestamo', 'fecha_devolucion' );
    }
}
