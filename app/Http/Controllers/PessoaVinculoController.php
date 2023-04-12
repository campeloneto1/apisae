<?php

namespace App\Http\Controllers;

use App\Models\PessoaVinculo;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PessoaVinculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return PessoaVinculo::orderBy('nome', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        $data = new PessoaVinculo;

        $data->nome = $request->nome;     
        $data->pessoa_id = $request->pessoa_id; 
        $data->vinculo_tipo_id = $request->vinculo_tipo_id; 
        $data->observacao = $request->observacao; 

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Vínculo';
            $log->table = 'pessoas_vinculos';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Vínculo cadastrado com sucesso!', 200);
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
    public function show(PessoaVinculo $pessoas_vinculo)
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return $pessoas_vinculo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PessoaVinculo $pessoas_vinculo)
    {
         if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $pessoas_vinculo;

        $pessoas_vinculo->nome = $request->nome;     
        $pessoas_vinculo->pessoa_id = $request->pessoa_id; 
        $pessoas_vinculo->vinculo_tipo_id = $request->vinculo_tipo_id; 
        $pessoas_vinculo->observacao = $request->observacao; 

        $pessoas_vinculo->updated_by = Auth::id();      

        if($pessoas_vinculo->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Vínculo de uma Pessoa';
            $log->table = 'pessoas_vinculos';
            $log->action = 2;
            $log->fk = $pessoas_vinculo->id;
            $log->object = $pessoas_vinculo;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Veículo editado com sucesso!', 200);
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
    public function destroy(PessoaVinculo $pessoas_vinculo)
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($pessoas_vinculo->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Vínculo de uma Pessoa';
            $log->table = 'pessoas_vinculos';
            $log->action = 3;
            $log->fk = $pessoas_vinculo->id;
            $log->object = $pessoas_vinculo;
            $log->save();
            return response()->json('Vínculo excluído com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
