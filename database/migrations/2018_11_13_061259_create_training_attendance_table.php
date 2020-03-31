<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingAttendanceTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('training_attendance', function (Blueprint $table) {
            $table->bigInteger('training_id')->unsigned();
            $table->bigInteger('player_id')->unsigned();
            $table->boolean("is_confirmed")->default(0);
            $table->timestamp('attended_at')->nullable();
            $table->timestamp('reminder_at')->nullable();
            $table->unique(['training_id', 'player_id']);
            $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade');
            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('training_attendance');
    }
}
