<?php

namespace App\Transformers;

use App\Models\Book;
use League\Fractal\TransformerAbstract;

class BookTransformer extends TransformerAbstract {

    protected array $availableIncludes  = [
        'images'
    ];

    public function transform(Book $book) {
        return [
            'id' => $book->id,
            'created_at' => $book->created_at,
            'updated_at' => $book->updated_at,
            'title' => $book->title,
            'author_id' => $book->author_id,
        ];
    }

    public function includeImages(Book $book)
    {
        $bookImage = $book->images;
        return $this->collection($bookImage, new ImagesTransformer, 'images');
    }

}