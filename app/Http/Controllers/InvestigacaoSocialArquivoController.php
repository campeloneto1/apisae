<?php

namespace App\Http\Controllers;

use App\Models\InvestigacaoSocialArquivo;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvestigacaoSocialArquivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->investigacoes_sociais){
            return response()->json('Não Autorizado', 401);
        }
        return InvestigacaoSocialArquivo::orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->investigacoes_sociais){
            return response()->json('Não Autorizado', 401);
        }
        $data = new InvestigacaoSocialArquivo;

        $data->investigacao_social_id = $request->investigacao_social_id;     
        $data->nome = $request->nome;   
        $data->arquivo = $request->arquivo;   
        $data->arquivo_tipo_id = $request->arquivo_tipo_id;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Arquivo na Investigacao Social';
            $log->table = 'investigacoes_sociais_arquivos';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Arquivo cadastrado com sucesso!', 200);
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
    public function show(InvestigacaoSocialArquivo $investigacoes_sociais_arquivo)
    {
        if(!Auth::user()->perfil->investigacoes_sociais){
            return response()->json('Não Autorizado', 401);
        }
        return $investigacoes_sociais_arquivo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvestigacaoSocialArquivo $investigacoes_sociais_arquivo)
    {
        if(!Auth::user()->perfil->investigacoes_sociais){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $investigacoes_sociais_arquivo;

        $investigacoes_sociais_arquivo->analise_id = $request->analise_id;     
        $investigacoes_sociais_arquivo->nome = $request->nome;  
        $investigacoes_sociais_arquivo->arquivo = $request->arquivo;   
        $investigacoes_sociais_arquivo->arquivo_tipo_id = $request->arquivo_tipo_id;   

        $investigacoes_sociais_arquivo->updated_by = Auth::id();      

        if($investigacoes_sociais_arquivo->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Arquivo na Investigação Social';
            $log->table = 'investigacoes_sociais_arquivos';
            $log->action = 2;
            $log->fk = $investigacoes_sociais_arquivo->id;
            $log->object = $investigacoes_sociais_arquivo;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Arquivo editado com sucesso!', 200);
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
    public function destroy(InvestigacaoSocialArquivo $investigacoes_sociais_arquivo)
    {
        if(!Auth::user()->perfil->investigacoes_sociais){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($investigacoes_sociais_arquivo->delete()){
            unlink(storage_path('app/public/'.$investigacoes_sociais_arquivo->arquivo));
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Arquivo na Investigação Social';
            $log->table = 'investigacoes_sociais_arquivos';
            $log->action = 3;
            $log->fk = $investigacoes_sociais_arquivo->id;
            $log->object = $investigacoes_sociais_arquivo;
            $log->save();
            return response()->json('Arquivo excluído com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
