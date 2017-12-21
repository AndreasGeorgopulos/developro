<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['body'];
    
    // author attribútum
    public function author () {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
