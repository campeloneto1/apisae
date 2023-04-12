<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestigacaoSocialBoletim extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'investigacoes_sociais_boletins';

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
    protected $with = [];

    
    public function investigacao_social()
    {
        return $this->belongsTo(InvestigacaoSocial::class);
    }
}
