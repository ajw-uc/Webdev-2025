<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'content',
        'article_category_id'
    ];

    function comments(): HasMany
    {
        return $this->hasMany(ArticleComment::class);
    }

    // function article_category(): BelongsTo
    // {
    //     return $this->belongsTo(ArticleCategory::class);
    // }

    function category(): BelongsTo
    {
        // wajib mengisi foreign key karena nama methodnya beda dengan nama field di database
        return $this->belongsTo(ArticleCategory::class, 'article_category_id');
    }
}
