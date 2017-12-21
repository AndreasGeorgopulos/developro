<?php

namespace App\Http\Resources\Blog;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function($comment){
            return [
                'id' => $comment->id,
                'body' => $comment->body,
                'created_at' => (string) $comment->created_at,
                'updated_at' => (string) $comment->updated_at,
                'author' => new Author($comment->author)
            ];
        });
    }
}
