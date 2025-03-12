<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'name',
        'title',
        'subtitle',
        'logo',
        'video',
        'phone',
        'extract',
        'executives',
        'social_links',
        'phone',
        'email',
        'image',
        'description',
    ];

    protected $casts = [
        'executives' => 'array',// Convierte el JSON en un array
        'social_links' => 'array', // Convierte el JSON en un array
    ];
}
