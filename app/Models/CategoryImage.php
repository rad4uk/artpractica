<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CategoryImage extends Image
{
    use HasFactory;

    protected $table = 'category_image';

    public $fillable = [
        'category_id',
        'image_id',
        'created_at',
        'updated_at'
    ];

    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }
}
