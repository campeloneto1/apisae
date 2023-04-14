<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Analise;
use App\Models\InvestigacaoSocial;
use Carbon\Carbon;

class InicioController extends Controller
{
    public function quant_analises(){
        //$now = Carbon::now();
        return Analise::whereYear('data', '=', Carbon::now())->whereMonth('data', '=', Carbon::now())->count();
    }

    public function quant_investigacoes(){
        //$now = Carbon::now();
        return InvestigacaoSocial::whereYear('created_at', '=', Carbon::now())->whereMonth('created_at', '=', Carbon::now())->count();
    }

    public function ultimas_investigacoes(){
        //$now = Carbon::now();
        return InvestigacaoSocial::orderBy('id', 'desc')->limit(5)->get();
    }

    
}
