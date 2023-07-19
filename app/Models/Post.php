<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function scopeSearch($query,  $search)
    {
        return $query->where('posts.title', 'LIKE', '%' . $search . '%')
            ->orWhere('posts.description', 'LIKE', '%' .  $search . '%')
            ->orWhere('posts.pubDate', 'LIKE', '%' .  $search . '%')
            ->orWhere('categories.title', 'LIKE', '%' .  $search . '%')
            ->orWhere('categories.description', 'LIKE', '%' .  $search . '%');
    }
}
