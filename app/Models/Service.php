<?php

namespace App\Models;

use App\Traits\Models\HasThumbnail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public string $dirImagePath;

    use HasFactory, HasThumbnail;

    protected $guarded = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->dirImagePath = config('files-path.services.storageImagePath');
    }

    public function getDirPath(): string
    {
        return asset($this->dirImagePath);
    }

    public function getFilePath(string $fileName): string
    {
        return asset($this->dirImagePath . $fileName);
    }

    protected function thumbnailDir(): string
    {
        return str_replace('/storage/images/','', rtrim($this->dirImagePath, DIRECTORY_SEPARATOR));
    }
}
