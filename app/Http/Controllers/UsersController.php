<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UsersController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User($request->all());
        $user->password = bcrypt($request->password);
        if($user->save()){
            return response()->json([
                'status' => true,
                'data' => $user
                ]);
        }else{
            return response()->json([
                'status' => false,
                'data' => "El usuario no se guardo"
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
        $user = User::find($id);
        if($user){
            return response()->json([
                'status' => true,
                'data' => $user
                ]);
        }else{
            return response()->json([
                'status' => false,
                'data' => "El usuario no existe"
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
        //
    }

    public function login(Request $request){
         if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'status' => true,
                'data' => Auth::user()
                ]);
        }else{
            return response()->json([
                'status' => false,
                'data' => "El inicio de sesion fallo"
                ]);
        }
    }
}
