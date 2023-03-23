<?php

namespace App\Http\Controllers;

use App\Models\AnalisePessoa;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnalisesPessoasController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->analises){
            return response()->json('Não Autorizado', 401);
        }
        return AnalisePessoa::orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->analises){
            return response()->json('Não Autorizado', 401);
        }
        $data = new AnalisePessoa;

        $data->analise_id = $request->analise_id;     
        $data->pessoa_id = $request->pessoa_id;   
        $data->lider = $request->lider;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou uma Pessoa na Análise';
            $log->table = 'analises_pessoas';
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
    public function show(AnalisePessoa $analises_pessoa)
    {
        if(!Auth::user()->perfil->analises){
            return response()->json('Não Autorizado', 401);
        }
        return $analises_pessoa;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnalisePessoa $analises_pessoa)
    {
        if(!Auth::user()->perfil->analises){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $analises_pessoa;

        $analises_pessoa->analise_id = $request->analise_id;     
        $analises_pessoa->pessoa_id = $request->pessoa_id;   
        $analises_pessoa->lider = $request->lider;   

        $analises_pessoa->updated_by = Auth::id();      

        if($analises_pessoa->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou uma Pessoa na Análise';
            $log->table = 'analises_pessoas';
            $log->action = 2;
            $log->fk = $analises_pessoa->id;
            $log->object = $analises_pessoa;
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
    public function destroy(AnalisePessoa $analises_pessoa)
    {
         if(!Auth::user()->perfil->analises){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($analises_pessoa->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu uma Pessoa na Análise';
            $log->table = 'analises_pessoas';
            $log->action = 3;
            $log->fk = $analises_pessoa->id;
            $log->object = $analises_pessoa;
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
