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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_create')->index();
            $table->foreignId('user_edit')->index()->nullable();
            $table->string('title')->require();
            $table->string('slug')->require();
            $table->string('description')->require();
            $table->string('slug_description')->require();
            $table->string('social_text')->require();
            $table->integer('views')->nullable();
            $table->integer('shareds')->nullable();
            $table->boolean('featured');
            $table->integer('status');
            $table->string('image_principal')->require();
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
        Schema::dropIfExists('posts');
    }
};
