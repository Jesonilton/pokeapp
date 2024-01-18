<?php

namespace App\Models;

use App\Models\Type;
use App\Models\PokemonsLike;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pokemon extends Model
{
    use SoftDeletes;
    
    protected $table = 'favorites.pokemons'; 
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function likes()
    {
        return $this->hasMany(PokemonsLike::class);
    }

    public function types()
    {
        return $this->belongsToMany(Type::class, 'favorites.pokemons_types', 'pokemon_id', 'type_id');
    }
}