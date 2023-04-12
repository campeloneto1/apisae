<?php

namespace App\Http\Controllers;

use App\Models\VinculoTipo;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VinculoTipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return VinculoTipo::orderBy('nome', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $data = new VinculoTipo;

        $data->nome = $request->nome;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Tipo de Vínculo';
            $log->table = 'vinculos_tipos';
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
    public function show(VinculoTipo $vinculos_tipos)
    {
        if(!Auth::user()->perfil->pessoas){
            return response()->json('Não Autorizado', 401);
        }
        return $vinculos_tipos;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VinculoTipo $vinculos_tipos)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $vinculos_tipos;

        $vinculos_tipos->nome = $request->nome;   

        $vinculos_tipos->updated_by = Auth::id();      

        if($vinculos_tipos->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Tipo de Vínculo';
            $log->table = 'vinculos_tipos';
            $log->action = 2;
            $log->fk = $vinculos_tipos->id;
            $log->object = $vinculos_tipos;
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
    public function destroy(VinculoTipo $vinculos_tipos)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($vinculos_tipos->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Tipo de Vínculo';
            $log->table = 'vinculos_tipos';
            $log->action = 3;
            $log->fk = $vinculos_tipos->id;
            $log->object = $vinculos_tipos;
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
