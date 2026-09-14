<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['category_id', 'image', 'title', 'content'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function likesDislikes()
    {
        return $this->hasMany(LikesDislike::class, 'post_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
