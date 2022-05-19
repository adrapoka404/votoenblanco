<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->string('position')->nullable();
            $table->string('signature')->nullable();
            $table->string('email')->nullable();
            $table->string('profession')->nullable();
            $table->string('speciality')->nullable();
            $table->string('semblance')->nullable();
            $table->string('birthday')->nullable();
            $table->string('mobile')->nullable();
            $table->string('fb')->nullable();
            $table->string('tw')->nullable();
            $table->string('yt')->nullable();
            $table->string('tt')->nullable();
            $table->string('personal')->nullable();
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
        Schema::dropIfExists('profile');
    }
};
