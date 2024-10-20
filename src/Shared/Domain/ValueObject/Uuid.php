<?php
declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use Ramsey\Uuid\Uuid as RamseyUuid;
use Webmozart\Assert\Assert;

final readonly class Uuid
{
    public function __construct(public string $value)
    {
        $this->validate();
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public static function generate(): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }

    public static function isValid(string $uuid): bool
    {
        return RamseyUuid::isValid($uuid);
    }

    private function validate(): void
    {
        Assert::uuid($this->value, 'Must be a valid UUID');
    }
}