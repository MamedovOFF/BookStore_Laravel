<?php

namespace App\Transformers;

use App\Models\BookImage;
use League\Fractal\TransformerAbstract;

class ImagesTransformer extends TransformerAbstract {

    public function transform(BookImage $bookImage):array {
        return [
            'id' => $bookImage->id,
            'url' => $bookImage->url,
        ];
    }
}