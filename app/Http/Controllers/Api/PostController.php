<?php

namespace App\Http\Controllers\Api;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PostCollection;
use App\Http\Resources\Post as PostResource;

class PostController extends Controller
{
    // GET /posts
    public function index()
    {
        return new PostCollection(Post::paginate(config('developro.paginator.posts')));
    }

    // GET /posts/{post}
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    // POST /posts
    public function create(Request $request)
    {
        return $this->save($request, new Post());
    }

    // PUT /posts/{post}
    public function update(Request $request, Post $post)
    {
        return $this->save($request, $post);
    }

    // DELETE /posts/{post}
    public function delete(Post $post)
    {
        $post->delete();
        return response()->json(null, 204);
    }

    private function save (Request $request, Post $post) {
        $v = Validator::make($request->all(), $this->getRules());
        if ($v->fails()) {
            return response()->json($v->messages(), 500);
        }

        $post->title = $request->get('title');
        $post->body = $request->get('body');
        $post->save();

        return response()->json($post, 201);
    }

    private function getRules () {
        return [
            'title' => 'required|min:3|max:100',
            'body' => 'required'
        ];
    }
}
