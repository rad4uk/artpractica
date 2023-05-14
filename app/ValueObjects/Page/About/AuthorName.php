<?php

namespace App\ValueObjects\Page\About;

class AuthorName
{
    public function __construct(
        public string $value
    )
    {
    }

}
