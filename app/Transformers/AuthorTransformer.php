<?php

namespace App\Transformers;

use App\Models\Author;
use League\Fractal\TransformerAbstract;

class AuthorTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        'books'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Author $author)
    {
        return [
            'id' => $author->id,
            "avatar" => $author->avatar,
            "name" => $author->name,
            "birth" => $author->birth,
            "city" => $author->city,
            "about" => $author->about,
            'created_at' => $author->created_at,
            'updated_at' => $author->updated_at,
        ];

    }

    public function includeBooks(Author $author) {
        $book = $author->books;
        return $this->collection($book, new BookTransformer(), 'books');
    }
}
