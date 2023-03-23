<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VeiculosController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->veiculos){
            return response()->json('Não Autorizado', 401);
        }
        return Veiculo::orderBy('nome', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->veiculos_cad){
            return response()->json('Não Autorizado', 401);
        }
        $data = new Veiculo;

        $data->placa = $request->placa;   
        $data->renavam = $request->renavam;
        $data->chassi = $request->chassi;
        $data->cor_id = $request->cor_id;
        $data->modelo_id = $request->modelo_id;
        $data->veiculo_tipo_id = $request->veiculo_tipo_id;
        $data->pessoa_id = $request->pessoa_id;
        $data->organizacao_id = $request->organizacao_id;

        $data->observacao = $request->observacao;       

        $data->key = bcripty($request->placa);          

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Veículo';
            $log->table = 'veiculos';
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
    public function show(Veiculo $veiculo)
    {
        if(!Auth::user()->perfil->veiculos){
            return response()->json('Não Autorizado', 401);
        }
        return $veiculo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Veiculo $veiculo)
    {
        if(!Auth::user()->perfil->veiculos_edt){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $veiculo;

        $veiculo->placa = $request->placa;   
        $veiculo->renavam = $request->renavam;
        $veiculo->chassi = $request->chassi;
        $veiculo->cor_id = $request->cor_id;
        $veiculo->modelo_id = $request->modelo_id;
        $veiculo->veiculo_tipo_id = $request->veiculo_tipo_id;
        $veiculo->pessoa_id = $request->pessoa_id;
        $veiculo->organizacao_id = $request->organizacao_id;

        $veiculo->observacao = $request->observacao;       

        $veiculo->key = bcripty($request->placa);          

        $veiculo->created_by = Auth::id();      

        if($veiculo->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Veículo';
            $log->table = 'veiculos';
            $log->action = 2;
            $log->fk = $veiculo->id;
            $log->object = $veiculo;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Veículo editada com sucesso!', 200);
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
    public function destroy(Veiculo $veiculo)
    {
        if(!Auth::user()->perfil->veiculos_del){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($veiculo->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Veículo';
            $log->table = 'veiculos';
            $log->action = 3;
            $log->fk = $veiculo->id;
            $log->object = $veiculo;
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
