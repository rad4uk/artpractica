<?php
namespace App\ValueObjects\Page\About;

class FirstSectionData implements \JsonSerializable
{
    public function __construct(
        private readonly AuthorName $authorName,
        private readonly AuthorDescription $authorDescription,
        private readonly Description $description,
        private readonly Image $image,
    )
    {
    }

    public function jsonSerialize(): array
    {
        return [
            'authorName' => $this->authorName->value,
            'authorDescription' => $this->authorDescription->value,
            'description' => $this->description->value,
            'image' => $this->image->getFileOriginalName(),
        ];
    }
}
