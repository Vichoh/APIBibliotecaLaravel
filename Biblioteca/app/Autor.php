<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $table = 'autores';

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = [

    	'nombre', 'apellido'

    ];


    public function libros(){

    	return $this->hasMany('App\Libro');
    }
 }
