<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libro;
use App\Genero;
use App\Autor;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class LibroApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $libros = Libro::all();

        $respuesta = array();
        $contador = 0;

       
        foreach ($libros as $libros ) {
            
            
            $autor = Autor::find($libros->autor_id);
            $genero = Genero::find($libros->genero_id);

            $respuesta [$contador]["id"]           = $libros->id;
            $respuesta [$contador]["titulo"]       = $libros->titulo;
            $respuesta [$contador]["anno"]         = $libros->anno;
            $respuesta [$contador]["autor"]        = $autor;
            $respuesta [$contador]["genero"]       = $genero;

            $contador++;

        }

        

        return response()->json($respuesta, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function show($id)
    {
         try{
            $libro = Libro::find($id);
            $respuesta = array();

            $autor = Autor::find($libro->autor_id);
            $genero= Genero::find($libro->genero_id);

            $respuesta ["id"]           = $libro->id;
            $respuesta ["titulo"]       = $libro->titulo;
            $respuesta ["anno"]         = $libro->anno;
            $respuesta ["autor"]        = $autor;
            $respuesta ["genero"]       = $genero;
            

            if (!isset($libro)) {
                $datos = [
                    'errors' => true,
                    'msg' => 'No se encontró la libro con ID = ' . $id,
                ];
                $respuesta = \Response::json($datos, 404); 
            }

        }catch(\Exception $e){

            Log::critical("Libro no encontrado {$e->getCode()}, {$e->getLine()}, {$e->getMessage()}");
            return response('Error al buscar', 500); 
        }

        return response()->json($respuesta, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
    *Busca el libro por su titulo

    *@param string ttitulo
    */

    public function buscarTitulo($titulo)
    {
         
            $libro = DB::table('libros')->where('titulo', $titulo)->get();
            $result = json_decode($libro, true);
            $respuesta = array();

            $autor = Autor::find($result [0]["autor_id"]);
            $genero= Genero::find($result [0] ["genero_id"]);

            $respuesta ["id"]           = $result [0] ["id"];
            $respuesta ["titulo"]       = $result [0]["titulo"];
            $respuesta ["anno"]         = $result [0] ["anno"];
            $respuesta ["autor"]        = $autor;
            $respuesta ["genero"]       = $genero;
            

            if (!isset($libro)) {
                $datos = [
                    'errors' => true,
                    'msg' => 'No se encontró la libro con ese titulo = ' . $titulo,
                ];
                $respuesta = \Response::json($datos, 404); 
            }

        
        

        return $respuesta;
    }




}
