<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;


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

Route::get('/posts/{post}', [PostsController::class,'show']);
Route::post('/posts',[PostsController::class,'store']);
Route::post('/posts/{post}/comments',[CommentsController::class,'store']);
Route::delete('/comments/{comment}',[CommentsController::class,'destroy']);