<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado_Libro_Usuario extends Model
{
    
    protected $table = 'libros_usuarios_estados';

    public $timestamps = false;

    protected $primarykey = 'id';

    protected $fillable = [

    	'libro_id', 'usuario_id', 'estado_id', 'fecha_prestamo', 'fecha_devolucion'

    ];
}
