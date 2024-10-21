<?php

declare(strict_types=1);

namespace App\Notifications\Domain;

use Webmozart\Assert\Assert;

final readonly class Client
{
    public function __construct(public string $email, public string $phone)
    {
        $this->validate();
    }

    public function validate(): void
    {
        Assert::email($this->email, 'Email is not valid');
        Assert::regex($this->phone, '/^1\d{10}$/', 'Should be a valid phone number');
    }
}
