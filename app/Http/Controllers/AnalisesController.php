<?php

namespace App\Http\Controllers;

use App\Models\Analise;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class AnalisesController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         if(!Auth::user()->perfil->analises){
            return response()->json('Não Autorizado', 401);
        }
        return Analise::orderBy('data', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         if(!Auth::user()->perfil->analises_cad){
            return response()->json('Não Autorizado', 401);
        }
        $data = new Analise;

        $data->nome = $request->nome;   
        $data->data = $request->data;
        $data->hora = $request->hora;  
        $data->analise_tipo_id = $request->analise_tipo_id;
        $data->analise_categoria_id = $request->analise_categoria_id;

        $data->observacao = $request->observacao;
        $data->previa = $request->previa;
        $data->sintese = $request->sintese;         

        $data->cep = $request->cep;  
        $data->rua = $request->rua;   
        $data->numero = $request->numero;   
        $data->bairro = $request->bairro;   
        $data->cidade_id = $request->cidade_id;   
        $data->complemento = $request->complemento;    

        $data->key = bcrypt($request->analise_tipo_id.$request->analise_categoria_id.$request->data.$request->hora.$request->nome);            

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou uma Análise';
            $log->table = 'analises';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Análise cadastrada com sucesso!', 200);
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
    public function show(Analise $analise)
    {
        if(!Auth::user()->perfil->analises){
            return response()->json('Não Autorizado', 401);
        }
        return Analise::with('pessoas', 'veiculos', 'arquivos')->findOrFail($analise->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Analise $analise)
    {
        if(!Auth::user()->perfil->analises_edt){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $analise;

        $analise->nome = $request->nome;   
        $analise->data = $request->data;
        $analise->hora = $request->hora;  
        $analise->analise_tipo_id = $request->analise_tipo_id;
        $analise->analise_categoria_id = $request->analise_categoria_id;

        $analise->observacao = $request->observacao;
        $analise->previa = $request->previa;
        $analise->sintese = $request->sintese;         

        $analise->cep = $request->cep;  
        $analise->rua = $request->rua;   
        $analise->numero = $request->numero;   
        $analise->bairro = $request->bairro;   
        $analise->cidade_id = $request->cidade_id;   
        $analise->complemento = $request->complemento;    

        $analise->key = bcrypt($request->analise_tipo_id.$request->analise_categoria_id.$request->data.$request->hora.$request->nome);          

        $analise->created_by = Auth::id();      

        if($analise->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou  uma Análise';
            $log->table = 'analises';
            $log->action = 2;
            $log->fk = $analise->id;
            $log->object = $analise;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Análise editada com sucesso!', 200);
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
    public function destroy(Analise $analise)
    {
        if(!Auth::user()->perfil->analises_del){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($analise->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu  uma Análise';
            $log->table = 'analises';
            $log->action = 3;
            $log->fk = $analise->id;
            $log->object = $analise;
            $log->save();
            return response()->json('Análise excluída com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
