<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupMessagesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('group_messages', function (Blueprint $table) {
            $table->bigInteger('message_id')->unsigned();
            $table->bigInteger('group_id')->unsigned();
            $table->unique(['message_id', 'group_id']);
            $table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('group_messages');
    }
}
