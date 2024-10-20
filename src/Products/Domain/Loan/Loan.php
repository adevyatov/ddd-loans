<?php
declare(strict_types=1);

namespace App\Products\Domain\Loan;

use App\Products\Domain\BaseProduct;
use App\Shared\Domain\ValueObject\Uuid;

class Loan extends BaseProduct
{
    public function __construct(private readonly Uuid $id, private readonly LoanTerms $terms)
    {
    }

    public static function name(): string
    {
        return 'Loan';
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function terms(): LoanTerms
    {
        return $this->terms;
    }
}