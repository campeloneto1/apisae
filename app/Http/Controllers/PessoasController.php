<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PessoasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return Pessoa::orderBy('nome', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->pessoas_cad){
            return response()->json('Não Autorizado', 401);
        }
        $data = new Pessoa;

        $data->nome = $request->nome;   
        $data->alcunha = $request->alcunha;
        $data->cpf = $request->cpf;
        $data->data_nascimento = $request->data_nascimento;
        $data->mae = $request->mae;
        $data->pai = $request->pai;
        $data->sexo_id = $request->sexo_id;
        $data->influencia_id = $request->influencia_id;

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

        $data->key = bcrypt($request->cpf);          

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou uma Pessoa';
            $log->table = 'pessoas';
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
    public function show(Pessoa $pessoa)
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return $pessoa;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pessoa $pessoa)
    {
         if(!Auth::user()->perfil->pessoas_edt){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $pessoa;

        $pessoa->nome = $request->nome;   
        $pessoa->alcunha = $request->alcunha;
        $pessoa->cpf = $request->cpf;
        $pessoa->data_nascimento = $request->data_nascimento;
        $pessoa->mae = $request->mae;
        $pessoa->pai = $request->pai;
        $pessoa->sexo_id = $request->sexo_id;
        $pessoa->influencia_id = $request->influencia_id;

        $pessoa->telefone1 = $request->telefone1;
        $pessoa->telefone2 = $request->telefone2; 
        $pessoa->email = $request->email;  
        
        $pessoa->observacao = $request->observacao;       

        $pessoa->cep = $request->cep;  
        $pessoa->rua = $request->rua;   
        $pessoa->numero = $request->numero;   
        $pessoa->bairro = $request->bairro;   
        $pessoa->cidade_id = $request->cidade_id;   
        $pessoa->complemento = $request->complemento;       

        $pessoa->key = bcrypt($request->cpf);                  

        $pessoa->created_by = Auth::id();      

        if($pessoa->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou uma Pessoa';
            $log->table = 'pessoas';
            $log->action = 2;
            $log->fk = $pessoa->id;
            $log->object = $pessoa;
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
    public function destroy(Pessoa $pessoa)
    {
        if(!Auth::user()->perfil->pessoas_del){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($pessoa->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu uma Pessoa';
            $log->table = 'pessoas';
            $log->action = 3;
            $log->fk = $pessoa->id;
            $log->object = $pessoa;
            $log->save();
            return response()->json('Pessoa excluída com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
             return response()->json($resposta, 404);
          }
    }


    /**
     * Display a listing of the resource.
     */
    public function checkCpf(Request $request)
    {
         if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }

        $quant = Pessoa::where('cpf', $request->cpf)->count();
        if($quant > 0){
            return true;
        }else{
            return false;
        }
    }
}
