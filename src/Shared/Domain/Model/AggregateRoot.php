<?php
declare(strict_types=1);

namespace App\Shared\Domain\Model;

use App\Shared\Domain\Event\DomainEvent;

abstract class AggregateRoot
{
    private array $events = [];

    final public function pullDomainEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }

    final protected function pushDomainEvent(DomainEvent $domainEvent): void
    {
        $this->events[] = $domainEvent;
    }
}