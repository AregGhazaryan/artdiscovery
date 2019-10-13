<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->date('birthday');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('mobile');
            $table->string('avatar')->default('default.png');
            $table->string('address')->nullable();
            $table->string('gender');
            $table->string('ip_address')->nullable();
            $table->timestamp('last_activity')->nullable();
            $table->boolean('agreed_to_terms');
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->default(2);
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('statuses')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
