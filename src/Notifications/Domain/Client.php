<?php
declare(strict_types=1);

namespace App\Notifications\Domain;

final readonly class Client
{
    public function __construct(public string $email, public string $phone)
    {
    }
}