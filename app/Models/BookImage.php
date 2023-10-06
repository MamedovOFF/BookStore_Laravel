<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'url',
        'book_id'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
