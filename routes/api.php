<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnalisesArquivosController;
use App\Http\Controllers\AnalisesCategoriasController;
use App\Http\Controllers\AnalisesController;
use App\Http\Controllers\AnalisesPessoasController;
use App\Http\Controllers\AnalisesTiposController;
use App\Http\Controllers\AnalisesVeiculosController;
use App\Http\Controllers\ArquivosController;
use App\Http\Controllers\ArquivosTiposController;
use App\Http\Controllers\BatalhaoController;
use App\Http\Controllers\CidadesController;
use App\Http\Controllers\CgdEnvolvimentoTipoController;
use App\Http\Controllers\CgdProcessoTipoController;
use App\Http\Controllers\CgdSituacaoTipoController;
use App\Http\Controllers\CnhCategoriaController;
use App\Http\Controllers\CompanhiaController;
use App\Http\Controllers\ComportamentoController;
use App\Http\Controllers\CoresController;
use App\Http\Controllers\EscolaridadeController;
use App\Http\Controllers\EstadosController;
use App\Http\Controllers\GraduacaoController;
use App\Http\Controllers\InfluenciasController;
use App\Http\Controllers\InvestigacaoSocialController;
use App\Http\Controllers\InvestigacaoSocialBoletimController;
use App\Http\Controllers\InvestigacaoSocialCgdController;
use App\Http\Controllers\InvestigacaoSocialLotacaoController;
use App\Http\Controllers\InvestigacaoSocialStatusController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\LotacaoTipoController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\ModelosController;
use App\Http\Controllers\OrganizacoesController;
use App\Http\Controllers\OrganizacoesArquivosController;
use App\Http\Controllers\OrganizacoesPessoasController;
use App\Http\Controllers\OrganizacoesTiposController;
use App\Http\Controllers\OrganizacoesVeiculosController;
use App\Http\Controllers\PaisesController;
use App\Http\Controllers\PerfisController;
use App\Http\Controllers\PesquisarController;
use App\Http\Controllers\PessoasController;
use App\Http\Controllers\PessoasArquivosController;
use App\Http\Controllers\PessoaVinculoController;
use App\Http\Controllers\PessoasRedesSociaisController;
use App\Http\Controllers\PessoasVeiculosController;
use App\Http\Controllers\RedesSociaisController;
use App\Http\Controllers\SexosController;
use App\Http\Controllers\SistemaController;
use App\Http\Controllers\SituacaoFuncionalController;
use App\Http\Controllers\SituacaoTipoController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VeiculosController;
use App\Http\Controllers\VeiculosArquivosController;
use App\Http\Controllers\VeiculosTiposController;
use App\Http\Controllers\VinculoTipoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' =>  ['guest:api', 'middleware' => 'throttle:5,1']], function() {
    Route::post('/login', [AuthController::class, 'login']);     
});

