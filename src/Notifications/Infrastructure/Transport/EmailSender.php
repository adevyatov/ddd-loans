<?php

declare(strict_types=1);

namespace App\Notifications\Infrastructure\Transport;

use App\Notifications\Domain\NotificationSenderInterface;

class EmailSender implements NotificationSenderInterface
{
    public function send(string $recipient, string $subject, string $message): bool
    {
        // implementation...
        return true;
    }
}
