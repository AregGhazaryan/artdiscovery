<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title_hy');
            $table->string('title_en');
            $table->string('title_ru');
            $table->longText('description_hy');
            $table->longText('description_en');
            $table->longText('description_ru');
            $table->string('video');
            $table->string('start_date');
            $table->string('end_date')->nullable();
            $table->string('length')->nullable();
            $table->char('section_id',36);
            $table->foreign('section_id')->references('id')->on('sections');
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
        Schema::dropIfExists('videos');
    }
}