Route::group(['middleware' => ['auth:api']], function() {
    Route::get('/logout', [AuthController::class, 'logout']); 
    Route::get('/check', [AuthController::class, 'check']); 

    Route::apiResource('analises-arquivos', AnalisesArquivosController::class);
    Route::apiResource('analises-categorias', AnalisesCategoriasController::class);
    Route::apiResource('analises', AnalisesController::class);
    Route::apiResource('analises-pessoas', AnalisesPessoasController::class);
    Route::apiResource('analises-tipos', AnalisesTiposController::class);
    Route::apiResource('analises-veiculos', AnalisesVeiculosController::class);
    Route::apiResource('arquivos-tipos', ArquivosTiposController::class);
    Route::apiResource('batalhoes', BatalhaoController::class);
    Route::apiResource('cidades', CidadesController::class);
    Route::apiResource('cgds-envolvimentos-tipos', CgdEnvolvimentoTipoController::class);
    Route::apiResource('cgds-processos-tipos', CgdProcessoTipoController::class);
    Route::apiResource('cgds-situacoes-tipos', CgdSituacaoTipoController::class);
    Route::apiResource('cnh-categorias', CnhCategoriaController::class);
    Route::apiResource('companhias', CompanhiaController::class);
    Route::apiResource('comportamentos', ComportamentoController::class);
    Route::apiResource('cores', CoresController::class);
    Route::apiResource('escolaridades', EscolaridadeController::class);
    Route::apiResource('estados', EstadosController::class);
    Route::apiResource('graduacoes', GraduacaoController::class);
    Route::apiResource('influencias', InfluenciasController::class);    
    Route::apiResource('investigacoes-sociais', InvestigacaoSocialController::class);    
    Route::apiResource('investigacoes-sociais-boletins', InvestigacaoSocialBoletimController::class);  
    Route::apiResource('investigacoes-sociais-cgds', InvestigacaoSocialCgdController::class);   
    Route::apiResource('investigacoes-sociais-lotacoes', InvestigacaoSocialLotacaoController::class);
    Route::apiResource('investigacoes-sociais-status', InvestigacaoSocialStatusController::class);    
    Route::apiResource('logs', LogsController::class);
    Route::apiResource('lotacoes-tipos', LotacaoTipoController::class);
    Route::apiResource('marcas', MarcasController::class);
    Route::apiResource('modelos', ModelosController::class);
    Route::apiResource('organizacoes', OrganizacoesController::class);
    Route::apiResource('organizacoes-arquivos', OrganizacoesArquivosController::class);
    Route::apiResource('organizacoes-pessoas', OrganizacoesPessoasController::class);
    Route::apiResource('organizacoes-tipos', OrganizacoesTiposController::class);
    Route::apiResource('organizacoes-veiculos', OrganizacoesVeiculosController::class);
    Route::apiResource('paises', PaisesController::class);
    Route::apiResource('perfis', PerfisController::class);
    Route::apiResource('pessoas', PessoasController::class);
    Route::apiResource('pessoas-arquivos', PessoasArquivosController::class);
    Route::apiResource('pessoas-vinculos', PessoaVinculoController::class);
    Route::apiResource('pessoas-redes-sociais', PessoasRedesSociaisController::class);
    Route::apiResource('pessoas-veiculos', PessoasVeiculosController::class);    
    Route::apiResource('redes-sociais', RedesSociaisController::class);
    Route::apiResource('sexos', SexosController::class);
    Route::apiResource('situacoes-funcionais', SituacaoFuncionalController::class);
    Route::apiResource('situacoes-tipos', SituacaoTipoController::class);
    Route::apiResource('users', UsersController::class);
    Route::apiResource('veiculos', VeiculosController::class);
    Route::apiResource('veiculos-arquivos', VeiculosArquivosController::class);
    Route::apiResource('veiculos-tipos', VeiculosTiposController::class);
    Route::apiResource('vinculos-tipos', VinculoTipoController::class);

    Route::get('inicio-quantanalises', [InicioController::class, 'quant_analises']);
    Route::get('inicio-quantinvestigacoes', [InicioController::class, 'quant_investigacoes']);
    Route::get('inicio-ultimasinvestigacoes', [InicioController::class, 'ultimas_investigacoes']);
    Route::post('investigacoes-sociais-changestatus', [InvestigacaoSocialController::class, 'change_status']);
    Route::post('pesquisar', [PesquisarController::class, 'pesquisar']);

    Route::get('batalhoes/{id}/companhias', [BatalhaoController::class, 'where']);
    Route::get('estados/{id}/cidades', [EstadosController::class, 'where']);

    Route::get('marcas/{id}/modelos', [MarcasController::class, 'where']);
    Route::get('paises/{id}/estados', [PaisesController::class, 'where']);
    Route::get('pessoas/{cpf}/checkCpf', [PessoasController::class, 'checkCpf']);
    Route::get('users/{user}/resetpass', [UsersController::class, 'resetpass']);

    Route::post('upload-image', [SistemaController::class, 'uploadFoto']);
    Route::post('upload-arquivo', [ArquivosController::class, 'uploadArquivo']);
    Route::post('upload-foto', [PessoasController::class, 'uploadFoto']);
});
