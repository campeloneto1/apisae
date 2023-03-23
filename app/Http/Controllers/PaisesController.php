<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaisesController extends Controller
{    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        return Pais::orderBy('nome', 'asc')->get();
    }

    /**
     * Display a listing of the resource.
     */
    public function where(Request $request)
    {
       
        return Pais::find($request->id)->estados()->orderBy('nome', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->gestor){
            return response()->json('Não Autorizado', 401);
        }
        $data = new Pais;

        $data->nome = $request->nome;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um País';
            $log->table = 'paises';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('País cadastrado com sucesso!', 200);
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
    public function show(Pais $paise)
    {
        
        return $paise;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pais $paise)
    {
        if(!Auth::user()->perfil->gestor){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $paise;

        $paise->nome = $request->nome;   

        $paise->updated_by = Auth::id();      

        if($paise->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um País';
            $log->table = 'paises';
            $log->action = 2;
            $log->fk = $paise->id;
            $log->object = $paise;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('País editada com sucesso!', 200);
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
    public function destroy(Pais $paise)
    {
        if(!Auth::user()->perfil->gestor){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($paise->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um País';
            $log->table = 'paises';
            $log->action = 3;
            $log->fk = $paise->id;
            $log->object = $paise;
            $log->save();
            return response()->json('País excluída com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
