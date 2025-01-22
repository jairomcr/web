<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //Reverse relation one to many
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //Relation many to many
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    //Relation one to one polymorphic
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}