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
        Schema::table('post_details', function (Blueprint $table) {
            $table->boolean('posted_now')
            ->after('posted')
            ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_details', function (Blueprint $table) {
            $table->dropColumn(array_merge([
                'posted_time',
            ]));
        });
    }
};
