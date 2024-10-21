<?php
declare(strict_types=1);

namespace App\Notifications\Domain;

interface NotificationSenderInterface
{
    public function send(string $recipient, string $subject, string $message): bool;
}