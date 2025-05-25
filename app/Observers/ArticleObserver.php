<?php
namespace App\Observers;

use App\Models\Article;
use Illuminate\Support\Str;

class ArticleObserver
{
    public function creating(Article $article): void
    {
        if (empty($article->slug)) {
            $article->slug = Str::slug($article->title);
        }
    }

    public function updating(Article $article): void
    {
        if ($article->isDirty('title') && empty($article->slug)) {
            $article->slug = Str::slug($article->title);
        }
    }
}
