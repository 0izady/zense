<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PostController;
use App\Models\History;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        $historys = History::where('user_id', Auth::id())->get();
    }else {
        $historys = ["برای تاریخچه جستوجو باید اول وارد سایت بشی"];
    }

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        "historys" => $historys
    ]);
})->name('home');

Route::get('/',[\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::get('/contact', function () {
    return Inertia::render('Contact');
});
Route::get('/docs', function () {
    return Inertia::render('Docs');
});

Route::get('/search/{key_word}', [SearchController::class, 'show'])->name('search');
Route::get('/top', [SearchController::class, 'top'])->name('top');
Route::post('/like', [SearchController::class, 'like'])->name('like');



Route::get('/create', [PostController::class, 'create'])->middleware('auth')->name('create');
Route::post('/create/{key_word}', [PostController::class, 'complate'])->middleware('auth')->name('complate');
Route::post('/store', [PostController::class, 'store'])->middleware('auth')->name('post.store');
Route::get('/post/{title}', [PostController::class, 'show'])->name('post.show');
Route::get('/top_posts', [PostController::class, 'top'])->name('post.top');
Route::get('/edit/{title}', [PostController::class, 'edit'])->name('post.edit');
Route::patch('/update/{id}', [PostController::class, 'update'])->name('post.update');

Route::post('/update/{id}', [PostController::class, 'update'])->name('post.update');
Route::delete('/delete/{id}', [PostController::class, 'destroy'])->name('post.delete');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::post('/profile', [ProfileController::class, 'upload'])->name('profile.upload');
});

require __DIR__.'/auth.php';
