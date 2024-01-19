<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Follower;
use App\Models\User; // Add this line

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 有効なユーザーのidに置き換えてください
        $followingUserId = 1;
        $followingUser = User::find($followingUserId); // Add this line

        for ($i = 2; $i <= 10; $i++) {
            $followedUser = User::find($i);

            if ($followingUser && $followedUser) {
                Follower::create([
                    'following_id' => $followingUser->id,
                    'followed_id' => $followedUser->id,
                ]);
            }
        }
    }
}

