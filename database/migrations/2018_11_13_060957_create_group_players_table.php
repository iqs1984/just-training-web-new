<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_players', function (Blueprint $table) {
            $table->bigInteger('player_id')->unsigned();
            $table->bigInteger('group_id')->unsigned();
            $table->unique(['player_id','group_id']);
            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_players');
    }
}
