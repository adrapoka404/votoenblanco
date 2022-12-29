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
        Schema::create('category_diaries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id');
            $table->string('category');
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
        Schema::dropIfExists('category_diaries');
    }
};
