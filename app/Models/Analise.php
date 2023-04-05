<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analise extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'analises';

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
    protected $with = ['analise_categoria', 'analise_tipo', 'cidade'];

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }

    
    public function analise_categoria()
    {
        return $this->belongsTo(AnaliseCategoria::class);
    }

    public function analise_tipo()
    {
        return $this->belongsTo(AnaliseTipo::class);
    }

     public function pessoas()
    {
        return $this->belongsToMany(Pessoa::class, 'analises_pessoas', 'analise_id', 'pessoa_id')->withPivot('id', 'lider')->orderBy('nome');
    }

    public function veiculos()
    {
        return $this->belongsToMany(Veiculo::class, 'analises_veiculos', 'analise_id', 'veiculo_id')->withPivot('id')->orderBy('placa');
    }

     public function arquivos()
    {
        return $this->hasMany(AnaliseArquivo::class, 'analise_id')->without('analise');
    }

}
