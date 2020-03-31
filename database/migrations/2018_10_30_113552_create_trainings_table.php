<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('trainings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sport_id')->unsigned()->nullable();
            $table->timestamp('date_time');
            $table->string("title");
            $table->boolean('confirmed')->default(0);
            $table->text("description")->nullable();
            $table->longText("link")->nullable();
            $table->text("image_path")->nullable();
            $table->text("header_image_path")->nullable();
            $table->bigInteger('notification_id')->unsigned()->unique()->nullable();
            $table->foreign('sport_id')->references('id')->on('sports')->onDelete('cascade');
            $table->foreign('notification_id')->references('id')->on('notifications')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('trainings');
    }
}
