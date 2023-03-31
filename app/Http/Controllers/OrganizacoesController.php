<?php

namespace App\Http\Controllers;

use App\Models\Organizacao;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrganizacoesController extends Controller
{    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->organizacoes){
            return response()->json('Não Autorizado', 401);
        }
        return Organizacao::orderBy('nome', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         if(!Auth::user()->perfil->organizacoes_cad){
            return response()->json('Não Autorizado', 401);
        }
        $data = new Organizacao;

        $data->nome = $request->nome;   
        $data->organizacao_tipo_id = $request->organizacao_tipo_id;
        $data->telefone1 = $request->telefone1;
        $data->telefone2 = $request->telefone2; 
        $data->email = $request->email;  
        
        $data->observacao = $request->observacao;       

        $data->cep = $request->cep;  
        $data->rua = $request->rua;   
        $data->numero = $request->numero;   
        $data->bairro = $request->bairro;   
        $data->cidade_id = $request->cidade_id;   
        $data->complemento = $request->complemento;    

        $data->key = bcrypt($request->organizacao_tipo_id.$request->nome);          

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou uma Organização';
            $log->table = 'organizacoes';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Organização cadastrada com sucesso!', 200);
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
    public function show(Organizacao $organizaco)
    {
        if(!Auth::user()->perfil->organizacoes){
            return response()->json('Não Autorizado', 401);
        }
        return Organizacao::with('pessoas', 'veiculos', 'arquivos')->findOrFail($organizaco->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Organizacao $organizaco)
    {
        if(!Auth::user()->perfil->organizacoes_edt){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $organizaco;

        $organizaco->nome = $request->nome;   
        $organizaco->organizacao_tipo_id = $request->organizacao_tipo_id;
        $organizaco->telefone1 = $request->telefone1;
        $organizaco->telefone2 = $request->telefone2; 
        $organizaco->email = $request->email;  
        
        $organizaco->observacao = $request->observacao;       

        $organizaco->cep = $request->cep;  
        $organizaco->rua = $request->rua;   
        $organizaco->numero = $request->numero;   
        $organizaco->bairro = $request->bairro;   
        $organizaco->cidade_id = $request->cidade_id;   
        $organizaco->complemento = $request->complemento;    

        $organizaco->key = bcrypt($request->organizacao_tipo_id.$request->nome);          

        $organizaco->created_by = Auth::id();      

        if($organizaco->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou uma Organização';
            $log->table = 'organizacoes';
            $log->action = 2;
            $log->fk = $organizaco->id;
            $log->object = $organizaco;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Organização editada com sucesso!', 200);
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
    public function destroy(Organizacao $organizaco)
    {
        if(!Auth::user()->perfil->organizacoes_del){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($organizaco->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu uma Organização';
            $log->table = 'organizacoes';
            $log->action = 3;
            $log->fk = $organizaco->id;
            $log->object = $organizaco;
            $log->save();
            return response()->json('Organização excluída com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
