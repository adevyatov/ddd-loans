<?php
declare(strict_types=1);

namespace App\Clients\Domain\ValueObject;

use App\Shared\Domain\Enum\State;
use Webmozart\Assert\Assert;

final readonly class Address
{
    public string $city;

    public string $state;

    public string $zip;

    public function __construct(string $city, string $state, string $zip)
    {
        $this->city = trim($city);
        $this->state = trim($state);
        $this->zip = trim($zip);

        $this->validate();
    }

    private function validate(): void
    {
        Assert::notEmpty($this->city, 'City must be provided');
        Assert::true(State::isValid($this->state), 'State should be valid');
        Assert::regex($this->zip, '/^\d{5}(-\d{4})?$/', 'ZIP should be valid');
    }
}