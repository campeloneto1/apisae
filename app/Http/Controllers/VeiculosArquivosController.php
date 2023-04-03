<?php

namespace App\Http\Controllers;

use App\Models\VeiculoArquivo;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VeiculosArquivosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->veiculos){
            return response()->json('Não Autorizado', 401);
        }
        return VeiculoArquivo::orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         if(!Auth::user()->perfil->veiculos){
            return response()->json('Não Autorizado', 401);
        }
        $data = new VeiculoArquivo;

        $data->veiculo_id = $request->veiculo_id;     
        $data->nome = $request->nome;  
        $data->arquivo = $request->arquivo;    
        $data->arquivo_tipo_id = $request->arquivo_tipo_id;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Arquivo no Veículo';
            $log->table = 'veiculos_arquivos';
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
    public function show(VeiculoArquivo $veiculos_arquivo)
    {
         if(!Auth::user()->perfil->veiculos){
            return response()->json('Não Autorizado', 401);
        }
        return $veiculos_arquivo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VeiculoArquivo $veiculos_arquivo)
    {
        if(!Auth::user()->perfil->organizacoes){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $veiculos_arquivo;

        $veiculos_arquivo->veiculo_id = $request->veiculo_id;     
        $veiculos_arquivo->nome = $request->nome;   
        $veiculos_arquivo->arquivo = $request->arquivo;   
        $veiculos_arquivo->arquivo_tipo_id = $request->arquivo_tipo_id;   

        $veiculos_arquivo->updated_by = Auth::id();      

        if($veiculos_arquivo->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Arquivo no Veículo';
            $log->table = 'veiculos_arquivos';
            $log->action = 2;
            $log->fk = $veiculos_arquivo->id;
            $log->object = $veiculos_arquivo;
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
    public function destroy(VeiculoArquivo $veiculos_arquivo)
    {
        if(!Auth::user()->perfil->veiculos){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($veiculos_arquivo->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Arquivo no Veículo';
            $log->table = 'veiculos_arquivos';
            $log->action = 3;
            $log->fk = $veiculos_arquivo->id;
            $log->object = $veiculos_arquivo;
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
