<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    protected $fillable = ['user_id', 'street_name', 'street_number', 'zip_code', 'complement'];

    public function user():BelongsTo {
        return $this->belongsTo(User::class);
    }
}
