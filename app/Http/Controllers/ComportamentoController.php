<?php

namespace App\Http\Controllers;

use App\Models\Comportamento;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class ComportamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return Comportamento::orderBy('nome', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $data = new Comportamento;

        $data->nome = $request->nome;
        
        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Comportamento';
            $log->table = 'comportamentos';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Comportamento cadastrado com sucesso!', 200);
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
    public function show(Comportamento $comportamento)
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return $comportamento;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comportamento $comportamento)
    {
         if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $comportamento;

        $comportamento->nome = $request->nome;   

        $comportamento->updated_by = Auth::id();      

        if($comportamento->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou uma Comportamento';
            $log->table = 'comportamentos';
            $log->action = 2;
            $log->fk = $comportamento->id;
            $log->object = $comportamento;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Comportamento editado com sucesso!', 200);
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
    public function destroy(Comportamento $comportamento)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($comportamento->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Comportamento';
            $log->table = 'comportamentos';
            $log->action = 3;
            $log->fk = $comportamento->id;
            $log->object = $comportamento;
            $log->save();
            return response()->json('Comportamento excluído com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
