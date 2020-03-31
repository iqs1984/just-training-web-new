<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText("content");
            $table->bigInteger("sender_id")->unsigned();
            $table->bigInteger("chat_room_id")->unsigned();
            $table->foreign("sender_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("chat_room_id")->references("id")->on("chat_rooms")->onDelete("cascade");
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
        Schema::dropIfExists('chat_messages');
    }
}
