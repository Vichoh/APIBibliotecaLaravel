<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    
	protected $table = 'generos';

	public $timestamps = false;

	protected $primaryKey = 'id';

	protected $fillable = [

		'descripcion'

	]; 


	public function libros(){

		return $this->hasMany('App\Libro');
	}

}
