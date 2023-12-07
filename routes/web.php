<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\SearchController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[PostsController::class,'index'] );
Route::get('/posts/new',[PostsController::class,'create']);

Route::get('/posts/{post}', [PostsController::class,'show'])->name('posts.show');
Route::post('/posts',[PostsController::class,'store'])->middleware('auth');
Route::post('/posts/{post}/comments',[CommentsController::class,'store']);
Route::delete('/comments/{comment}',[CommentsController::class,'destroy'])->middleware('auth');
Route::get('/search', [SearchController::class, 'search'])->name('search');

// Route::put('/posts/{post}', [PostsController::class, 'update'])->middleware('auth');
// returns the form for editing a post
Route::get('/posts/{post}/edit', [PostsController::class , 'edit'])->name('posts.edit');
// updates a post
Route::put('/posts/{post}', [PostsController::class ,'update'])->name('posts.update');


Route::delete('/posts/{post}', [PostsController::class, 'destroy'])->name('posts.destroy')->middleware('auth');


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

require __DIR__.'/auth.php';



