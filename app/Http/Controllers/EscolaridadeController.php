<?php

namespace App\Http\Controllers;

use App\Models\Escolaridade;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EscolaridadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return Escolaridade::orderBy('nome', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $data = new Escolaridade;

        $data->nome = $request->nome;
        
        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou uma Escolaridade';
            $log->table = 'escolaridades';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Escolaridade cadastrada com sucesso!', 200);
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
    public function show(Escolaridade $escolaridade)
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return $escolaridade;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Escolaridade $escolaridade)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $escolaridade;

        $escolaridade->nome = $request->nome;   

        $escolaridade->updated_by = Auth::id();      

        if($escolaridade->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou uma Escolaridade';
            $log->table = 'escolaridades';
            $log->action = 2;
            $log->fk = $escolaridade->id;
            $log->object = $escolaridade;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Escolaridade editada com sucesso!', 200);
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
    public function destroy(Escolaridade $escolaridade)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($escolaridade->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu uma Escolaridade';
            $log->table = 'escolaridades';
            $log->action = 3;
            $log->fk = $escolaridade->id;
            $log->object = $escolaridade;
            $log->save();
            return response()->json('Escolaridade excluída com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
