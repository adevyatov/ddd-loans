<?php
declare(strict_types=1);

namespace App\Clients\Domain\ValueObject;

use Webmozart\Assert\Assert;

final readonly class Name
{
    private string $firstName;

    private string $lastName;

    public function __construct(string $firstName, string $lastName)
    {
        $this->firstName = trim($firstName);
        $this->lastName = trim($lastName);

        $this->validate();
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    private function validate(): void
    {
        Assert::minLength($this->firstName, 2, 'First name should be at least 1 character');
        Assert::minLength($this->lastName, 2, 'Last name should be at least 1 character');
    }
}