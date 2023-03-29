<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Parental\HasParent;

class PageImage extends Model
{
    use HasFactory;

    protected $table = 'page_image';
//    use HasParent;

//    public function page()
//    {
//        return $this->belongsTo(Page::class,'object_id','id');
//    }

    public function image(){
        return $this->hasOne(Image::class,'id','image_id');
    }

}
