<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHobbyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hobby', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->text('txt_hobbies')->nullable();
            $table->text('txt_favorite_music')->nullable();
            $table->text('txt_favorite_tv')->nullable();
            $table->text('txt_favorite_book')->nullable();
            $table->text('txt_favorite_movie')->nullable();
            $table->text('txt_favorite_writer')->nullable();
            $table->text('txt_favorite_game')->nullable();
            $table->text('txt_other_interest')->nullable();
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
        Schema::dropIfExists('hobby');
    }
}
