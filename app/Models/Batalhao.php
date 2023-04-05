<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batalhao extends Model
{
    use HasFactory;


     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'batalhoes';

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
    
    public function companhias()
    {
        return $this->hasMany(Companhia::class, 'batalhao_id');
    }
}
