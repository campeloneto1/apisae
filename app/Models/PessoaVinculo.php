<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PessoaVinculo extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pessoas_vinculos';

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
    protected $with = ['pessoa', 'vinculo_tipo'];

    
    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }

    public function vinculo_tipo()
    {
        return $this->belongsTo(VinculoTipo::class);
    }
}
