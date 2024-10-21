<?php
declare(strict_types=1);

namespace App\Clients\Domain\ValueObject;

use Webmozart\Assert\Assert;

final readonly class Name
{
    public string $firstName;

    public string $lastName;

    public function __construct(string $firstName, string $lastName)
    {
        $this->firstName = trim($firstName);
        $this->lastName = trim($lastName);

        $this->validate();
    }

    private function validate(): void
    {
        Assert::minLength($this->firstName, 2, 'First name should be at least 1 character');
        Assert::minLength($this->lastName, 2, 'Last name should be at least 1 character');
    }
}