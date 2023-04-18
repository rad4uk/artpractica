<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'slug',
        'created_at',
        'updated_at',
    ];

    public function categories(int $limit = 4)
    {
        return $this->hasMany(Category::class)->limit($limit);
    }
}
