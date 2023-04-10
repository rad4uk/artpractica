<?php

namespace App\Models;

use App\Traits\Models\HasThumbnail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public string $previewImagePath = '/storage/images/project/';

    use HasFactory;
    use HasThumbnail;

    protected $fillable = [
        'title',
        'description',
        'slug',
        'category_id',
        'status',
        'preview_image',
        'body'
    ];

    public function postImages()
    {
        return $this->hasMany(PostImage::class,'post_id','id')->with('image');
    }

//    public function getCategory()
//    {
//        return $this->belongsTo(Category::class);
//    }

    protected function thumbnailDir(): string
    {
        return 'size';
    }

    public function thumbnailColumn()
    {
        return 'preview_image';
    }
}
