<?php

namespace App\Models;

use App\Traits\Models\HasThumbnail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public string $dirImagePath;

    use HasFactory, HasThumbnail;

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
        'meta_title',
        'meta_description',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->dirImagePath = config('files-path.categories.storageImagePath');
    }

    public function getDirPath(): string
    {
        return asset($this->dirImagePath);
    }

    public function getFilePath(string $fileName): string
    {
        return asset($this->dirImagePath . $fileName);
    }

    public function parent(): belongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function parentRecursive()
    {
        return $this->parent()->with('parentRecursive');
    }

    public function children(): HasMany
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
            ->orderBy('category_sort', 'ASC')
            ->limit(20)
            ;
    }

    public function jsonSerialize(): array
    {
        return array_merge(
            $this->toArray(),
            [
                'dirImagePath' => $this->getDirPath(),
                'fullSlug' => $this->id === 1 ? route('portfolio') : route('categories', $this->slug)
            ]
        );
    }

    protected function thumbnailDir(): string
    {
        return str_replace('/storage/images/','', rtrim($this->dirImagePath, DIRECTORY_SEPARATOR));
    }
}
