<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Analise;
use App\Models\Organizacao;
use App\Models\Pessoa;
use App\Models\Veiculo;

class PesquisarController extends Controller
{
    public function pesquisar(Request $request){
        $array = [];
        if($request->analises){
            $analises = Analise::where('nome', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('observacao', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('previa', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('sintese', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('rua', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('complemento', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('pessoas', 'nome', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('veiculos', 'placa', 'like', '%'.$request->pesquisar.'%')
            ->orderBy('data', 'desc')
            ->get();
            $array['analises'] = $analises;
        }
        if($request->organizacoes){
            $organizacoes = Organizacao::where('nome', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('telefone1', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('telefone2', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('email', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('rua', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('complemento', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('observacao', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('pessoas', 'nome', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('veiculos', 'placa', 'like', '%'.$request->pesquisar.'%')
            ->orderBy('nome', 'asc')
            ->get();
            $array['organizacoes'] = $organizacoes;
        }
        if($request->pessoas){
            $pessoas = Pessoa::where('nome', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('alcunha', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('cpf', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('mae', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('pai', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('telefone1', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('telefone2', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('email', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('rua', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('complemento', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('observacao', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('veiculos', 'placa', 'like', '%'.$request->pesquisar.'%')
            ->orderBy('nome', 'asc')
            ->get();
            $array['pessoas'] = $pessoas;
        }
        if($request->veiculos){
            $veiculos = Veiculo::where('placa', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('chassi', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('renavam', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('observacao', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('pessoas', 'nome', 'like', '%'.$request->pesquisar.'%')
            ->orderBy('placa', 'asc')
            ->get();
            $array['veiculos'] = $veiculos;
        }
        return $array;
    }
}
