<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorsArticleRequest;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\MyFacade\StoreFacade;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        $articles->map(function ($article) {
            $authors = $article->authors;
            foreach ($authors as $author) {
                $author->makeHidden('pivot');
            }
            $article->setAttribute('authors', $authors);
            return $article;
        });
        return response()->json([
            'articles' => $articles
        ]);
    }
    public function store(StoreArticleRequest $request)
    {
        $article = Article::query()->create([
            'title' => $request->title,
            'body' => $request->body,
            // please check Myfacade Folder and MyService Folder
            'image' =>  $request->hasFile('image') ? StoreFacade::StoreImage($request->file('image'))  : null
        ]);
        $article->authors()->attach($request->authors);
        return response()->json([
            'message' => 'article created successfully',
            'article' => $article
        ]);
    }
    public function show(Article $article)
    {
        $authors = $article->authors;
        $authors->map(function ($author) {
            $author->makeHidden('pivot');
            return $author;
        });
        return response()->json([
            'article' => $article,
            'authors' => $authors
        ]);
    }
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $article->title = $request->has('title') ? $request->title : $article->title;
        $article->body = $request->has('body') ? $request->body : $article->body;
        if ($request->hasFile('image')) {
            // please check MyService and MyFacade folders
            StoreFacade::delete($article->image);
            $article->image = StoreFacade::StoreImage($request->file('image'));
        }
        if ($article->save()) {
            return response()->json([
                'message' => 'article updated successfully',
                'article' => $article
            ]);
        } else {
            return response()->json([
                'message' => 'Error occured'
            ], 500);
        }
    }
    public function delete(Article $article)
    {
        // please check MyService and MyFacade folders
        StoreFacade::delete($article->image);
        if ($article->delete()) {
            return response()->json([
                'message' => 'article deleted successfully'
            ]);
        } else {
            return response()->json([
                'Error occurred'
            ], 500);
        }
    }
    public function AttchAuthour(AuthorsArticleRequest $request, Article $article)
    {

        $article->authors()->attach($request->authors);
        return response()->json([
            'message' => 'authors attached successfully'
        ]);
    }
    public function DetachAuthor(Request $request, Article $article)
    {
        $article->authors()->detach($request->authors);
        return response()->json([
            'message' => 'removed the authors to this article done successfully'
        ]);
    }
    public function ShowAuthors(Article $article)
    {
        $authors = $article->authors;
        foreach($authors as &$author)
        {
            $author->makeHidden('pivot');
        }
        return response()->json([
            'authors' => $authors
        ]);
    }
}
