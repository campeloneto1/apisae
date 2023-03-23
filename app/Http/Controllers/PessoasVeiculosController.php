<?php

namespace App\Http\Controllers;

use App\Models\PessoaVeiculo;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PessoasVeiculosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return PessoaVeiculo::orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        $data = new PessoaVeiculo;

        $data->veiculo_id = $request->veiculo_id;     
        $data->pessoa_id = $request->pessoa_id; 

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Veículo na Pessoa';
            $log->table = 'pessoas_veiculos';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Veículo cadastrado com sucesso!', 200);
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
    public function show(PessoaVeiculo $pessoas_veiculo)
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return $pessoas_veiculo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PessoaVeiculo $pessoas_veiculo)
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $pessoas_veiculo;

        $pessoas_veiculo->veiculo_id = $request->veiculo_id;     
        $pessoas_veiculo->pessoa_id = $request->pessoa_id; 

        $pessoas_veiculo->updated_by = Auth::id();      

        if($pessoas_veiculo->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Veículo na Pessoa';
            $log->table = 'pessoas_veiculos';
            $log->action = 2;
            $log->fk = $pessoas_veiculo->id;
            $log->object = $pessoas_veiculo;
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
    public function destroy(PessoaVeiculo $pessoas_veiculo)
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($pessoas_veiculo->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Veículo na Pessoa';
            $log->table = 'pessoas_veiculos';
            $log->action = 3;
            $log->fk = $pessoas_veiculo->id;
            $log->object = $pessoas_veiculo;
            $log->save();
            return response()->json('Veículo excluído com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
