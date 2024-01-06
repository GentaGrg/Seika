<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MyPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controller\MyPostsController;
use App\Http\Controller\AuthController;
use App\Http\Controller\Auth\OAuthController;

//ログイン
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

//ユーザー登録
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

// PostControllerの各アクションに対するルートを個別に定義
Route::middleware(['auth'])->group(function(){
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::post('/posts', [PostController::class, 'store'])->name('store');
    Route::get('/posts/create', [PostController::class, 'create'])->name('create');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('show');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('update');
    Route::delete('/posts/{post}', [PostController::class,'delete']);
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('edit');
    Route::get('/myposts', [MyPostsController::class, 'index'])->name('myposts');
    Route::get('/myposts', [PostController::class, 'myPosts'])->name('myposts');
    Route::post('/your-upload-action', 'YourController@uploadAction')->name('your_upload_action');

    // MyPageControllerのマイページ表示アクション
    Route::get('/mypage', [MyPageController::class, 'index'])->name('mypage');
});

// CategoryControllerのカテゴリ表示アクション
Route::get('/categories/{category}', [CategoryController::class, 'index'])->middleware("auth");

Route::middleware('auth')->group(function () {
    // ProfileControllerのプロフィール編集アクション
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/', 'PostController@deleteMethod')->name('delete.route');
});

Route::get('/oauth/{provider}', [OAuthController::class, 'redirectToProvider'])->name('oauth.redirect');
Route::get('/oauth/{provider}/callback', [OAuthController::class, 'handleProviderCallback']);

require __DIR__.'/auth.php';
