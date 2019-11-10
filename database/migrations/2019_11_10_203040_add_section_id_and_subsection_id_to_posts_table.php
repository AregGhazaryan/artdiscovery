<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSectionIdAndSubsectionIdToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
          $table->foreign('section_id')->references('id')->on('sections');
          $table->char('section_id', 36)->nullable();
          $table->foreign('subsection_id')->references('id')->on('subsections');
          $table->char('subsection_id', 36)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('section_id');
            $table->dropColumn('subsection_id');
        });
    }
}
