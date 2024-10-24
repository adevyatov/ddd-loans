<?php

declare(strict_types=1);

namespace App\Shared\Domain\Model;

use App\Shared\Domain\Bus\Event\Event;

abstract class AggregateRoot
{
    /**
     * @var Event[]
     */
    private array $events = [];

    /**
     * @return Event[]
     */
    final public function pullDomainEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }

    final protected function pushDomainEvent(Event $domainEvent): void
    {
        $this->events[] = $domainEvent;
    }
}
