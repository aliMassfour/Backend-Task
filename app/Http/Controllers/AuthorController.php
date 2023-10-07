<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        return response()->json([
            'authors' => $authors
        ]);
    }
    public function show(Author $author)
    {
        return response()->json([
            'author' => $author
        ]);
    }
    public function store(StoreAuthorRequest $request)
    {
        if (Author::where('email', $request->email)->exists()) {
            return response()->json([
                'message' => 'Validation errors',
                'error' => ['Email' => 'this authors email is created before ']
            ]);
        }
        $author = Author::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'country' => $request->country
        ]);
        return response()->json([
            'message' => 'author created successfully',
            'author' => $author
        ]);
    }
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        $author->name = $request->has('name') ? $request->name : $author->name;
        $author->email = $request->has('email') ? $request->email : $author->email;
        $author->country = $request->has('country') ? $request->country : $author->country;
        if ($author->save()) {
            return response()->json([
                'message' => 'authors information updated successfully',
                'author' => $author
            ]);
        } else {
            return response()->json([
                'message' => 'Error occured',

            ], 500);
        }
    }
    public function delete(Author $author)
    {
        if ($author->delete()) {
            return response()->json([
                'message' => 'author deleted successfully'
            ]);
        } else {
            return response()->json([
                'message' => 'Error Occured'
            ], 500);
        }
    }
}
