<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    protected $fillable = ['user_id', 'title', 'content', 'image_url', 'status', 'scheduled_at', 'published_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
