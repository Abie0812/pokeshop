<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePokemonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pokemons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('image_path');
            $table->string('gender', 20);
            $table->string('description');
            $table->integer('price');
            $table->string('slug', 150);
            $table->integer('element_id')->unsigned();
            $table->timestamps();

            $table->foreign('element_id')->references('id')->on('elements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pokemons');
    }
}
