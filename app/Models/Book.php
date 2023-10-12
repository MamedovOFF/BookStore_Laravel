<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author_id',
        'price',
        'ISBN',
        'amount',
        'description'
    ];

    public function images() {
        return $this->hasMany(BookImage::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
