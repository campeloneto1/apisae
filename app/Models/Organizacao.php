<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizacao extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'organizacoes';

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
    protected $with = ['organizacao_tipo', 'cidade'];

    
    public function organizacao_tipo()
    {
        return $this->belongsTo(OrganizacaoTipo::class);
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }

    public function pessoas()
    {
        return $this->belongsToMany(Pessoa::class, 'organizacoes_pessoas', 'organizacao_id', 'pessoa_id')->withPivot('id', 'lider')->orderBy('nome');
    }

    public function veiculos()
    {
        return $this->belongsToMany(Veiculo::class, 'organizacoes_veiculos', 'organizacao_id', 'veiculo_id')->withPivot('id')->orderBy('placa');
    }

     public function arquivos()
    {
        return $this->hasMany(OrganizacaoArquivo::class, 'organizacao_id')->without('organizacao');
    }


   
}
