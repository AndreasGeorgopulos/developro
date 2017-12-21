<?php

namespace App\Http\Controllers\Api\Blog;

use App\Models\Blog\Comment;
use App\Models\Blog\Post;
use App\Http\Controllers\Controller;
use App\Http\Resources\Blog\CommentCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // GET /posts/{post}/comments
    public function index(Post $post)
    {
        return new CommentCollection($post->comments()->paginate(config('developro.paginator.comments')));
    }

    // POST /posts/{post}/comments
    public function create(Request $request, Post $post)
    {
        $v = Validator::make($request->all(), $this->getRules());
        if ($v->fails()) {
            return response()->json($v->messages(), 500);
        }

        $comment = new Comment();
        $comment->body = $request->get('body');
        $comment->post_id = $post->id;
        if (!$comment->user_id) $comment->user_id = Auth::user()->id;
        $comment->save();

        return response()->json($comment, 201);
    }

    // DELETE /posts/{post}/comments/{comment}
    public function delete(Post $post, Comment $comment)
    {
        $comment->delete();
        return response()->json(null, 204);
    }

    private function getRules () {
        return [
            'body' => 'required'
        ];
    }
}
