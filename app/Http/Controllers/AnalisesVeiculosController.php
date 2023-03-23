<?php

namespace App\Http\Controllers;

use App\Models\AnaliseVeiculo;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnalisesVeiculosController extends Controller
{    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->analises){
            return response()->json('Não Autorizado', 401);
        }
        return AnaliseVeiculo::orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->analises){
            return response()->json('Não Autorizado', 401);
        }
        $data = new AnaliseVeiculo;

        $data->analise_id = $request->analise_id;     
        $data->veiculo_id = $request->veiculo_id;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Veículo na Análise';
            $log->table = 'analises_veiculos';
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
    public function show(AnaliseVeiculo $analises_veiculo)
    {
        if(!Auth::user()->perfil->analises){
            return response()->json('Não Autorizado', 401);
        }
        return $analises_veiculo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnaliseVeiculo $analises_veiculo)
    {
        if(!Auth::user()->perfil->analises){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $analises_veiculo;

        $analises_veiculo->analise_id = $request->analise_id;     
        $analises_veiculo->veiculo_id = $request->veiculo_id;   

        $analises_veiculo->updated_by = Auth::id();      

        if($analises_veiculo->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Veículo na Análise';
            $log->table = 'analises_veiculos';
            $log->action = 2;
            $log->fk = $analises_veiculo->id;
            $log->object = $analises_veiculo;
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
    public function destroy(AnaliseVeiculo $analises_veiculo)
    {
        if(!Auth::user()->perfil->analises){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($analises_veiculo->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Veículo na Análise';
            $log->table = 'analises_veiculos';
            $log->action = 3;
            $log->fk = $analises_veiculo->id;
            $log->object = $analises_veiculo;
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
