<?php

namespace App\ValueObjects\Page\About;

class Title
{
    public function __construct(
        public string $value
    )
    {
    }
}
