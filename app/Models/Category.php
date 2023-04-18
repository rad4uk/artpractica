<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public string $dirImagePath = '/storage/images/categories/';

    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'parent_id',
        'slug',
        'title',
        'status',
        'description',
        'page_image',
        'page_id',
        'page_sort',
    ];

    public function getDirPath(): string
    {
        return asset($this->dirImagePath);
    }

    public function getFilePath(string $fileName): string
    {
        return asset($this->dirImagePath . $fileName);
    }

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

    public function posts()
    {
        return $this
            ->hasMany(Post::class, 'category_id')
            ->where(['status' => 1])
            ->limit(20)
            ;
    }

}
