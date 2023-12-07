<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use App\Http\Requests\PostsRequest;
use Illuminate\Http\RedirectResponse;

class PostsController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latest()->get(),
        ]);
    }

    public function show(Post $post): View
    {
        return view('posts.show', [
            'post' => $post,
            'comments' => $post->comments()->paginate(5)
        ]);
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function store(PostsRequest $request)
    {
        $data = $request->validated();

        $post = new Post();
        $post->title = $data['title'];
        $post->text  = $data['text'];
        $hashtags = $this->extractHashtags($data['text']);
        if (!empty($hashtags)) {
            $post->hashtags = implode(',', $hashtags);
        }
        // $post->hashtags = implode(',', $hashtags);
        
        $post->save();

        return redirect('/posts/'.$post->id);
    }
    private function extractHashtags($text)
    {
        preg_match_all('/#(\w+)/', $text, $matches);
        return $matches[1] ?? [];
    }

//     public function update(Post $request, $id)
// {
//     $post = Post::findOrFail($id);
//     $post->title = $request->input('title');
//     $post->text = $request->input('text');
//     // Add other fields here...

//     $post->save();

//    // return redirect()->route('posts.show', $post->id)->with('success', 'Post updated successfully');
//    return view('posts.update');
// }

public function update(PostsRequest $request, $id)
  {
    
    $post = Post::find($id);
    $post->update($request->all());
    return redirect()->route('posts.show', $post->id)
      ->with('success', 'Post updated successfully.');
  }
  public function edit($id)
  {
    $post = Post::find($id);
    return view('posts.edit', compact('post'));
  }
    // public function destroy($id)
    // {
    //     $post = Post::findOrFail($id);
    //     $post->delete();

    //     return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    // }


    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        return back();
    }
}