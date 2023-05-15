<?php

namespace App\Models;

use App\Traits\Models\HasThumbnail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    public string $previewImagePath;

    use HasFactory, HasThumbnail;

    protected $fillable = [
        'title',
        'description',
        'square',
        'slug',
        'category_id',
        'status',
        'preview_image',
        'apartment_images',
        'body',
        'meta_title',
        'meta_description',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->previewImagePath = config('files-path.project.storageImagePath');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function additionalPostsToMany()
    {
        return $this->belongsToMany(Post::class, 'posts_posts', 'post_source', 'post_target');
    }

    public function getFullImagePath(string $imageName): string
    {
        return asset($this->previewImagePath . $imageName);
    }

    public function getDirPath(): string
    {
        return asset($this->previewImagePath);
    }


//    public function getCategory()
//    {
//        return $this->belongsTo(Category::class);
//    }

    protected function thumbnailDir(): string
    {
        return str_replace('/storage/images/','', rtrim($this->previewImagePath, DIRECTORY_SEPARATOR));
    }

    public function thumbnailColumn()
    {
        return 'preview_image';
    }

    public function jsonSerialize(): mixed
    {
        return array_merge(
            $this->toArray(),
            [
                'preview_image' => [
                    'default' => asset($this->getFullImagePath($this->preview_image)),
                    'small' => $this->makeThumbnail($this->preview_image, config('thumbnail.project_sizes.small')),
                    'medium' => $this->makeThumbnail($this->preview_image, config('thumbnail.project_sizes.medium')),
                    'large' => $this->makeThumbnail($this->preview_image, config('thumbnail.project_sizes.large')),
                    'big' => $this->makeThumbnail($this->preview_image, config('thumbnail.project_sizes.big')),
                ],
                'route' => route('projects', $this->slug),

            ]
        );
    }
}
