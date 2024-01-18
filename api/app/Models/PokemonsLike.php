<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PokemonsLike extends Model
{
    protected $table = 'favorites.pokemons_likes'; 
    protected $guarded = ['id', 'created_at', 'updated_at'];
}