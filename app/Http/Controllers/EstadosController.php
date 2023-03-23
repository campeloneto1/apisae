<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstadosController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        return Estado::orderBy('nome', 'asc')->get();
    }

    /**
     * Display a listing of the resource.
     */
    public function where(Request $request)
    {
       
        return Estado::find($request->id)->cidades()->orderBy('nome', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $data = new Estado;

        $data->pais_id = $request->pais_id;  
        $data->nome = $request->nome;   
        $data->uf = $request->uf;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Estado';
            $log->table = 'estados';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Estado cadastrado com sucesso!', 200);
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
    public function show(Estado $estado)
    {
        return $estado;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estado $estado)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $estado;

        $estado->pais_id = $request->pais_id;
        $estado->nome = $request->nome; 
        $estado->uf = $request->uf;    

        $estado->updated_by = Auth::id();      

        if($estado->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Estado';
            $log->table = 'estados';
            $log->action = 2;
            $log->fk = $estado->id;
            $log->object = $estado;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Estado editado com sucesso!', 200);
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
    public function destroy(Estado $estado)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($estado->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Estado';
            $log->table = 'estados';
            $log->action = 3;
            $log->fk = $estado->id;
            $log->object = $estado;
            $log->save();
            return response()->json('Estado excluído com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
