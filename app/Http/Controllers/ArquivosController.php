<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArquivosController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function uploadArquivo(Request $request){  
        if ($request->hasFile('file')){
            $file      = $request->file('file');
          

            if($request->file('file')->getSize() > 1000000){
                 $erro = "Tamanho máximo permitido é 1mb!";
                $cod = 171;
                $resposta = ['erro' => $erro, 'cod' => $cod];
               return response()->json($resposta, 403);
            }

            $filename  = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture   = date('dmYHis').".".$extension;
            if($file->move(storage_path().'/app/public/', $picture)){
              //return ;
               return response()->json($picture, 200);
            }else{
                $erro = "Não foi possivel realizar a edição!";
                $cod = 171;
                $resposta = ['erro' => $erro, 'cod' => $cod];
               return response()->json($resposta, 404);
            }
        }else{
              $erro = "Não foi possivel realizar a edição!";
                $cod = 171;
                $resposta = ['erro' => $erro, 'cod' => $cod];
               return response()->json($resposta, 404);
        }
  
        
    }
}
