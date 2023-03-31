<?php

namespace App\Http\Controllers;

use App\Models\OrganizacaoTipo;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrganizacoesTiposController extends Controller
{    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->organizacoes){
            return response()->json('Não Autorizado', 401);
        }
        return OrganizacaoTipo::orderBy('nome', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->gestor){
            return response()->json('Não Autorizado', 401);
        }
        $data = new OrganizacaoTipo;

        $data->nome = $request->nome;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Tipo de Organização';
            $log->table = 'organizacoes_tipos';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Tipo cadastrado com sucesso!', 200);
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
    public function show(OrganizacaoTipo $organizacoes_tipo)
    {
        if(!Auth::user()->perfil->organizacoes){
            return response()->json('Não Autorizado', 401);
        }
        return $organizacoes_tipo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrganizacaoTipo $organizacoes_tipo)
    {
        if(!Auth::user()->perfil->gestor){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $organizacoes_tipo;

        $organizacoes_tipo->nome = $request->nome;   

        $organizacoes_tipo->updated_by = Auth::id();      

        if($organizacoes_tipo->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Tipo de Organização';
            $log->table = 'organizacoes_tipos';
            $log->action = 2;
            $log->fk = $organizacoes_tipo->id;
            $log->object = $organizacoes_tipo;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Tipo editado com sucesso!', 200);
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
    public function destroy(OrganizacaoTipo $organizacoes_tipo)
    {
        if(!Auth::user()->perfil->gestor){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($organizacoes_tipo->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Tipo de Organização';
            $log->table = 'organizacoes_tipos';
            $log->action = 3;
            $log->fk = $organizacoes_tipo->id;
            $log->object = $organizacoes_tipo;
            $log->save();
            return response()->json('Tipo excluído com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
