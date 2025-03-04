<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'content', 'image_url', 'status', 'scheduled_at', 'published_at'];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'published_at' => 'datetime',
        'status' => PostStatus::class, // use Enum for status
    ];

    protected $attributes = [
        'status' => PostStatus::Draft, // default status: draft
    ];

    /**
     * Relasi: Post owned by user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope: Filter post based on the ownership
     */
    public function scopeOwnedBy(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope for published posts
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', PostStatus::Published->value)
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now())
                     ->latest(); 
    }

    /**
     * Mutator & Accessor: Ensure status is always cast to PostStatus enum
     */
    protected function status(): Attribute
    {
        return Attribute::get(
            fn ($value) => PostStatus::tryFrom($value) ?? PostStatus::Draft,
            fn ($value) => $value->value
        );
    }

    /**
     * Check whether the post has been published
     */
    public function isPublished(): bool
    {
        return $this->status === PostStatus::Published;
    }
}
