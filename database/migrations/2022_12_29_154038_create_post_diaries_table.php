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
        Schema::create('post_diaries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('post_id');
            $table->string('post');
            $table->string('referer')->nullable();
            $table->string('from')->nullable();
            $table->string('agent')->nullable();
            $table->string('url');
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
        Schema::dropIfExists('post_diaries');
    }
};
