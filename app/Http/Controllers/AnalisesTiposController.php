<?php

namespace App\Http\Controllers;

use App\Models\AnaliseTipo;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnalisesTiposController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->analises){
            return response()->json('Não Autorizado', 401);
        }
        return AnaliseTipo::orderBy('nome', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->gestor){
            return response()->json('Não Autorizado', 401);
        }
        $data = new AnaliseTipo;

        $data->nome = $request->nome;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Tipo de Análise';
            $log->table = 'analises_tipos';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Tipo cadastrado com sucesso!', 200);
        }else{
             $erro = "Não foi possivel realizar o cadastro!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AnaliseTipo $analises_tipo)
    {
        if(!Auth::user()->perfil->analises){
            return response()->json('Não Autorizado', 401);
        }
        return $analises_tipo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnaliseTipo $analises_tipo)
    {
        if(!Auth::user()->perfil->gestor){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $analises_tipo;

        $analises_tipo->nome = $request->nome;   

        $analises_tipo->updated_by = Auth::id();      

        if($analises_tipo->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou  um Tipo de Análise';
            $log->table = 'analises_tipos';
            $log->action = 2;
            $log->fk = $analises_tipo->id;
            $log->object = $analises_tipo;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Tipo editado com sucesso!', 200);
        }else{
           $erro = "Não foi possivel realizar a edição!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnaliseTipo $analises_tipo)
    {
        if(!Auth::user()->perfil->gestor){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($analises_tipo->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Tipo de Análise';
            $log->table = 'analises_tipos';
            $log->action = 3;
            $log->fk = $analises_tipo->id;
            $log->object = $analises_tipo;
            $log->save();
            return response()->json('Tipo excluído com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
