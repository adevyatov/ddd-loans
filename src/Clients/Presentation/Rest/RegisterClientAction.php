<?php

declare(strict_types=1);

namespace App\Clients\Presentation\Rest;

use App\Clients\Application\Command\RegisterClientCommand;
use App\Clients\Application\Query\HasClientQuery;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\ValueObject\Uuid;
use DomainException;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class RegisterClientAction
{
    public function __construct(private readonly CommandBus $commandBus, private readonly QueryBus $queryBus)
    {
    }

    #[Route('/register', methods: 'POST')]
    public function __invoke(#[MapRequestPayload] RegisterClientRequest $request): string
    {
        if ($this->queryBus->execute(new HasClientQuery($request->email))) {
            throw new DomainException('Client with given email already exists.');
        }

        $id = Uuid::generate();
        $this->commandBus->execute(new RegisterClientCommand($id, $request->toDomainValue()));

        return $id->value;
    }
}
