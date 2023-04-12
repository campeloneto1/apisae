<?php

namespace App\Http\Controllers;

use App\Models\InvestigacaoSocialLotacao;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvestigacaoSocialLotacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->investigacoes_sociais){
            return response()->json('Não Autorizado', 401);
        }
        return InvestigacaoSocialLotacao::orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->investigacoes_sociais){
            return response()->json('Não Autorizado', 401);
        }
        $data = new InvestigacaoSocialLotacao;

        $data->investigacao_social_id = $request->investigacao_social_id;   
        $data->bcg = $request->bcg;  
        $data->lotacao_tipo_id = $request->lotacao_tipo_id;   
        $data->data = $request->data;  
        $data->companhia_id = $request->companhia_id;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou uma Lotação na Investigação Social';
            $log->table = 'investigacoes_sociais_lotacoes';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Lotação cadastrada com sucesso!', 200);
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
    public function show(InvestigacaoSocialLotacao $investigacoes_sociais_lotacoe)
    {
        if(!Auth::user()->perfil->investigacoes_sociais){
            return response()->json('Não Autorizado', 401);
        }
        return $investigacoes_sociais_lotacoe;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvestigacaoSocialLotacao $investigacoes_sociais_lotacoe)
    {
        if(!Auth::user()->perfil->investigacoes_sociais){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $investigacoes_sociais_lotacoe;

        $investigacoes_sociais_lotacoe->investigacao_social_id = $request->investigacao_social_id; 
        $investigacoes_sociais_lotacoe->bcg = $request->bcg;  
        $investigacoes_sociais_lotacoe->lotacao_tipo_id = $request->lotacao_tipo_id;   
        $investigacoes_sociais_lotacoe->data = $request->data;  
        $investigacoes_sociais_lotacoe->companhia_id = $request->companhia_id;                   

        $investigacoes_sociais_lotacoe->updated_by = Auth::id();      

        if($investigacoes_sociais_lotacoe->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou uma Lotação da Investigação Social';
            $log->table = 'investigacoes_sociais_lotacoes';
            $log->action = 2;
            $log->fk = $investigacoes_sociais_lotacoe->id;
            $log->object = $investigacoes_sociais_lotacoe;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Lotação editada com sucesso!', 200);
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
    public function destroy(InvestigacaoSocialLotacao $investigacoes_sociais_lotacoe)
    {
        if(!Auth::user()->perfil->investigacoes_sociais){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($investigacoes_sociais_lotacoe->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu uma Lotação da Investigação Social';
            $log->table = 'investigacoes_sociais_lotacoes';
            $log->action = 3;
            $log->fk = $investigacoes_sociais_lotacoe->id;
            $log->object = $investigacoes_sociais_lotacoe;
            $log->save();
            return response()->json('Lotação excluída com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
