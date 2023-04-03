<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Analise;
use Carbon\Carbon;

class InicioController extends Controller
{
    public function quant_analises(){
        //$now = Carbon::now();
        return Analise::whereYear('data', '=', Carbon::now())->whereMonth('data', '=', Carbon::now())->count();
    }

    
}
