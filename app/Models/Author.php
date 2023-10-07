<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'email', 'country'
    ];
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'articles_authors', 'author_id', 'article_id', 'id', 'id');
    }
}
