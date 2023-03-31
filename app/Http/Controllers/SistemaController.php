<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SistemaController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function uploadFoto(Request $request){  
        if ($request->hasFile('file')){
            $file = $request->file('file');    

            if($request->file('file')->getSize() > 1000000){
                 $erro = "Tamanho máximo permitido é 1mb!";
                $cod = 171;
                $resposta = ['erro' => $erro, 'cod' => $cod];
               return response()->json($resposta, 403);
            }

            $filename  = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture   = date('dmYHis').".".$extension;
            $file->move(storage_path().'/app/public/', $picture);
            return json_encode(["imageUrl" => "http://10.9.168.179/apisae/public/storage/".$picture]);
            

        }
    }
}
