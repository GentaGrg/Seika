<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bio',
        'avatar', // 例: ユーザーのプロフィール画像のパスを格納するフィールド
    ];

    // Userとのリレーションを定義
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
