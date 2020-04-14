<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFieldsTypePersonalInfoColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users_personal_info', function(Blueprint $table) {
            $table->integer('country_id')->charset(null)->collation(null)->change();
            $table->integer('state_id')->charset(null)->collation(null)->change();
            $table->integer('city_id')->charset(null)->collation(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
