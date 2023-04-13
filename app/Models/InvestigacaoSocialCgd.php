<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestigacaoSocialCgd extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'investigacoes_sociais_cgds';

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
    protected $with = ['cgd_envolvimento_tipo', 'cgd_processo_tipo', 'cgd_situacao_tipo'];

    
    public function investigacao_social()
    {
        return $this->belongsTo(InvestigacaoSocial::class);
    }

    public function cgd_envolvimento_tipo()
    {
        return $this->belongsTo(CgdEnvolvimentoTipo::class);
    }

    public function cgd_processo_tipo()
    {
        return $this->belongsTo(CgdProcessoTipo::class);
    }

    public function cgd_situacao_tipo()
    {
        return $this->belongsTo(CgdSituacaoTipo::class);
    }
}
