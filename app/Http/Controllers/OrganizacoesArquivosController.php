<?php

namespace App\Http\Controllers;

use App\Models\OrganizacaoArquivo;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrganizacoesArquivosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->organizacoes){
            return response()->json('Não Autorizado', 401);
        }
        return OrganizacaoArquivo::orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->organizacoes){
            return response()->json('Não Autorizado', 401);
        }
        $data = new OrganizacaoArquivo;

        $data->organizacao_id = $request->organizacao_id;     
        $data->nome = $request->nome;   
        $data->arquivo_tipo_id = $request->arquivo_tipo_id;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Arquivo na Organização';
            $log->table = 'organizacoes_arquivos';
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
    public function show(OrganizacaoArquivo $organizacoes_arquivo)
    {
        if(!Auth::user()->perfil->organizacoes){
            return response()->json('Não Autorizado', 401);
        }
        return $organizacoes_arquivo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrganizacaoArquivo $organizacoes_arquivo)
    {
        if(!Auth::user()->perfil->organizacoes){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $organizacoes_arquivo;

        $organizacoes_arquivo->analise_id = $request->analise_id;     
        $organizacoes_arquivo->nome = $request->nome;   
        $organizacoes_arquivo->arquivo_tipo_id = $request->arquivo_tipo_id;   

        $organizacoes_arquivo->updated_by = Auth::id();      

        if($organizacoes_arquivo->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Arquivo na Organização';
            $log->table = 'organizacoes_arquivos';
            $log->action = 2;
            $log->fk = $organizacoes_arquivo->id;
            $log->object = $organizacoes_arquivo;
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
    public function destroy(OrganizacaoArquivo $organizacoes_arquivo)
    {
        if(!Auth::user()->perfil->organizacoes){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($organizacoes_arquivo->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Arquivo na Organização';
            $log->table = 'organizacoes_arquivos';
            $log->action = 3;
            $log->fk = $organizacoes_arquivo->id;
            $log->object = $organizacoes_arquivo;
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
