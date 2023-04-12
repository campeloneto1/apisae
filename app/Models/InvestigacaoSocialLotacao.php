<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestigacaoSocialLotacao extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'investigacoes_sociais_lotacoes';

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
    protected $with = ['companhia', 'lotacao_tipo'];

    
    public function investigacao_social()
    {
        return $this->belongsTo(InvestigacaoSocial::class);
    }

    public function companhia()
    {
        return $this->belongsTo(Companhia::class);
    }

    public function lotacao_tipo()
    {
        return $this->belongsTo(LotacaoTipo::class);
    }
}
