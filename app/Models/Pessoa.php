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
    protected $with = ['sexo', 'cidade', 'redes_sociais'];
    
    public function sexo()
    {
        return $this->belongsTo(Sexo::class);
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }

    public function redes_sociais()
    {
        return $this->belongsToMany(RedeSocial::class, 'pessoas_redes_sociais', 'pessoa_id', 'rede_social_id')->withPivot('id')->orderBy('nome');
    }
}
