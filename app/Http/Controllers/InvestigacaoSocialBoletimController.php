<?php

namespace App\Http\Controllers;

use App\Models\InvestigacaoSocialBoletim;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class InvestigacaoSocialBoletimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         if(!Auth::user()->perfil->investigacoes_sociais){
            return response()->json('Não Autorizado', 401);
        }
        return InvestigacaoSocialBoletim::orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->investigacoes_sociais){
            return response()->json('Não Autorizado', 401);
        }
        $data = new InvestigacaoSocialBoletim;

        $data->investigacao_social_id = $request->investigacao_social_id;   
        $data->bcg = $request->bcg;  
        $data->descricao = $request->descricao;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Boletim na Investigação Social';
            $log->table = 'investigacoes_sociais_boletins';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Boletim cadastrada com sucesso!', 200);
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
    public function show(InvestigacaoSocialBoletim $investigacoes_sociais_boletin)
    {
        if(!Auth::user()->perfil->investigacoes_sociais){
            return response()->json('Não Autorizado', 401);
        }
        return $investigacoes_sociais_boletin;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvestigacaoSocialBoletim $investigacoes_sociais_boletin)
    {
        if(!Auth::user()->perfil->investigacoes_sociais){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $investigacoes_sociais_boletin;

        
         $investigacoes_sociais_boletin->investigacao_social_id = $request->investigacao_social_id;   
        $investigacoes_sociais_boletin->bcg = $request->bcg;  
        $investigacoes_sociais_boletin->descricao = $request->descricao;   
        

        $investigacoes_sociais_boletin->updated_by = Auth::id();      

        if($investigacoes_sociais_boletin->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Boletim da Investigação Social';
            $log->table = 'investigacoes_sociais_boletins';
            $log->action = 2;
            $log->fk = $investigacoes_sociais_boletin->id;
            $log->object = $investigacoes_sociais_boletin;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Boletim editada com sucesso!', 200);
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
    public function destroy(InvestigacaoSocialBoletim $investigacoes_sociais_boletin)
    {
        if(!Auth::user()->perfil->investigacoes_sociais){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($investigacoes_sociais_boletin->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Boletim da Investigação Social';
            $log->table = 'investigacoes_sociais_boletins';
            $log->action = 3;
            $log->fk = $investigacoes_sociais_boletin->id;
            $log->object = $investigacoes_sociais_boletin;
            $log->save();
            return response()->json('Boletim excluída com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
