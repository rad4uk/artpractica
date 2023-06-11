<?php

namespace App\ValueObjects\Page\Contact;

class Contact implements \JsonSerializable
{
    public function __construct(
        private readonly Address $address,
        private readonly Phone $phone,
        private readonly Email $email
    )
    {
    }

    public function jsonSerialize(): array
    {
        return [
            'address' => $this->address->value,
            'phone' => $this->phone->value,
            'email' => $this->email->value,
        ];
    }
}
