<?php

namespace App\Http\Controllers;

use App\Models\OrganizacaoPessoa;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrganizacoesPessoasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->organizacoes){
            return response()->json('Não Autorizado', 401);
        }
        return OrganizacaoPessoa::orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         if(!Auth::user()->perfil->organizacoes){
            return response()->json('Não Autorizado', 401);
        }
        $data = new OrganizacaoPessoa;

        $data->organizacao_id = $request->organizacao_id;     
        $data->pessoa_id = $request->pessoa_id;   
        $data->lider = $request->lider;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou uma Pessoa na Organização';
            $log->table = 'organizacoes_pessoas';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Pessoa cadastrada com sucesso!', 200);
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
    public function show(OrganizacaoPessoa $organizacoes_pessoa)
    {
         if(!Auth::user()->perfil->organizacoes){
            return response()->json('Não Autorizado', 401);
        }
        return $organizacoes_pessoa;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrganizacaoPessoa $organizacoes_pessoa)
    {
        if(!Auth::user()->perfil->organizacoes){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $organizacoes_pessoa;

        $organizacoes_pessoa->organizacao_id = $request->organizacao_id;     
        $organizacoes_pessoa->pessoa_id = $request->pessoa_id;   
        $organizacoes_pessoa->lider = $request->lider;   

        $organizacoes_pessoa->updated_by = Auth::id();      

        if($organizacoes_pessoa->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou uma Pessoa na Organização';
            $log->table = 'organizacoes_pessoas';
            $log->action = 2;
            $log->fk = $organizacoes_pessoa->id;
            $log->object = $organizacoes_pessoa;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Pessoa editada com sucesso!', 200);
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
    public function destroy(OrganizacaoPessoa $organizacoes_pessoa)
    {
        if(!Auth::user()->perfil->organizacoes){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($organizacoes_pessoa->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu uma Pessoa na Organização';
            $log->table = 'organizacoes_pessoas';
            $log->action = 3;
            $log->fk = $organizacoes_pessoa->id;
            $log->object = $organizacoes_pessoa;
            $log->save();
            return response()->json('Pessoa excluída com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
