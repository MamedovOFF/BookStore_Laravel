<?php

namespace App\Transformers;

use App\Models\Book;
use League\Fractal\TransformerAbstract;

class BookTransformer extends TransformerAbstract {

    protected array $availableIncludes  = [

    ];

    protected array $defaultIncludes = [
        'images'
    ];

    public function transform(Book $book) {
        return [
            'id' => $book->id,
            'created_at' => $book->created_at,
            'updated_at' => $book->updated_at,
            'title' => $book->title,
            'description' => $book->description,
            'author_id' => $book->author_id,
            'type' => $book->type,
            'price' => $book->price,
            'ISBN' => $book->ISBN,
            'amount' => $book->amount,
        ];
    }

    public function includeImages(Book $book)
    {
        $bookImage = $book->images;
        return $this->collection($bookImage, new ImagesTransformer, 'images');
    }

}