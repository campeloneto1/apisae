<?php

namespace App\Http\Controllers;

use App\Models\CnhCategoria;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CnhCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return CnhCategoria::orderBy('nome', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $data = new CnhCategoria;

        $data->nome = $request->nome;
        
        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou uma Categoria de CNH';
            $log->table = 'cnh_categorias';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Categoria cadastrada com sucesso!', 200);
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
    public function show(CnhCategoria $cnh_categoria)
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return $cnh_categoria;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CnhCategoria $cnh_categoria)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $cnh_categoria;

        $cnh_categoria->nome = $request->nome;   

        $cnh_categoria->updated_by = Auth::id();      

        if($cnh_categoria->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou uma Categoria de CNH';
            $log->table = 'cnh_categorias';
            $log->action = 2;
            $log->fk = $cnh_categoria->id;
            $log->object = $cnh_categoria;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Categoria editada com sucesso!', 200);
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
    public function destroy(CnhCategoria $cnh_categoria)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($cnh_categoria->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu uma Categoria';
            $log->table = 'cnh_categorias';
            $log->action = 3;
            $log->fk = $cnh_categoria->id;
            $log->object = $cnh_categoria;
            $log->save();
            return response()->json('Categoria excluída com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
