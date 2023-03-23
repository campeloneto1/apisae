<?php

namespace App\Http\Controllers;

use App\Models\RedeSocial;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RedesSociaisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return RedeSocial::orderBy('nome', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->gestor){
            return response()->json('Não Autorizado', 401);
        }
        $data = new RedeSocial;

        $data->nome = $request->nome; 

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou uma Rede Social';
            $log->table = 'redes_sociais';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Rede Social cadastrada com sucesso!', 200);
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
    public function show(RedeSocial $redes_sociai)
    {
         if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return $redes_sociai;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RedeSocial $redes_sociai)
    {
        if(!Auth::user()->perfil->gestor){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $redes_sociai;

        $redes_sociai->nome = $request->nome;   

        $redes_sociai->updated_by = Auth::id();      

        if($redes_sociai->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou uma Rede Social';
            $log->table = 'redes_sociais';
            $log->action = 2;
            $log->fk = $redes_sociai->id;
            $log->object = $redes_sociai;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Rede Social editada com sucesso!', 200);
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
    public function destroy(RedeSocial $redes_sociai)
    {
        if(!Auth::user()->perfil->gestor){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($redes_sociai->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu uma Rede Social';
            $log->table = 'redes_sociais';
            $log->action = 3;
            $log->fk = $redes_sociai->id;
            $log->object = $redes_sociai;
            $log->save();
            return response()->json('Rede Social excluída com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
