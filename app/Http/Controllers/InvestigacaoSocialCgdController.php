<?php

namespace App\Http\Controllers;

use App\Models\InvestigacaoSocialCgd;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class InvestigacaoSocialCgdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         if(!Auth::user()->perfil->investigacoes_sociais){
            return response()->json('Não Autorizado', 401);
        }
        return InvestigacaoSocialCgd::orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->investigacoes_sociais){
            return response()->json('Não Autorizado', 401);
        }
        $data = new InvestigacaoSocialCgd;

        $data->investigacao_social_id = $request->investigacao_social_id;   
        $data->cgd_envolvimento_tipo_id = $request->cgd_envolvimento_tipo_id;  
        $data->cgd_processo_tipo_id = $request->cgd_processo_tipo_id;   
        $data->cgd_situacao_tipo_id = $request->cgd_situacao_tipo_id;  
        $data->spu = $request->spu;   
        $data->descricao = $request->descricao;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou uma CGD na Investigação Social';
            $log->table = 'investigacoes_sociais_cgds';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('CGD cadastrada com sucesso!', 200);
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
    public function show(InvestigacaoSocialCgd $investigacoes_sociais_cgd)
    {
        if(!Auth::user()->perfil->investigacoes_sociais){
            return response()->json('Não Autorizado', 401);
        }
        return $investigacoes_sociais_lotacoe;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvestigacaoSocialCgd $investigacoes_sociais_cgd)
    {
        if(!Auth::user()->perfil->investigacoes_sociais){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $investigacoes_sociais_cgd;

        $investigacoes_sociais_cgd->investigacao_social_id = $request->investigacao_social_id;   
        $investigacoes_sociais_cgd->cgd_envolvimento_tipo_id = $request->cgd_envolvimento_tipo_id;  
        $investigacoes_sociais_cgd->cgd_processo_tipo_id = $request->cgd_processo_tipo_id;   
        $investigacoes_sociais_cgd->cgd_situacao_tipo_id = $request->cgd_situacao_tipo_id;  
        $investigacoes_sociais_cgd->spu = $request->spu;   
        $investigacoes_sociais_cgd->descricao = $request->descricao;                    

        $investigacoes_sociais_cgd->updated_by = Auth::id();      

        if($investigacoes_sociais_cgd->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou uma CGD da Investigação Social';
            $log->table = 'investigacoes_sociais_cgds';
            $log->action = 2;
            $log->fk = $investigacoes_sociais_cgd->id;
            $log->object = $investigacoes_sociais_cgd;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('CGD editada com sucesso!', 200);
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
    public function destroy(InvestigacaoSocialCgd $investigacoes_sociais_cgd)
    {
        if(!Auth::user()->perfil->investigacoes_sociais){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($investigacoes_sociais_cgd->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu uma CGD da Investigação Social';
            $log->table = 'investigacoes_sociais_cgds';
            $log->action = 3;
            $log->fk = $investigacoes_sociais_cgd->id;
            $log->object = $investigacoes_sociais_cgd;
            $log->save();
            return response()->json('CGD excluída com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
