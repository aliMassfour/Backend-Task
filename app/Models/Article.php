<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable =[
        'title' ,
        'body' ,
        'image'
    ];
    public function authors()
    {
        return $this->belongsToMany(Author::class,'articles_authors','article_id','author_id','id','id');
    }
}
