<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\MyPostsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

// ログイン
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// ユーザー登録
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

// PostControllerの各アクションに対するルートを個別に定義
Route::middleware(['auth'])->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::post('/posts', [PostController::class, 'store'])->name('store');
    Route::get('/posts/create', [PostController::class, 'create'])->name('create');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('show');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('update');
    Route::delete('/posts/{post}', [PostController::class, 'delete'])->name('delete');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('edit');
    Route::get('/myposts', [MyPostsController::class, 'index'])->name('myposts');
    Route::post('/your-upload-action', [PostController::class, 'uploadAction'])->name('your_upload_action');
    Route::get('/category-posts/{categoryId}', [PostController::class, 'showCategoryPosts'])->name('showCategoryPosts');
    Route::get('/some-route', 'PostController@index');
    Route::post('/like/{postId}', 'PostController@likePost')->name('like.post');
    Route::post('/comment/{postId}', 'PostController@commentPost')->name('comment.post');

    // MyPageControllerのマイページ表示アクション
    Route::get('/mypage', [MyPageController::class, 'index'])->name('mypage');
});

// CategoryControllerのカテゴリ表示アクション
Route::get('/categories/{category}', [CategoryController::class, 'index'])->middleware("auth");

Route::middleware('auth')->group(function () {
    // ProfileControllerのプロフィール編集アクション
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', 'ProfileController@destroy')->name('profile.destroy');
    Route::put('/updateUserDetails', [UserController::class, 'updateUserDetails'])->name('updateUserDetails');
    Route::get('/editUserDetails', [UserController::class, 'editUserDetails'])->name('editUserDetails');
});

require __DIR__.'/auth.php';
