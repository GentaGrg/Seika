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
        // users テーブルがまだ存在しない場合に作成
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('screen_name')->unique()->nullable()->comment('アカウント名');
                $table->string('name')->nullable()->comment('ユーザ名');
                $table->string('profile_image')->nullable()->comment('プロフィール画像');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->string('profile_picture_path')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // テーブルが存在する場合に削除
        Schema::dropIfExists('users');
    }
};
