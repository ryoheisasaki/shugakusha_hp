<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model{
    protected $fillable = [
        'title',
        'image',
        'price',
        'size',
        'pages',
        'description',
        'is_published',
        'width',
        'height',
        'depth',
        'weight',
    ];
}
