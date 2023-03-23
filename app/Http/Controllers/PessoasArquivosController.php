<?php

namespace App\Http\Controllers;

use App\Models\PessoaArquivo;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PessoasArquivosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return PessoaArquivo::orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        $data = new PessoaArquivo;

        $data->pessoa_id = $request->pessoa_id;     
        $data->nome = $request->nome;   
        $data->arquivo_tipo_id = $request->arquivo_tipo_id;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Arquivo na Pessoa';
            $log->table = 'poessoas_arquivos';
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
    public function show(PessoaArquivo $pessoas_arquivo)
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return $pessoas_arquivo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PessoaArquivo $pessoas_arquivo)
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $pessoas_arquivo;

        $pessoas_arquivo->pessoa_id = $request->pessoa_id;     
        $pessoas_arquivo->nome = $request->nome;   
        $pessoas_arquivo->arquivo_tipo_id = $request->arquivo_tipo_id;   

        $pessoas_arquivo->updated_by = Auth::id();      

        if($pessoas_arquivo->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Arquivo na Pessoa';
            $log->table = 'pessoas_arquivos';
            $log->action = 2;
            $log->fk = $pessoas_arquivo->id;
            $log->object = $pessoas_arquivo;
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
    public function destroy(PessoaArquivo $pessoas_arquivo)
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($pessoas_arquivo->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Arquivo na Pessoa';
            $log->table = 'pessoas_arquivos';
            $log->action = 3;
            $log->fk = $pessoas_arquivo->id;
            $log->object = $pessoas_arquivo;
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
