<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_groups', function (Blueprint $table) {
            $table->bigInteger('video_id')->unsigned();
            $table->bigInteger('group_id')->unsigned();
            $table->unique(['video_id','group_id']);
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
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
        Schema::dropIfExists('video_groups');
    }
}
