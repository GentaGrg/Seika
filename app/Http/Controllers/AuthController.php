<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email','password');
        
        if (Auth::attempt($credentials)) {
           $request->session()->regenerate();
           
           return redirect('dashboard')->with('login_sucess','ログイン成功しました！');
    }
    
    return back()->withErrors([
        'login_error' => 'メールアドレスが間違っています.',
        ]);
    }
}

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // ユーザー登録処理を実装
    }

    /**
     * @param string $provider
     * @return \Illuminate\Http\Response
     *
     * @Route("/sns-login/{provider}", name="sns.login")
     */
   