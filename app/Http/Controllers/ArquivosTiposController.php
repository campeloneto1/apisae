<?php

namespace App\Http\Controllers;

use App\Models\ArquivoTipo;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArquivosTiposController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return ArquivoTipo::orderBy('nome', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $data = new ArquivoTipo;

        $data->nome = $request->nome;  
        $data->foto = $request->foto;   
        $data->video = $request->video;  
        $data->audio = $request->audio;  
        $data->texto = $request->texto;  
        $data->pdf = $request->pdf;  

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Tipo Arquivo';
            $log->table = 'arquivos_tipos';
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
    public function show(ArquivoTipo $arquivos_tipo)
    {
        return $arquivos_tipo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ArquivoTipo $arquivos_tipo)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $arquivos_tipo;

        $arquivos_tipo->nome = $request->nome;   
        $data->foto = $request->foto;   
        $data->video = $request->video;  
        $data->audio = $request->audio;  
        $data->texto = $request->texto;  
        $data->pdf = $request->pdf;  

        $arquivos_tipo->updated_by = Auth::id();      

        if($arquivos_tipo->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Tipo de Arquivo';
            $log->table = 'arquivos_tipos';
            $log->action = 2;
            $log->fk = $arquivos_tipo->id;
            $log->object = $arquivos_tipo;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Marca editada com sucesso!', 200);
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
    public function destroy(ArquivoTipo $arquivos_tipo)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($arquivos_tipo->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Tipo de Arquivo';
            $log->table = 'arquivos_tipos';
            $log->action = 3;
            $log->fk = $arquivos_tipo->id;
            $log->object = $arquivos_tipo;
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
