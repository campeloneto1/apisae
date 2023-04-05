<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pessoas';

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
    protected $with = ['sexo', 'cidade', 'redes_sociais', 'influencia', 'cnh_categoria', 'escolaridade', 'naturalidade'];
    
    public function sexo()
    {
        return $this->belongsTo(Sexo::class);
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }

    public function cnh_categoria()
    {
        return $this->belongsTo(CnhCategoria::class);
    }

    public function escolaridade()
    {
        return $this->belongsTo(Escolaridade::class);
    }

    public function naturalidade()
    {
        return $this->belongsTo(Cidade::class, 'naturalidade_id');
    }

    public function influencia()
    {
        return $this->belongsTo(Influencia::class);
    }

    public function redes_sociais()
    {
        return $this->belongsToMany(RedeSocial::class, 'pessoas_redes_sociais', 'pessoa_id', 'rede_social_id')->withPivot('id', 'nome')->orderBy('nome');
    }

    public function veiculos()
    {
        return $this->belongsToMany(Veiculo::class, 'pessoas_veiculos', 'pessoa_id', 'veiculo_id')->withPivot('id')->orderBy('placa');
    }

    public function analises()
    {
        return $this->belongsToMany(Analise::class, 'analises_pessoas', 'pessoa_id', 'analise_id')->withPivot('id', 'lider')->orderBy('nome');
    }


    public function organizacoes()
    {
        return $this->belongsToMany(Organizacao::class, 'organizacoes_pessoas', 'pessoa_id', 'organizacao_id')->withPivot('id', 'lider')->orderBy('nome');
    }

    public function arquivos()
    {
        return $this->hasMany(PessoaArquivo::class, 'pessoa_id')->without('pessoa');
    }


     
}
