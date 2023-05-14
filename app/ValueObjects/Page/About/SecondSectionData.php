<?php

namespace App\ValueObjects\Page\About;

class SecondSectionData implements \JsonSerializable
{
    public function __construct(
        private readonly Title $title,
        private readonly Description $description,
        private readonly Image $image,
    )
    {
    }

    public function jsonSerialize(): array
    {
        return [
            'title' => $this->title->value,
            'description' => $this->description->value,
            'image' => $this->image->getFileOriginalName(),
        ];
    }
}
