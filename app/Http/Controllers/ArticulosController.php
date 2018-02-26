<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articulo;
use Illuminate\Support\Facades\Storage;

class ArticulosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articulos = Articulo::all();
        return response()->json([
            'status' => true,
            'data' => $articulos
            ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $articulo = new Articulo($request->all());
        $articulo->aula_id = $request->aula_id;
        $publicDisk = Storage::disk('public');
        if (isset($request->imagen) && preg_match('/data:image\/(gif|jpeg|png);base64,(.*)/i', $request->imagen, $matches)) {
            $imageType = $matches[1];
            $imageData = base64_decode($matches[2]);
            $filename = md5($imageData.time()) . '.'.$imageType;        
            $path = "articulos";  
            $path_imagen = "$path/$filename";                    
            if($publicDisk->put("$path/$filename",$imageData,'public')){
                $articulo->imagen = $path_imagen;
            }        
        }        
        if($articulo->save()){
            return response()->json([
                'status' => true,
                'data' => $articulo
                ]);
        }else{
            return response()->json([
                'status' => false,
                'data' => "El articulo no se guardo"
                ]);
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
        $articulo = Articulo::find($id);
        if($articulo){
            return response()->json([
                'status' => true,
                'data' => $articulo
                ]);
        }else{
            return response()->json([
                'status' => false,
                'data' => "El articulo no existe"
                ]);
        }
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
        $articulo = Articulo::find($id);
        $articulo->fill($request->all());
        if($articulo->save()){
            return response()->json([
                'status' => true,
                'data' => $articulo
                ]);
        }else{
            return response()->json([
                'status' => false,
                'data' => "El articulo no se actualizo"
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articulo = Articulo::find($id);
        if($articulo->delete()){
            return response()->json([
                'status' => true,
                'data' => ""
                ]);
        }else{
            return response()->json([
                'status' => false,
                'data' => "El articulo no se elimino"
                ]);
        }
    }
}
