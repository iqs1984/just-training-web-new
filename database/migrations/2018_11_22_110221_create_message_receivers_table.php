<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageReceiversTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('message_receivers', function (Blueprint $table) {
            $table->bigInteger('message_id')->unsigned();
            $table->bigInteger('receiver_id')->unsigned();
            $table->timestamp("seen_at")->nullable();
            $table->unique(["message_id", "receiver_id"]);
            $table->foreign("message_id")->references("id")->on("messages")->onDelete("cascade");
            $table->foreign("receiver_id")->references("id")->on("players")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('message_receivers');
    }
}
