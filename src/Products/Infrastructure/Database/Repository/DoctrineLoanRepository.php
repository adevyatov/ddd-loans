<?php

declare(strict_types=1);

namespace App\Products\Infrastructure\Database\Repository;

use App\Products\Domain\Loan\Loan;
use App\Products\Domain\Loan\LoanRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineLoanRepository extends ServiceEntityRepository implements LoanRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Loan::class);
    }

    public function save(Loan $loan): void
    {
        $entityManager = $this->getEntityManager();

        $entityManager->persist($loan);
        $entityManager->flush();
    }
}
