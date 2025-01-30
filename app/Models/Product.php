<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    // one-to-one relationship
    public function user_id(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function image_id(): HasOne {
        return $this->hasOne(Image::class, 'image_id', 'imageable_id');
    }
}
