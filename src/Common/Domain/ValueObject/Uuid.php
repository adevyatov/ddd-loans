<?php
declare(strict_types=1);

namespace App\Common\Domain\ValueObject;

use Ramsey\Uuid\Uuid as RamseyUuid;
use Webmozart\Assert\Assert;

final readonly class Uuid
{
    public function __construct(public readonly string $id)
    {
        $this->validate();
    }

    public static function generate(): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }

    private function validate(): void
    {
        Assert::uuid($this->id, 'Must be a valid UUID');
    }
}