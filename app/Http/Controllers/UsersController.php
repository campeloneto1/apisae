<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->users){
            return response()->json('Não Autorizado', 401);
        }
        return User::orderBy('nome', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->users_cad){
            return response()->json('Não Autorizado', 401);
        }
        $data = new User;

        $data->perfil_id = $request->perfil_id;   
        $data->nome = $request->nome;   
        $data->cpf = $request->cpf;  
        $data->password = bcrypt($request->cpf);
        $data->email = $request->email;   
        $data->telefone = $request->telefone;   
        //$data->telefone2 = $request->telefone2;    

        $data->key = bcrypt($request->cpf);

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Usuário';
            $log->table = 'users';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Usuário cadastrada com sucesso!', 200);
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
    public function show(User $user)
    {
        if(!Auth::user()->perfil->users){
            return response()->json('Não Autorizado', 401);
        }
        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if(!Auth::user()->perfil->users_edt){
            return response()->json('Não Autorizado', 401);
        }
        $dataold = $user;

        $user->perfil_id = $request->perfil_id;   
        $user->nome = $request->nome;   
        $user->cpf = $request->cpf;  
        $user->email = $request->nemailome;   
        $user->telefone = $request->telefone;   
        //$user->telefone2 = $request->telefone2;   

        $user->key = bcrypt($request->cpf); 

        $user->updated_by = Auth::id();      

        if($user->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Usuário';
            $log->table = 'users';
            $log->action = 2;
            $log->fk = $user->id;
            $log->object = $user;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Usuário editado com sucesso!', 200);
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
    public function destroy(User $user)
    {
        if(!Auth::user()->perfil->users_del){
            return response()->json('Não Autorizado', 401);
        }
                 
         if($user->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Usuário';
            $log->table = 'users';
            $log->action = 3;
            $log->fk = $user->id;
            $log->object = $user;
            $log->save();
            return response()->json('Usuário excluído com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a exclusão!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }

     /**
     * Remove the specified resource from storage.
     */
    public function resetpass(User $user)
    {
        if(!Auth::user()->perfil->users_edt){
            return response()->json('Não Autorizado', 401);
        }

        $user->password = bcrypt($user->cpf);
                 
         if($user->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Alterou senha do Usuário';
            $log->table = 'users';
            $log->action = 2;
            $log->fk = $user->id;
            $log->object = $user;
            $log->save();
            return response()->json('Senha alterada com sucesso!', 200);
          }else{
            $erro = "Não foi possivel realizar a alteração!";
            $cod = 171;
            $resposta = ['erro' => $erro, 'cod' => $cod];
            return response()->json($resposta, 404);
          }
    }
}
