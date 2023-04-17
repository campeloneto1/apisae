<?php

namespace App\Http\Controllers;

use App\Models\InvestigacaoSocial;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvestigacaoSocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->investigacoes_sociais){
            return response()->json('Não Autorizado', 401);
        }
        return InvestigacaoSocial::orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $data = new InvestigacaoSocial;

        $data->pessoa_id = $request->pessoa_id;   
        $data->nome_guerra = $request->nome_guerra;  
        $data->matricula = $request->matricula;   
        $data->numeral = $request->numeral;   
        $data->data_ingresso = $request->data_ingresso;   
        $data->graduacao_id = $request->graduacao_id;   
        $data->companhia_id = $request->companhia_id;   
        $data->situacao_funcional_id = $request->situacao_funcional_id;   
        $data->situacao_tipo_id = $request->situacao_tipo_id;   
        $data->comportamento_id = $request->comportamento_id;   

        $data->sip = $request->sip;   
        $data->sinesp = $request->sinesp;   
        $data->tjce = $request->tjce;   
        $data->fontes_abertas = $request->fontes_abertas; 
        $data->informacoes_adicionais = $request->informacoes_adicionais;  

        $data->indicou_id = $request->indicou_id;   

        $data->investigacao_social_status_id = 1;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou uma Investigação Social';
            $log->table = 'investigacoes_sociais';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('IS cadastrada com sucesso!', 200);
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
    public function show(InvestigacaoSocial $investigacoes_sociai)
    {
         if(!Auth::user()->perfil->investigacoes_sociais){
            return response()->json('Não Autorizado', 401);
        }
        //return $investigacoes_sociai;
        return InvestigacaoSocial::with('boletins','lotacoes', 'cgds', 'arquivos')->findOrFail($investigacoes_sociai->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvestigacaoSocial $investigacoes_sociai)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $investigacoes_sociai;

        $investigacoes_sociai->pessoa_id = $request->pessoa_id;   
        $investigacoes_sociai->nome_guerra = $request->nome_guerra;   
        $investigacoes_sociai->matricula = $request->matricula;   
        $investigacoes_sociai->numeral = $request->numeral;   
        $investigacoes_sociai->data_ingresso = $request->data_ingresso;   
        $investigacoes_sociai->graduacao_id = $request->graduacao_id;   
        $investigacoes_sociai->companhia_id = $request->companhia_id;   
        $investigacoes_sociai->situacao_funcional_id = $request->situacao_funcional_id;   
        $investigacoes_sociai->situacao_tipo_id = $request->situacao_tipo_id;   
        $investigacoes_sociai->comportamento_id = $request->comportamento_id;   

        $investigacoes_sociai->sip = $request->sip;   
        $investigacoes_sociai->sinesp = $request->sinesp;   
        $investigacoes_sociai->tjce = $request->tjce;   
        $investigacoes_sociai->fontes_abertas = $request->fontes_abertas; 
        $investigacoes_sociai->informacoes_adicionais = $request->informacoes_adicionais;

        $investigacoes_sociai->indicou_id = $request->indicou_id;

        $investigacoes_sociai->updated_by = Auth::id();      

        if($investigacoes_sociai->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou uma Investigação Social';
            $log->table = 'investigacoes_sociais';
            $log->action = 2;
            $log->fk = $investigacoes_sociai->id;
            $log->object = $investigacoes_sociai;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('IS editada com sucesso!', 200);
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
    public function destroy( InvestigacaoSocial $investigacoes_sociai)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($investigacoes_sociai->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu uma Investigação Social';
            $log->table = 'investigacoes_sociais';
            $log->action = 3;
            $log->fk = $investigacoes_sociai->id;
            $log->object = $investigacoes_sociai;
            $log->save();
            return response()->json('IS excluída com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }

     /**
     * Change status.
     */
    public function change_status(Request $request)
    {
        if(!Auth::user()->perfil->investigacoes_sociais){
            return response()->json('Não Autorizado', 401);
        }

        $investigacao = InvestigacaoSocial::find($request->investigacao_social_id);

        if($request->investigacao_social_status_id){
            $investigacao->investigacao_social_status_id = $request->investigacao_social_status_id;
        }
        if($request->encaminhou_id){
            $investigacao->encaminhou_id = $request->encaminhou_id;
        } 

        if($request->bcg_transferencia){
            $investigacao->bcg_transferencia = $request->bcg_transferencia;
        }     
        if($investigacao->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Alterou o Status da Investigação Social';
            $log->table = 'investigacoes_sociais';
            $log->action = 3;
            $log->fk = $investigacao->id;
            $log->object = $investigacao;
            $log->save();
            return response()->json('Status alterado com sucesso!', 200);
        }else{
            $erro = "Não foi possivel realizar a alteração!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
          return response()->json($resposta, 404);
          }
    }
}
