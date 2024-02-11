<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'user_id',
        'post_id',
        'best_answer', // ベストアンサーを示すためのカラムを追加
    ];

    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function isBestAnswer()
    {
        return $this->best_answer; // カラムの値を返すだけに変更
    }

    public function markAsBestAnswer()
    {
        // ベストアンサーとしてマークするためのロジックをここに追加
        // 例えば、best_answer カラムを true に設定するなど
        $this->best_answer = true;
        $this->save(); // 保存を忘れないように

        // 必要に応じて他の処理を追加
    }
}
