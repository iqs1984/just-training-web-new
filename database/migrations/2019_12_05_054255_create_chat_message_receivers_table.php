<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatMessageReceiversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_message_receivers', function (Blueprint $table) {
            $table->bigInteger('chat_message_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamp('seen_at')->nullable();
            $table->foreign("chat_message_id")->references("id")->on("chat_messages")->onDelete("cascade");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->unique(["chat_message_id", "user_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_message_receivers');
    }
}
