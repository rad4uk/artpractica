<?php

namespace App\ValueObjects;

class ServiceTemplateJson implements \JsonSerializable
{
    public function __construct(
        private readonly array $items
    )
    {
    }

    public function jsonSerialize(): array
    {
        return $this->items;
    }
}
