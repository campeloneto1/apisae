<?php

namespace App\Http\Controllers;

use App\Models\InvestigacaoSocialStatus;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvestigacaoSocialStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         if(!Auth::user()->perfil->investigacoes_sociais){
            return response()->json('Não Autorizado', 401);
        }
        return InvestigacaoSocialStatus::orderBy('nome', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $data = new InvestigacaoSocialStatus;

        $data->nome = $request->nome;   
        $data->andamento = $request->andamento;  
        $data->concluido = $request->concluido;   
        $data->encaminhado = $request->encaminhado;  
        $data->aprovado = $request->aprovado; 
        $data->recusado = $request->recusado;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Status de Investigação Social';
            $log->table = 'investigacoes_sociais_status';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Status cadastrada com sucesso!', 200);
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
    public function show(InvestigacaoSocialStatus $investigacaoSocialStatus)
    {
         if(!Auth::user()->perfil->investigacoes_sociais){
            return response()->json('Não Autorizado', 401);
        }
        return $investigacoes_sociais_lotacoe;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvestigacaoSocialStatus $investigacoes_sociais_statu)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $investigacoes_sociais_statu;

        $investigacoes_sociais_statu->nome = $request->nome;   
        $investigacoes_sociais_statu->andamento = $request->andamento;  
        $investigacoes_sociais_statu->concluido = $request->concluido;   
        $investigacoes_sociais_statu->encaminhado = $request->encaminhado;  
        $investigacoes_sociais_statu->aprovado = $request->aprovado; 
        $investigacoes_sociais_statu->recusado = $request->recusado;
       
        $investigacoes_sociais_statu->updated_by = Auth::id();      

        if($investigacoes_sociais_statu->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou uma Status de Investigação Social';
            $log->table = 'investigacoes_sociais_status';
            $log->action = 2;
            $log->fk = $investigacoes_sociais_statu->id;
            $log->object = $investigacoes_sociais_statu;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Status editada com sucesso!', 200);
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
    public function destroy(InvestigacaoSocialStatus $investigacoes_sociais_statu)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($investigacoes_sociais_statu->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu uma Status de Investigação Social';
            $log->table = 'investigacoes_sociais_status';
            $log->action = 3;
            $log->fk = $investigacoes_sociais_lotacoe->id;
            $log->object = $investigacoes_sociais_lotacoe;
            $log->save();
            return response()->json('Status excluído com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
