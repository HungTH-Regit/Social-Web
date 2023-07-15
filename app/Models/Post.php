<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    protected $table = "posts";

    const STATUS_APPROVED = 1;

    const STATUS_NOT_APPROVED = 0;

    const STATUS_ALL_BLOG = 2;

    const LIMIT_BLOG_PAGE = 6;

    const LIMIT_BLOG_RELATED = 4;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'image',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id');
    }

    public function comments(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'comments', 'post_id', 'user_id');
    }

    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', Post::STATUS_APPROVED);
    }

    public function scopeNotApproved(Builder $query): Builder
    {
        return $query->where('status', Post::STATUS_NOT_APPROVED);
    }
}
