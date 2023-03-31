<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizacaoArquivo extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'organizacoes_arquivos';

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
    protected $with = ['organizacao', 'arquivo_tipo'];

    
    public function organizacao()
    {
        return $this->belongsTo(Organizacao::class);
    }

    public function arquivo_tipo()
    {
        return $this->belongsTo(ArquivoTipo::class);
    }
}
