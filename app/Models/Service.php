<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public string $dirImagePath = '/storage/images/services/';

    use HasFactory;

    protected $guarded = [];

    public function getDirPath(): string
    {
        return asset($this->dirImagePath);
    }

    public function getFilePath(string $fileName): string
    {
        return asset($this->dirImagePath . $fileName);
    }
}
