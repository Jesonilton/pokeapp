<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites.pokemons_likes', function (Blueprint $table) {
            // Primary Key
            $table->id('id');
			$table->foreignId('pokemon_id')->constrained('favorites.pokemons');

            // Attributes
			$table->string('device');

            // Control Fields
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorites.pokemons');
    }
};