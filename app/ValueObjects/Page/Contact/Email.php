<?php

namespace App\ValueObjects\Page\Contact;

class Email
{
    public function __construct(
        public string $value
    )
    {
    }
}
