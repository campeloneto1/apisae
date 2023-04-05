<?php

namespace App\Http\Controllers;

use App\Models\SituacaoTipo;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SituacaoTipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return SituacaoTipo::orderBy('nome', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $data = new SituacaoTipo;

        $data->nome = $request->nome;
        
        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Tipo de Situação';
            $log->table = 'situacoes_tipos';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Tipo de Situação cadastrado com sucesso!', 200);
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
    public function show(SituacaoTipo $situacoes_tipo)
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return $situacoes_tipo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SituacaoTipo $situacoes_tipo)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $situacoes_tipo;

        $situacoes_tipo->nome = $request->nome;   

        $situacoes_tipo->updated_by = Auth::id();      

        if($situacoes_tipo->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Tipo de Situação';
            $log->table = 'situacoes_tipos';
            $log->action = 2;
            $log->fk = $situacoes_tipo->id;
            $log->object = $situacoes_tipo;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Tipo de Situação editado com sucesso!', 200);
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
    public function destroy(SituacaoTipo $situacoes_tipo)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($situacoes_tipo->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Tipo de Situação';
            $log->table = 'situacoes_tipos';
            $log->action = 3;
            $log->fk = $situacoes_tipo->id;
            $log->object = $situacoes_tipo;
            $log->save();
            return response()->json('Tipo de Situação excluído com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
