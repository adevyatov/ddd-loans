<?php

declare(strict_types=1);

namespace App\Products\Domain\Loan;

use App\Products\Domain\BaseProduct;
use App\Products\Domain\Loan\Event\LoanIssued;
use App\Shared\Domain\ValueObject\Uuid;

class Loan extends BaseProduct
{
    public function __construct(private readonly Uuid $id, private readonly Uuid $clientId, private readonly LoanTerms $terms)
    {
    }

    public static function issue(Uuid $id, Uuid $clientId, LoanTerms $terms): self
    {
        $self = new self($id, $clientId, $terms);

        $issuedEvent = new LoanIssued($id, $terms->months, $terms->interestRate, $terms->amount);
        $self->pushDomainEvent($issuedEvent);

        return $self;
    }

    public static function name(): string
    {
        return 'Loan';
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function clientId(): Uuid
    {
        return $this->clientId;
    }

    public function terms(): LoanTerms
    {
        return $this->terms;
    }
}
