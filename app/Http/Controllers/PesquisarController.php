<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Analise;
use App\Models\InvestigacaoSocial;
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
            ->orWhereRelation('pessoas', 'cpf', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('pessoas', 'alcunha', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('veiculos', 'placa', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('veiculos', 'chassi', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('veiculos', 'renavam', 'like', '%'.$request->pesquisar.'%')
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
            ->orWhereRelation('pessoas', 'cpf', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('pessoas', 'alcunha', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('veiculos', 'placa', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('veiculos', 'chassi', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('veiculos', 'renavam', 'like', '%'.$request->pesquisar.'%')
            ->orderBy('nome', 'asc')
            ->get();
            $array['organizacoes'] = $organizacoes;
        }
        if($request->pessoas){
            $pessoas = Pessoa::where('nome', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('alcunha', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('cpf', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('telefone1', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('telefone2', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('email', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('cnh', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('rua', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('complemento', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('observacao', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('vinculos', 'nome', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('vinculos', 'cpf', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('veiculos', 'placa', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('veiculos', 'chassi', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('veiculos', 'renavam', 'like', '%'.$request->pesquisar.'%')
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
            ->orWhereRelation('pessoas', 'cpf', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('pessoas', 'alcunha', 'like', '%'.$request->pesquisar.'%')
            ->orderBy('placa', 'asc')
            ->get();
            $array['veiculos'] = $veiculos;
        }

        if($request->investigacoes_sociais){
            $investigacoes_sociais = InvestigacaoSocial::where('numeral', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('matricula', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('nome_guerra', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('sip', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('sinesp', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('tjce', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('fontes_abertas', 'like', '%'.$request->pesquisar.'%')
            ->orWhere('informacoes_adicionais', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('cgds', 'spu', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('cgds', 'descricao', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('boletins', 'bcg', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('boletins', 'descricao', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('lotacoes', 'bcg', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('pessoa', 'nome', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('pessoa', 'alcunha', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('pessoa', 'cpf', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('pessoa', 'telefone1', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('pessoa', 'email', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('pessoa', 'cnh', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('pessoa', 'rua', 'like', '%'.$request->pesquisar.'%')
            ->orWhereRelation('pessoa', 'observacao', 'like', '%'.$request->pesquisar.'%')
            ->orderBy('id', 'desc')
            ->get();
            $array['investigacoes_sociais'] = $investigacoes_sociais;
        }
        return $array;
    }
}
