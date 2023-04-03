<?php

namespace App\Http\Controllers;

use App\Models\AnaliseArquivo;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnalisesArquivosController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->analises){
            return response()->json('Não Autorizado', 401);
        }
        return AnaliseArquivo::orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->analises){
            return response()->json('Não Autorizado', 401);
        }
        $data = new AnaliseArquivo;

        $data->analise_id = $request->analise_id;     
        $data->nome = $request->nome;   
        $data->arquivo = $request->arquivo;   
        $data->arquivo_tipo_id = $request->arquivo_tipo_id;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Arquivo na Analise';
            $log->table = 'analises_arquivos';
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
    public function show(AnaliseArquivo $analises_arquivo)
    {
        if(!Auth::user()->perfil->analises){
            return response()->json('Não Autorizado', 401);
        }
        return $analises_arquivo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnaliseArquivo $analises_arquivo)
    {
        if(!Auth::user()->perfil->analises){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $analises_arquivo;

        $analises_arquivo->analise_id = $request->analise_id;     
        $analises_arquivo->nome = $request->nome;  
        $analises_arquivo->arquivo = $request->arquivo;   
        $analises_arquivo->arquivo_tipo_id = $request->arquivo_tipo_id;   

        $analises_arquivo->updated_by = Auth::id();      

        if($analises_arquivo->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Arquivo da Analise';
            $log->table = 'analises_arquivos';
            $log->action = 2;
            $log->fk = $analises_arquivo->id;
            $log->object = $analises_arquivo;
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
    public function destroy(AnaliseArquivo $analises_arquivo)
    {
        if(!Auth::user()->perfil->analises){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($analises_arquivo->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Arquivo da Analise';
            $log->table = 'analises_arquivos';
            $log->action = 3;
            $log->fk = $analises_arquivo->id;
            $log->object = $analises_arquivo;
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
