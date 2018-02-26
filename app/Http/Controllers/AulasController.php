<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aula;

class AulasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aulas = Aula::all();
        return response()->json([
            'status' => true,
            'data' => $aulas
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
        $aula = new Aula($request->all());
        if($aula->save()){
            return response()->json([
                'status' => true,
                'data' => $aula
                ]);
        }else{
            return response()->json([
                'status' => false,
                'data' => "El aula no se guardo"
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
        $aula = Aula::find($id);
        if($aula){
            return response()->json([
                'status' => true,
                'data' => $aula
                ]);
        }else{
            return response()->json([
                'status' => false,
                'data' => "El aula no existe"
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
        $aula = Aula::find($id);
        $aula->fill($request->all());
        if($aula->save()){
            return response()->json([
                'status' => true,
                'data' => $aula
                ]);
        }else{
            return response()->json([
                'status' => false,
                'data' => "El aula no se actualizo"
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
        $aula = Aula::find($id);
        if($aula->delete()){
            return response()->json([
                'status' => true,
                'data' => ""
                ]);
        }else{
            return response()->json([
                'status' => false,
                'data' => "El aula no se elimino"
                ]);
        }
    }

    public function articulos($aula){
        $aula = Aula::find($aula);
        if($aula->articulos){
            return response()->json([
                'status' => true,
                'data' => $aula->articulos
                ]);
        }else{
            return response()->json([
                'status' => false,
                'data' => "El aula no tiene articulos"
                ]);
        }
    }
}
