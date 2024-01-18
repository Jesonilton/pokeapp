<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PokemonsTypes extends Model
{
    protected $table = 'favorites.pokemons_types'; 
    protected $guarded = ['id', 'created_at', 'updated_at'];
}