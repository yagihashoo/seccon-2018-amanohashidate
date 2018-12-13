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
            $table->string('model_answer', 512)->default('');
            $table->boolean('verified')->default(false);
            $table->boolean('solved')->default(false);
            $table->string('from_ip');
            $table->uuid('setter_id');
            $table->uuid('file_id')->unique();
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
