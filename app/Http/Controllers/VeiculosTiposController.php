<?php

namespace App\Http\Controllers;

use App\Models\VeiculoTipo;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VeiculosTiposController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->veiculos){
            return response()->json('Não Autorizado', 401);
        }
        return VeiculoTipo::orderBy('nome', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->gestor){
            return response()->json('Não Autorizado', 401);
        }
        $data = new VeiculoTipo;

        $data->nome = $request->nome;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Tipo de Veículo';
            $log->table = 'veiculos_tipos';
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
    public function show(VeiculoTipo $veiculos_tipo)
    {
        if(!Auth::user()->perfil->veiculos){
            return response()->json('Não Autorizado', 401);
        }
        return $veiculos_tipo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VeiculoTipo $veiculos_tipo)
    {
        
        if(!Auth::user()->perfil->gestor){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $veiculos_tipo;

        $veiculos_tipo->nome = $request->nome;   

        $veiculos_tipo->updated_by = Auth::id();      

        if($veiculos_tipo->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Tipo de Veículo';
            $log->table = 'veiculos_tipos';
            $log->action = 2;
            $log->fk = $veiculos_tipo->id;
            $log->object = $veiculos_tipo;
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
    public function destroy(VeiculoTipo $veiculos_tipo)
    {
        if(!Auth::user()->perfil->gestor){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($veiculos_tipo->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Tipo de Veículo';
            $log->table = 'veiculos_tipos';
            $log->action = 3;
            $log->fk = $veiculos_tipo->id;
            $log->object = $veiculos_tipo;
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
