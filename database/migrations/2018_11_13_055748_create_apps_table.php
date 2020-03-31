<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('apps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('one_signal_id')->nullable()->unique();
            $table->string('push_token')->nullable()->unique();
            $table->string("platform")->nullable();
            $table->string("holder_type")->nullable();
            $table->bigInteger("holder_id")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('apps');
    }
}
