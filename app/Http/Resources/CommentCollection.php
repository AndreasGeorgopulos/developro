<?php

namespace App\Http\Resources;

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
        return [
            'data' => $this->collection->transform(function($page){
                return [
                    'id' => $page->id,
                    'body' => $page->body,
                    'created_at' => (string) $page->created_at,
                    'updated_at' => (string) $page->updated_at,
                    'author' => $page->author
                ];
            }),
        ];
    }
}
