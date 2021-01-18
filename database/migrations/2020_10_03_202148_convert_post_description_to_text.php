<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ConvertPostDescriptionToText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Change the 'description' column from a varchar to a text field.
        Schema::table('posts', function (Blueprint $table) {
            $table->text('description')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revert the 'description' column to a varchar.
        // Clear the column first so we don't run into truncation issues.
        DB::table('posts')->update(['description' => '']);

        // Convert the column
        Schema::table('posts', function (Blueprint $table) {
            $table->string('description')->change();
        });
    }
}
