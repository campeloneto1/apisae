<?php

namespace App\Http\Controllers;

use App\Models\SituacaoFuncional;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SituacaoFuncionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return SituacaoFuncional::orderBy('nome', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $data = new SituacaoFuncional;

        $data->nome = $request->nome;
        
        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou uma Situação Funcional';
            $log->table = 'situacoes_funcionais';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Situação Funcional cadastrada com sucesso!', 200);
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
    public function show(SituacaoFuncional $situacoes_funcionai)
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return $situacoes_funcionai;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SituacaoFuncional $situacoes_funcionai)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $situacoes_funcionai;

        $situacoes_funcionai->nome = $request->nome;   

        $situacoes_funcionai->updated_by = Auth::id();      

        if($situacoes_funcionai->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou uma Situação Funcional';
            $log->table = 'situacoes_funcionais';
            $log->action = 2;
            $log->fk = $situacoes_funcionai->id;
            $log->object = $situacoes_funcionai;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Situação Funcional editada com sucesso!', 200);
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
    public function destroy(SituacaoFuncional $situacoes_funcionai)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($situacoes_funcionai->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu uma Situação Funcional';
            $log->table = 'situacoes_funcionais';
            $log->action = 3;
            $log->fk = $situacoes_funcionai->id;
            $log->object = $situacoes_funcionai;
            $log->save();
            return response()->json('Situação Funcional excluída com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
