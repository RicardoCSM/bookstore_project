<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'isbn_13', 'num_pages', 'publication_date', 'publisher_id', 'price'];

    public function publisher(): BelongsTo {
        return $this->belongsTo(Publisher::class);
    }

    public function authors(): BelongsToMany {
        return $this->belongsToMany(Author::class);
    }

    public function images(): HasMany {
        return $this->hasMany(BookImage::class);
    }
}
