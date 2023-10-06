<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Fractal\Manager;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::paginate(15);
        $result = [
            'paginate' => [
                // 'current_page' => $books->current_page,
                // 'last_page' => $books->last_page
            ]
        ];
        print($books);

        foreach ($books as $book) {
            array_push($result, [
                'book' => $book,
                'images' => Book::find($book->id)->images,
            ]);
        }
        return $books;
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
    
        
        return response()->json([
            'message' => 'Book created successfully',
            'book' => $book,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $book = Book::find($id);
        $book = new Manager();
        return response()->json([
            'book' => $book,
            'images' => Book::find($id)->images,
        ]);
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
