<?php

namespace App\Http\Controllers;

use App\Models\Batalhao;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class BatalhaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return Batalhao::orderBy('nome', 'asc')->get();
    }


    /**
     * Display a listing of the resource.
     */
    public function where(Request $request)
    {
       
        return Batalhao::find($request->id)->companhias()->orderBy('nome', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $data = new Batalhao;

        $data->nome = $request->nome;
        $data->abreviatura = $request->abreviatura;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Batalhão';
            $log->table = 'batalhoes';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Cor cadastrada com sucesso!', 200);
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
    public function show(Batalhao $batalho)
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return $batalho;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Batalhao $batalho)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $batalho;

        $batalho->nome = $request->nome;  
        $batalho->abreviatura = $request->abreviatura;  

        $batalho->updated_by = Auth::id();      

        if($batalho->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Batalhão';
            $log->table = 'batalhoes';
            $log->action = 2;
            $log->fk = $batalho->id;
            $log->object = $batalho;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Batalhão editado com sucesso!', 200);
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
    public function destroy(Batalhao $batalho)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($batalho->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Batalhão';
            $log->table = 'batalhoes';
            $log->action = 3;
            $log->fk = $batalho->id;
            $log->object = $batalho;
            $log->save();
            return response()->json('Batalhão excluído com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
