<?php

namespace App\Contracts;

interface EmailService
{
    public function hasActiveEmailHostDomain(string $email): bool;
}
