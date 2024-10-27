<?php

declare(strict_types=1);

namespace App\Clients\Domain\ValueObject;

use Webmozart\Assert\Assert;

class ClientDetails
{
    public function __construct(
        private Name $name,
        private int $age,
        private Address $address,
        private SSN $ssn,
        private FICO $fico,
        private Contacts $contacts,
    ) {
        $this->validate();
    }

    public function ssn(): SSN
    {
        return $this->ssn;
    }

    public function changeSSN(SSN $ssn): self
    {
        $this->ssn = $ssn;

        return $this;
    }

    public function fico(): FICO
    {
        return $this->fico;
    }

    public function changeFICO(FICO $fico): self
    {
        $this->fico = $fico;

        return $this;
    }

    public function contacts(): Contacts
    {
        return $this->contacts;
    }

    public function changeContacts(Contacts $contacts): self
    {
        $this->contacts = $contacts;

        return $this;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function changeName(Name $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function age(): int
    {
        return $this->age;
    }

    public function changeAge(int $age): self
    {
        $this->age = $age;
        $this->validate();

        return $this;
    }

    public function address(): Address
    {
        return $this->address;
    }

    public function changeAddress(Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    private function validate(): void
    {
        Assert::greaterThanEq($this->age, 18, 'Your age should be greater than 18');
        Assert::lessThanEq($this->age, 120, 'Your age should be less than 120');
    }
}
