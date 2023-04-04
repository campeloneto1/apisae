<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'veiculos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

     /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['cor', 'modelo', 'veiculo_tipo', 'pessoa', 'organizacao'];

    
    public function cor()
    {
        return $this->belongsTo(Cor::class);
    }

    public function modelo()
    {
        return $this->belongsTo(Modelo::class);
    }

    public function veiculo_tipo()
    {
        return $this->belongsTo(VeiculoTipo::class);
    }

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }

    public function organizacao()
    {
        return $this->belongsTo(Organizacao::class);
    }

    public function pessoas()
    {
        return $this->belongsToMany(Pessoa::class, 'pessoas_veiculos', 'veiculo_id', 'pessoa_id')->withPivot('id')->orderBy('nome');
    }

    public function analises()
    {
        return $this->belongsToMany(Analise::class, 'analises_veiculos', 'veiculo_id', 'analise_id')->withPivot('id')->orderBy('nome');
    }


    public function organizacoes()
    {
        return $this->belongsToMany(Organizacao::class, 'organizacoes_veiculos', 'veiculo_id', 'organizacao_id')->withPivot('id')->orderBy('nome');
    }

    public function arquivos()
    {
        return $this->hasMany(VeiculoArquivo::class, 'veiculo_id')->without('veiculo');
    }

}
