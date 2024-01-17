<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('following_id')->comment('フォローしているユーザID');
            $table->unsignedBigInteger('followed_id')->comment('フォローされているユーザID');
            $table->timestamps();

            $table->index('id');
            $table->index('following_id');
            $table->index('followed_id');

            $table->unique(['following_id', 'followed_id']);

            $table->foreign('following_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('followed_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('followers');
    }
}
