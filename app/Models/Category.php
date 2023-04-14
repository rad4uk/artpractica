<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'parent_id',
        'slug',
        'title',
        'status',
        'description',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function parentRecursive()
    {
        return $this->parent()->with('parentRecursive');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }

    public function categoryImages()
    {
        return $this->hasMany(CategoryImage::class,'category_id','id')->with('image');
    }

    public function posts()
    {
        return $this
            ->hasMany(Post::class, 'category_id')
            ->where(['status' => 1])
            ->limit(20)
            ;
    }

}
