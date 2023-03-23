<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'veiculos';

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
    protected $with = ['cor', 'modelo', 'veiculo_tipo'];

    
    public function cor()
    {
        return $this->belongsTo(Cor::class);
    }

    public function modelo()
    {
        return $this->belongsTo(Modelo::class);
    }

    public function veiculo_tipo()
    {
        return $this->belongsTo(VeiculoTipo::class);
    }

}
