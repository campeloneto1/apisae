<?php

namespace App\Http\Controllers;

use App\Models\CgdProcessoTipo;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CgdProcessoTipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->investigacoes_sociais){
            return response()->json('Não Autorizado', 401);
        }
        return CgdProcessoTipo::orderBy('nome', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->gestor){
            return response()->json('Não Autorizado', 401);
        }
        $data = new CgdProcessoTipo;

        $data->nome = $request->nome;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Tipo de Processo da CGD';
            $log->table = 'cgd_processos_tipos';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Tipo cadastrado com sucesso!', 200);
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
    public function show(CgdProcessoTipo $cgd_processos_tipos)
    {
        if(!Auth::user()->perfil->investigacoes_sociais){
            return response()->json('Não Autorizado', 401);
        }
        return $cgd_processos_tipos;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CgdProcessoTipo $cgd_processos_tipos)
    {
        if(!Auth::user()->perfil->gestor){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $cgd_processos_tipos;

        $cgd_processos_tipos->nome = $request->nome;   

        $cgd_processos_tipos->updated_by = Auth::id();      

        if($cgd_processos_tipos->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou  um Tipo de Processo da CGD';
            $log->table = 'cgd_processos_tipos';
            $log->action = 2;
            $log->fk = $cgd_processos_tipos->id;
            $log->object = $cgd_processos_tipos;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Tipo editado com sucesso!', 200);
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
    public function destroy(CgdProcessoTipo $cgd_processos_tipos)
    {
        if(!Auth::user()->perfil->gestor){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($cgd_processos_tipos->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Tipo de Processo da CGD';
            $log->table = 'cgd_processos_tipos';
            $log->action = 3;
            $log->fk = $cgd_processos_tipos->id;
            $log->object = $cgd_processos_tipos;
            $log->save();
            return response()->json('Tipo excluído com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
