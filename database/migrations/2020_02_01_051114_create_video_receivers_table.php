<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoReceiversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_receivers', function (Blueprint $table) {
            $table->bigInteger('video_id')->unsigned();
            $table->bigInteger('player_id')->unsigned();
            $table->timestamp('seen_at')->nullable();
            $table->foreign("video_id")->references("id")->on("videos")->onDelete("cascade");
            $table->foreign("player_id")->references("id")->on("players")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_receivers');
    }
}
