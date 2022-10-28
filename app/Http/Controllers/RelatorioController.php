<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Relatorios;
use App\Models\Escolas;
use App\Models\Municipios;
use App\Models\User;
use App\Models\Anexos;
class RelatorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $relatorios = Relatorios::all();
        return view('relatorios.index', compact('relatorios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $escolas = Escolas::orderBy('municipio', 'ASC')->orderBy('escola', 'ASC')->get();
        $municipios = Municipios::orderBy('municipio', 'ASC')->get();
        return view('relatorios.novoRelatorio', compact('escolas', 'municipios'));
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = auth()->user()->id;
        $escolas = Escolas::whereIn('cod_escola', $request->escolas)->get('escola');
        $sigeam = Escolas::whereIn('cod_escola', $request->escolas)->get('cod_escola');
        $create = Relatorios::create([
            'id_user' => $request->id_user,
            'tipo_demanda' => $request->tipo_demanda,
            'objetivo' => $request->objetivo,
            'relatorio' => $request->relatorio,
            'observacao' => $request->observacao,
            'ida' => $request->ida,
            'volta' => $request->volta,
            'sigeam' => $sigeam,
            'escola' => $escolas,
            'municipio' => $request->municipio,
        ]);

        $id_relatorio = $create->id;
        $nome_embarque = auth()->user()->name.'_'.$id_relatorio;
        $embarque_tamanho = $request->file('embarque')->getSize();
        $embarque_arq = $request->file('embarque')->storeAs('public/anexos/embarques/', $nome_embarque);
        $embarque = Anexos::create([
            'id_relatorio' => $id_relatorio,
            'nome' => $nome_embarque,
            'tamanho' => $embarque_tamanho

        ]);

        return \redirect('relatorios');
        
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
}
