<?php

namespace App\Models;

use App\Traits\Models\HasThumbnail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    use HasThumbnail;

    protected $fillable = [
        'alt',
        'path',
    ];


//    public function page()
//    {
//        return $this->belongsTo(Page::class);
//    }

    public function pageImages(){
        return $this->hasMany(PageImage::class,'id','image_id');
    }

    protected function thumbnailDir(): string
    {
        return 'size';
    }

    public function thumbnailColumn()
    {
        return 'path';
    }
}
