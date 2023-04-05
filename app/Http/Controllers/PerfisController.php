<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerfisController extends Controller
{
   
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->users){
            return response()->json('Não Autorizado', 401);
        }
        return Perfil::orderBy('nome', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $data = new Perfil;

        $data->nome = $request->nome;   

        $data->administrador = $request->administrador;   
        $data->gestor = $request->gestor;   
        $data->relatorios = $request->relatorios;   
        $data->restrito = $request->restrito;   

        $data->users = $request->users;   
        $data->users_cad = $request->users_cad;   
        $data->users_edt = $request->users_edt;   
        $data->users_del = $request->users_del; 

        $data->analises = $request->analises;   
        $data->analises_cad = $request->analises_cad;   
        $data->analises_edt = $request->analises_edt;   
        $data->analises_del = $request->analises_del; 

        $data->investigacoes_sociais = $request->investigacoes_sociais;   
        $data->investigacoes_sociais_cad = $request->investigacoes_sociais_cad;   
        $data->investigacoes_sociais_edt = $request->investigacoes_sociais_edt;   
        $data->investigacoes_sociais_del = $request->investigacoes_sociais_del; 

        $data->organizacoes = $request->organizacoes;   
        $data->organizacoes_cad = $request->organizacoes_cad;   
        $data->organizacoes_edt = $request->organizacoes_edt;   
        $data->organizacoes_del = $request->organizacoes_del; 

        $data->pessoas = $request->pessoas;   
        $data->pessoas_cad = $request->pessoas_cad;   
        $data->pessoas_edt = $request->pessoas_edt;   
        $data->pessoas_del = $request->pessoas_del; 

        $data->veiculos = $request->veiculos;   
        $data->veiculos_cad = $request->veiculos_cad;   
        $data->veiculos_edt = $request->veiculos_edt;   
        $data->veiculos_del = $request->veiculos_del;   

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Perfil';
            $log->table = 'perfis';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Perfil cadastrado com sucesso!', 200);
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
    public function show(Perfil $perfi)
    {
        if(!Auth::user()->perfil->users){
            return response()->json('Não Autorizado', 401);
        }
        return $perfi;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Perfil $perfi)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $perfi;

        $perfi->nome = $request->nome;  

        $perfi->administrador = $request->administrador;   
        $perfi->gestor = $request->gestor;   
        $perfi->relatorios = $request->relatorios; 
        $perfi->restrito = $request->restrito;   

        $perfi->users = $request->users;   
        $perfi->users_cad = $request->users_cad;   
        $perfi->users_edt = $request->users_edt;   
        $perfi->users_del = $request->users_del; 

        $perfi->analises = $request->analises;   
        $perfi->analises_cad = $request->analises_cad;   
        $perfi->analises_edt = $request->analises_edt;   
        $perfi->analises_del = $request->analises_del; 

        $perfi->organizacoes = $request->organizacoes;   
        $perfi->organizacoes_cad = $request->organizacoes_cad;   
        $perfi->organizacoes_edt = $request->organizacoes_edt;   
        $perfi->organizacoes_del = $request->organizacoes_del; 

        $perfi->pessoas = $request->pessoas;   
        $perfi->pessoas_cad = $request->pessoas_cad;   
        $perfi->pessoas_edt = $request->pessoas_edt;   
        $perfi->pessoas_del = $request->pessoas_del; 

        $perfi->veiculos = $request->veiculos;   
        $perfi->veiculos_cad = $request->veiculos_cad;   
        $perfi->veiculos_edt = $request->veiculos_edt;   
        $perfi->veiculos_del = $request->veiculos_del;   

        $perfi->updated_by = Auth::id();      

        if($perfi->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Perfil';
            $log->table = 'perfis';
            $log->action = 2;
            $log->fk = $perfi->id;
            $log->object = $perfi;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Perfil editado com sucesso!', 200);
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
    public function destroy(Perfil $perfi)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($perfi->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Perfil';
            $log->table = 'perfis';
            $log->action = 3;
            $log->fk = $perfi->id;
            $log->object = $perfi;
            $log->save();
            return response()->json('Perfil excluído com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
