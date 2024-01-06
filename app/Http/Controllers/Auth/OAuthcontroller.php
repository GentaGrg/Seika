<?php

// app/Http/Controllers/Auth/OAuthController.php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    // OAuthプロバイダへのリダイレクト
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // OAuthプロバイダからのコールバック処理
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        // ここでユーザーの情報を取得して処理する

        return redirect('/'); // ログイン後のリダイレクト先を指定
    }
}
