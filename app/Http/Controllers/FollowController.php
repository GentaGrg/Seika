<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;    

class FollowController extends Controller
{
    public function store($userId)
    {
        $userToFollow = User::find($userId);

        if (!$userToFollow) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        $follower = auth()->user();

        if ($follower->isFollowing($userToFollow)) {
            $follower->unfollow($userToFollow);
            return response()->json(['success' => true, 'message' => 'Unfollowed successfully']);
        } else {
            $follower->follow($userToFollow);
            return response()->json(['success' => true, 'message' => 'Followed successfully']);
        }
    }
}
