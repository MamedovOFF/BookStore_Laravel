<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Transformers\BookTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Serializer\DataArraySerializer;
use League\Fractal\Serializer\JsonApiSerializer;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paginator = Book::paginate(2);
        $books = $paginator->getCollection();
        $res = fractal()
        ->collection($books)
        ->transformWith(new BookTransformer)
        ->withResourceName('book')
        ->parseIncludes('images')
        ->paginateWith(new IlluminatePaginatorAdapter($paginator));
        
        return $res;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        
        $image_path = $request->file('image')->store('images', 'public');

        $book = Book::create([
            'title' => $request->title,
        ]);

        $url = Storage::url($image_path);

        $book->images()->create([
            'image' => $image_path,
            'url' => $url
        ]);
    
        return response(201, 'Book created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::find($id);
        $res = fractal()->item($book)
        ->transformWith(new BookTransformer())
        ->withResourceName('book')
        ->parseIncludes('images');
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
