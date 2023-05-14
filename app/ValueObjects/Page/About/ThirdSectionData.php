<?php

namespace App\ValueObjects\Page\About;

class ThirdSectionData implements \JsonSerializable
{
    public function __construct(
        private readonly Title $title,
        private readonly Description $description
    )
    {
    }


    public function jsonSerialize(): array
    {
        return [
          'title' => $this->title->value,
          'description' => $this->description->value
        ];
    }
}
