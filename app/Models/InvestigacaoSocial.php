<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestigacaoSocial extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'investigacoes_sociais';

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
    protected $with = ['pessoa', 'graduacao', 'companhia', 'situacao_funcional', 'situacao_tipo', 'comportamento', 'investigacao_social_status', 'encaminhou', 'indicou'];

    
    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class)->with('veiculos');
    }

    public function graduacao()
    {
        return $this->belongsTo(Graduacao::class);
    }

    public function companhia()
    {
        return $this->belongsTo(Companhia::class);
    }

    public function situacao_funcional()
    {
        return $this->belongsTo(SituacaoFuncional::class);
    }

    public function situacao_tipo()
    {
        return $this->belongsTo(SituacaoTipo::class);
    }

    public function comportamento()
    {
        return $this->belongsTo(Comportamento::class);
    }

    public function investigacao_social_status()
    {
        return $this->belongsTo(InvestigacaoSocialStatus::class);
    }

    public function indicou()
    {
        return $this->belongsTo(Pessoa::class, 'indicou_id')->without('vinculos', 'cidade', 'influencia', 'naturalidade', 'sexo');
    }

    public function encaminhou()
    {
        return $this->belongsTo(User::class, 'encaminhou_id')->without('perfil');
    }

    public function boletins()
    {
        return $this->hasMany(InvestigacaoSocialBoletim::class, 'investigacao_social_id');
    }

    public function lotacoes()
    {
        return $this->hasMany(InvestigacaoSocialLotacao::class , 'investigacao_social_id');
    }

    public function cgds()
    {
        return $this->hasMany(InvestigacaoSocialCgd::class , 'investigacao_social_id');
    }

    public function arquivos()
    {
        return $this->hasMany(InvestigacaoSocialArquivo::class , 'investigacao_social_id');
    }

}
