<?php
namespace App\ValueObjects\Page\Contact;

class Address
{
    public function __construct(
        public string $value
    )
    {
    }
}
