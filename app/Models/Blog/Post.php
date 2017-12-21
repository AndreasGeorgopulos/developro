<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['title', 'slug', 'body'];
    
    // author attribútum
    public function author () {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    
    // comments attribútum
    public function comments () {
        return $this->hasMany('App\Models\Blog\Comment', 'post_id', 'id');
    }
}
