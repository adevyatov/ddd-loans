<?php

declare(strict_types=1);

namespace App\Clients\Infrastructure\Database\Repository;

use App\Clients\Domain\Client;
use App\Clients\Domain\ClientNotFound;
use App\Clients\Domain\ClientRepository;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineClientRepository extends ServiceEntityRepository implements ClientRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    public function save(Client $client): void
    {
        $entityManager = $this->getEntityManager();

        $entityManager->persist($client);
        $entityManager->flush();
    }

    public function findByEmail(string $email): Client
    {
        $client = $this->findBy(['email' => $email]);

        if (!$client) {
            throw new ClientNotFound();
        }

        return $client;
    }

    public function findById(Uuid $id): Client
    {
        $client = $this->findOneBy(['id' => $id->value]);

        if (!$client) {
            throw new ClientNotFound();
        }

        return $client;
    }
}
