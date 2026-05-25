<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'content'
    ];

    function comments(): HasMany
    {
        return $this->hasMany(ArticleComment::class);
    }
}
