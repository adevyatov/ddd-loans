<?php

declare(strict_types=1);

namespace App\Notifications\Application\Event;

use App\Notifications\Domain\ClientRepository;
use App\Notifications\Domain\NotificationSenderInterface;
use App\Products\Domain\Loan\Event\LoanIssued;
use App\Shared\Domain\Bus\Event\EventHandler;

final readonly class LoanIssuedHandler implements EventHandler
{
    public function __construct(
        private ClientRepository $clientRepository,
        private NotificationSenderInterface $notificationSender
    ) {
    }

    public function __invoke(LoanIssued $event): void
    {
        $client = $this->clientRepository->getById($event->clientId);

        $recipient = $client->email;
        $subject = 'Loan has been approved and issued!';
        $message = <<<TEXT
Your loan has been approved!

Months: $event->months
Rate: $event->interestRate%
Amount: $event->amount
TEXT;

        $this->notificationSender->send($recipient, $subject, $message);
    }
}
