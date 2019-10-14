<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->foreign('user_id')->references('id')->on('users');
                $table->char('user_id', 36);
                $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
                $table->char('post_id', 36);
                $table->char('parent_id', 36)->nullable();
                $table->text('body');
                $table->integer('commentable_id')->unsigned();
                $table->string('commentable_type');
                $table->timestamps();
                $table->softDeletes();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
