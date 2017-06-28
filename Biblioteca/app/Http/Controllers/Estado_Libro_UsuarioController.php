<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estado_Libro_Usuario;
use App\Libro;
use App\Estado;
use App\usuario;
use App\Autor;
use App\Genero;
use App\Http\Controllers\LibroApiController;

class Estado_Libro_UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prestamo = Estado_Libro_Usuario::all();
        $respuesta = array();
        $contador = 0;
        $respuestalibro = array();

       
        foreach ($prestamo as $prestamo ) {
            
            $libro = Libro::find($prestamo->libro_id);
            //$libro = LibroApiController::show($prestamo->libro_id);
            

            $autor = Autor::find($libro->autor_id);
            $genero= Genero::find($libro->genero_id);

            $respuestalibro ["id"]           = $libro->id;
            $respuestalibro ["titulo"]       = $libro->titulo;
            $respuestalibro ["anno"]         = $libro->anno;
            $respuestalibro ["autor"]        = $autor;
            $respuestalibro ["genero"]       = $genero;

            $libro = $respuestalibro;



            $estado = Estado::find($prestamo->estado_id);
            $usuario = Usuario::find($prestamo->usuario_id);

            $respuesta [$contador]["id"]                = $prestamo->id;
            $respuesta [$contador]["libro"]             = $libro;
            $respuesta [$contador]["estado"]            = $estado;
            $respuesta [$contador]["usuario"]           = $usuario;
            $respuesta [$contador]["fecha_prestamo"]    = $prestamo->fecha_prestamo;
            $respuesta [$contador]["fecha_devolucion"]  = $prestamo->fecha_devolucion;

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
          try{
            $prestamo = new Estado_Libro_Usuario([
                'libro_id'          => $request->input('libro_id'),
                'usuario_id'        => $request->input('usuario_id'),
                'estado_id'         => $request->input('estado_id'),
                'fecha_prestamo'    => $request->input('fecha_prestamo'),
                'fecha_devolucion'  => $request->input('fecha_devolucion'),
               


                ]);

            $prestamo->save();

            if (!isset($prestamo)) {

                return response()->json(['status'=>true,'Great thanks'],200);
            }


        }catch (\Exception $e){
            Log::critical("prestamo no creado {$e->getCode()}, {$e->getLine()}, {$e->getMessage()}");
            return response('Error al insertar', 500); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
            try{
            $prestamo = Estado_Libro_Usuario::find($id);
            $respuesta = array();
            $respuestalibro = array();

            $libro = Libro::find($prestamo->libro_id);

            $autor = Autor::find($libro->autor_id);
            $genero= Genero::find($libro->genero_id);

            $respuestalibro ["id"]           = $libro->id;
            $respuestalibro ["titulo"]       = $libro->titulo;
            $respuestalibro ["anno"]         = $libro->anno;
            $respuestalibro ["autor"]        = $autor;
            $respuestalibro ["genero"]       = $genero;

            $libro = $respuestalibro;

            $estado = Estado::find($prestamo->estado_id);
            $usuario = Usuario::find($prestamo->usuario_id);

            $respuesta ["id"]                = $prestamo->id;
            $respuesta ["libro"]             = $libro;
            $respuesta ["estado"]            = $estado;
            $respuesta ["usuario"]           = $usuario;
            $respuesta ["fecha_prestamo"]    = $prestamo->fecha_prestamo;
            $respuesta ["fecha_devolucion"]  = $prestamo->fecha_devolucion;

            if (!isset($prestamo)) {
                $datos = [
                    'errors' => true,
                    'msg' => 'No se encontró la pelicula con ID = ' . $id,
                ];
                $respuesta = \Response::json($datos, 404); 
            }

        }catch(\Exception $e){

            Log::critical("Prestamo no encontrado {$e->getCode()}, {$e->getLine()}, {$e->getMessage()}");
            return response('Error al buscar', 500); 
        }

        return $respuesta;
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
        
            $prestamo = Estado_Libro_Usuario::find($id); 
            $prestamo->fill($request->all());
            $prestamoRetorno = $prestamo->save();
          

            if (isset($prestamo)) {

                $prestamo = \Response::json($prestamoRetorno, 200);
            }else{
                $prestamo = \Response::json(['error' => 'No se actualizo el prestamo'] , 404);
            }


       return $prestamo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         try{
            $Prestamo = Estado_Libro_Usuario::find($id);

            if (!isset($Prestamo)) {
                return response()->json(['Prestamo no existe'],404); 
            }

            $Prestamo->delete();
            return response()->json('Prestamo Eliminado',200);

        }catch(\Exception $e){
            Log::critical("Error: {$e->getCode()}, {$e->getLine()}, {$e->getMessage()}");
            return response('Error', 500); 
        }
    }





    
}
