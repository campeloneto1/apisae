<?php

namespace App\Http\Controllers;

use App\Models\Companhia;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanhiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return Companhia::orderBy('nome', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $data = new Companhia;

        $data->batalhao_id = $request->batalhao_id;
        $data->nome = $request->nome;
        $data->abreviatura = $request->abreviatura;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou uma Companhia';
            $log->table = 'companhias';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Companhia cadastrada com sucesso!', 200);
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
    public function show(Companhia $companhia)
    {
         if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return $companhia;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Companhia $companhia)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $companhia;

        $companhia->batalhao_id = $request->batalhao_id;   
        $companhia->nome = $request->nome;
        $companhia->abreviatura = $request->abreviatura;

        $companhia->updated_by = Auth::id();      

        if($companhia->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou uma Companhia';
            $log->table = 'companhias';
            $log->action = 2;
            $log->fk = $companhia->id;
            $log->object = $companhia;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Companhia editada com sucesso!', 200);
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
    public function destroy(Companhia $companhia)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($companhia->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu uma Companhia';
            $log->table = 'companhias';
            $log->action = 3;
            $log->fk = $companhia->id;
            $log->object = $companhia;
            $log->save();
            return response()->json('Companhia excluída com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
