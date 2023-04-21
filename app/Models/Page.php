<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public string $dirPath;

    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'slug',
        'first_section_data',
        'second_section_data',
        'sliders_data',
        'meta_title',
        'meta_description',
        'created_at',
        'updated_at',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->dirPath = config('files-path.homePage.storageImagePath');
    }

    public function getDirPath(): string
    {
        return asset($this->dirPath);
    }

    public function getFilePath(string $fileName): string
    {
        return asset($this->dirPath . $fileName);
    }

    public function categories(int $limit = 4)
    {
        return $this->hasMany(Category::class)->orderBy('page_sort', 'ASC')->limit($limit);
    }

    public function services(int $limit = 3)
    {
        return $this->hasMany(Service::class)->orderBy('page_sort', 'ASC')->limit($limit);
    }
}
