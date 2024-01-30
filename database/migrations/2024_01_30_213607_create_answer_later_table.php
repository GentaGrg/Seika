<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerLaterTable extends Migration
{
    public function up()
    {
        Schema::create('answer_later', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('post_id')->constrained('posts');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('answer_later');
    }
}

