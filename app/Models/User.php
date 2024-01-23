<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'screen_name',
        'profile_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // カテゴリリレーション
    public function category()
    {
        return $this->hasMany(Category::class);
    }

    // 詳細情報が登録されているかどうかを確認するメソッド
    public function detailsAreRegistered()
    {
        return !empty($this->name) && !empty($this->email) && !empty($this->password);
    }

    public function following()
    {
        return $this->belongsToMany(self::class, 'followers', 'following_id', 'followed_id');
    }
    
    public function followers()
    {
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'following_id');
    }
    
    public function isFollowing(User $user)
    {
        return $this->following()->where('followed_id', $user->id)->exists();
    }
    
    public function isFollowed($userId): bool
    {
        return $this->followers()->where('following_id', $userId)->exists();
    }

    // フォロー解除
    public function unfollow(User $user)
    {
        // フォローしているか
        $is_following = $this->isFollowing($user->id);

        if ($is_following) {
            // フォローしていればフォローを解除する
            $this->following()->detach($user->id);
            return back()->with('success', 'ユーザーのフォローを解除しました。');
        }

        return back()->with('info', 'フォローしていないユーザーです。');
    }
    
    public function savedPosts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'saved_posts', 'user_id', 'post_id')->withTimestamps();
    }
    
    public function hasSavedPost($postId): bool
    {
        return $this->savedPosts()->where('post_id', $postId)->exists();
    }
}
