<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::orderBy('name', 'ASC')->get();
        return view ('usuarios.index', compact('usuarios'));
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
        $create = User::create(
            [
                'name' => $request->name,
                'matricula' => $request->matricula,
                'password' => bcrypt($request->password),
                'cpf' => $request->cpf,
                'funcao' => $request->funcao,
                'email' => $request->email,
            ]
        );

        if($create){
            return back()->with('sucesso', 'Usuário criado com sucesso!');
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
        //
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
        $update = User::where('id', '=', $id)->update(
            [
                'name' => $request->name,
                'matricula' => $request->matricula,
                'password' => bcrypt($request->password),
                'cpf' => $request->cpf,
                'funcao' => $request->funcao,
                'email' => $request->email,
            ]
        );

        if($update){
            return back()->with('sucesso', 'Usuário editado com sucesso!');
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
        //
    }
}
