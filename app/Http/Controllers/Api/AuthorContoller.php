<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Transformers\AuthorTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Fractal\Serializer\JsonApiSerializer;

class AuthorContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all();

        return response()->json($authors, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'name' => 'required|string',
            'birth' => 'required|integer',
            'city' => 'required|string',
            'about' => 'required|string',
        ]);

        $image_path = $request->file('avatar')->store('images', 'public');
        
        $url = Storage::url($image_path);

        $author = Author::create([
            'name' => $request->name,
            'birth' => $request->birth,
            'city' => $request->city,
            'about' => $request->about,
            'avatar'=> $url
        ]);

        return response()->json([
            'message' => 'Author created successfully',
            'user' => $author
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $author = Author::find($id);
    
        $res = fractal()->item($author)
        ->transformWith(new AuthorTransformer())
        ->withResourceName('author')
        ->serializeWith(new JsonApiSerializer())
        ->parseIncludes(/* 'books' */ '');

        return $res;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
