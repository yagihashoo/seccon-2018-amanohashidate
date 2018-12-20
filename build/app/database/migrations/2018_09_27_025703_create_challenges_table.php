<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChallengesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->string('title', 64)->default('');
            $table->string('model_answer', 256)->default('');
            $table->string('status')->default(\App\Challenge::$status_none);
            $table->string('from_ip');
            $table->uuid('setter_id');
            $table->string('html', 4096);
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
        Schema::dropIfExists('challenges');
    }
}
