<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ユーザーを取得
        $users = \App\Models\User::all();

        // カテゴリを取得
        $categories = \App\Models\Category::all();

        // ポストを挿入
        DB::table('posts')->insert([
            'title' => '命名の心得',
            'body' => '命名はデータを基準に考える',
            'created_at' => now(),
            'updated_at' => now(),
            'user_id' => $users->random()->id,
            'category_id' => $categories->random()->id, // カテゴリをランダムに選択
        ]);
    }
}
