<?php
declare(strict_types=1);

namespace App\Clients\Domain\ValueObject;

use Webmozart\Assert\Assert;

final readonly class Contacts
{
    public function __construct(public string $email, public string $phone)
    {
        $this->validate();
    }

    public function email(): string
    {
        return $this->email;
    }

    public function phone(): string
    {
        return $this->phone;
    }

    private function validate(): void
    {
        Assert::email($this->email, 'Should be a valid email address');
        Assert::regex($this->phone, '/^1\d{10}$/', 'Should be a valid phone number');
    }
}