<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['url'];

    public $attributes = ['url', 'imageable_id', 'imageable_type'];

    //Relation polymorphic
    public function imageable()
    {
        return $this->morphTo();
    }
}
