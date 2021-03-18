<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('reference_id');
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('post_series', function (Blueprint $table) {
            $table->uuid('post_id');
            $table->uuid('series_id');
            $table->integer('sort_order');

            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('series_id')->references('id')->on('series');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_series');
        Schema::dropIfExists('series');
    }
}
