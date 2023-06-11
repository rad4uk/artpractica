<?php

namespace App\ValueObjects\Page\Contact;

class Phone
{
    public function __construct(
        public string $value
    )
    {
    }
}
