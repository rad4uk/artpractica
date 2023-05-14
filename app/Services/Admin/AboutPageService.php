<?php

namespace App\Services\Admin;

use App\ValueObjects\Page\About\AuthorDescription;
use App\ValueObjects\Page\About\AuthorName;
use App\ValueObjects\Page\About\Description;
use App\ValueObjects\Page\About\FirstSectionData;
use App\ValueObjects\Page\About\Image;
use App\ValueObjects\Page\About\SecondSectionData;
use App\ValueObjects\Page\About\ThirdSectionData;
use App\ValueObjects\Page\About\Title;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AboutPageService
{
    private string $filePath;

    public function __construct()
    {
        $this->filePath = config('files-path.pages.publicImagePath');
    }

    public function setFirstSectionData(array $data): FirstSectionData
    {
        $this->saveFile($data['image']);

        return new FirstSectionData(
            new AuthorName($data['authorName']),
            new AuthorDescription($data['authorDescription']),
            new Description($data['description']),
            new Image($data['image'])
        );
    }

    public function setSecondSectionData(array $data): SecondSectionData
    {
        $this->saveFile($data['image']);

        return new SecondSectionData(
            new Title($data['title']),
            new Description($data['description']),
            new Image($data['image'])
        );
    }

    public function setThirdSectionData(array $data): ThirdSectionData
    {
        return new ThirdSectionData(
          new Title($data['title']),
          new Description($data['description'])
        );
    }

    public function saveFile(UploadedFile $file): void
    {
        Storage::disk('public')->putFileAs(
            $this->filePath,
            $file,
            $file->getClientOriginalName()
        );
    }
}
