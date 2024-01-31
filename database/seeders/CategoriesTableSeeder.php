<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        // 初期データの挿入
        DB::table('categories')->insert([
            ['name' => '大学の課題'],
            ['name' => '日ごろの悩み'],
            ['name' => '就活のアドバイス'],
        ]);
    }
}
