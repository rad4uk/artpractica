<?php

namespace App\ValueObjects\Page\About;

class AuthorDescription
{
    public function __construct(
        public string $value
    )
    {
    }
}
