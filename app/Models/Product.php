<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Cast;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'details',
        'price',
        'image_path',
        'category_id',
        'brand_id',
    ];

    protected $casts = [
        'price' => 'double',
        'category_id' => 'integer',
        'brand_id' => 'integer',
    ];
}
