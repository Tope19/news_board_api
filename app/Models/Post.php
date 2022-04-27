<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'link',
        'creation_date',
        'upvotes',
        'author_name',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
