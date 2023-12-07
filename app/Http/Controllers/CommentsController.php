<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentsRequest;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;

class CommentsController extends Controller
{
    public function store(Post $post, CommentsRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $comment = new Comment();

        $comment->post_id = $post->id;
        $comment->author = $data['author'];
        $comment->text = $data['text'];

        $hashtags = $this->extractHashtags($data['text']);
        if (!empty($hashtags)) {
            $comment->hashtags = implode(',', $hashtags);
        }
        $comment->save();

        return back();

    }
    
    private function extractHashtags($text)
    {
        preg_match_all('/#(\w+)/', $text, $matches);
        return $matches[1] ?? [];
    }

    public function destroy(Comment $comment): RedirectResponse
    {
        $comment->delete();
        return back();
    }
}
