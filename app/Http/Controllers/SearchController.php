<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    // public function search(Request $request)
    // {
    //     $query = $request->input('query');

    //     $posts = Post::where('title', 'like', '%' . $query . '%')
    //                  ->orWhere('text', 'like', '%' . $query . '%')
    //                  ->get();

    //     $comments = Comment::where('author', 'like', '%' . $query . '%')
    //                         ->orWhere('text', 'like', '%' . $query . '%')
    //                         ->get();

    //     return view('posts.search_results', [
    //         'posts' => $posts,
    //         'comments' => $comments,
    //     ]);
    // }
    //     public function search(Request $request)
    // {
    //     $query = $request->input('query');

    //     $posts = Post::where('title', 'like', '%' . $query . '%')
    //                 ->orWhere('text', 'like', '%' . $query . '%')
    //                 ->with('comments')
    //                 ->get();

    //     return View::make('posts.search_results', compact('posts'));
    // }

    public function search(Request $request)
{
    $query = $request->input('query');

    $posts = Post::where('title', 'like', '%' . $query . '%')
                 ->orWhere('text', 'like', '%' . $query . '%')
                 ->orWhereHas('comments', function ($q) use ($query) {
                     $q->where('author', 'like', '%' . $query . '%');
                 })
                 ->get();

    $comments = Comment::where('author', 'like', '%' . $query . '%')
                        ->orWhere('text', 'like', '%' . $query . '%')
                        ->get();

    return view('posts.search_results', [
        'posts' => $posts,
        'comments' => $comments,
        'query' => $query,
    ]);
}
}
