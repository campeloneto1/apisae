<?php

namespace App\Http\Controllers;

use App\Models\AnaliseCategoria;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnalisesCategoriasController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->analises){
            return response()->json('Não Autorizado', 401);
        }
        return AnaliseCategoria::orderBy('nome', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->gestor){
            return response()->json('Não Autorizado', 401);
        }
        $data = new AnaliseCategoria;

        $data->nome = $request->nome;   
        $data->gestor = $request->gestor;  
        $data->tipo = $request->tipo;   
        $data->previa = $request->previa;  
        $data->sintese = $request->sintese;  
        $data->endereco = $request->endereco;  

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou uma Categoria de Analise';
            $log->table = 'analises_categorias';
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
    public function show(AnaliseCategoria $analises_categoria)
    {
        if(!Auth::user()->perfil->analises){
            return response()->json('Não Autorizado', 401);
        }
        return $analises_categoria;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnaliseCategoria $analises_categoria)
    {
        if(!Auth::user()->perfil->gestor){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $analises_categoria;

        $analises_categoria->gestor = $request->gestor;     
        $analises_categoria->nome = $request->nome;  
        $analises_categoria->tipo = $request->tipo;   
        $analises_categoria->previa = $request->previa;  
        $analises_categoria->sintese = $request->sintese;  
        $analises_categoria->endereco = $request->endereco;  

        $analises_categoria->updated_by = Auth::id();      

        if($analises_categoria->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou uma Categoria de Analise';
            $log->table = 'analises_categorias';
            $log->action = 2;
            $log->fk = $analises_categoria->id;
            $log->object = $analises_categoria;
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
    public function destroy(AnaliseCategoria $analises_categoria)
    {
        if(!Auth::user()->perfil->gestor){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($analises_categoria->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu uma Categoria de Analise';
            $log->table = 'analises_categorias';
            $log->action = 3;
            $log->fk = $analises_categoria->id;
            $log->object = $analises_categoria;
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
