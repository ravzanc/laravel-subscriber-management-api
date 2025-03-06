<?php

namespace App\Services;

use App\Contracts\EmailService;

final class SubscriberEmailService implements EmailService
{
    public function hasActiveEmailHostDomain(string $email): bool
    {
        $hostDomain = substr(strrchr($email, "@"), 1);

        if (empty($hostDomain)) {
            return false;
        }

        return checkdnsrr($hostDomain);
    }
}
