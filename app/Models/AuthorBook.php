<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AuthorBook extends Model
{
    use HasFactory;
    protected $table = 'author_book';

    protected $fillable = ['book_id', 'author_id'];

    public function author(): HasOne {
        return $this->hasOne(Author::class, 'id', 'author_id');
    }

    public function book(): HasOne {
        return $this->hasOne(Book::class, 'id', 'book_id');
    }
}
