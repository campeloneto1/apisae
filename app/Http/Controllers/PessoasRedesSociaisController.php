<?php

namespace App\Http\Controllers;

use App\Models\PessoaRedeSocial;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PessoasRedesSociaisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return PessoaRedeSocial::orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        $data = new PessoaRedeSocial;

        $data->rede_social_id = $request->rede_social_id;     
        $data->pessoa_id = $request->pessoa_id; 
        $data->nome = $request->nome;  

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou uma Rede Social na Pessoa';
            $log->table = 'pessoas_redes_sociais';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Rede Social cadastrado com sucesso!', 200);
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
    public function show(PessoaRedeSocial $pessoas_redes_sociai)
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return $pessoas_redes_sociai;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PessoaRedeSocial $pessoas_redes_sociai)
    {
         if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $pessoas_redes_sociai;

        $pessoas_redes_sociai->rede_social_id = $request->rede_social_id;     
        $pessoas_redes_sociai->pessoa_id = $request->pessoa_id; 
        $pessoas_redes_sociai->nome = $request->nome;  

        $pessoas_redes_sociai->updated_by = Auth::id();      

        if($pessoas_redes_sociai->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou uma Rede Social na Pessoa';
            $log->table = 'pessoas_redes_sociais';
            $log->action = 2;
            $log->fk = $pessoas_redes_sociai->id;
            $log->object = $pessoas_redes_sociai;
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
    public function destroy(PessoaRedeSocial $pessoas_redes_sociai)
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($pessoas_redes_sociai->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu uma Rede Social na Pessoa';
            $log->table = 'pessoas_redes_sociais';
            $log->action = 3;
            $log->fk = $pessoas_redes_sociai->id;
            $log->object = $pessoas_redes_sociai;
            $log->save();
            return response()->json('Rede Social excluído com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
