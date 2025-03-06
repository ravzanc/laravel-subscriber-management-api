<?php

namespace Tests\Unit;

use App\Contracts\EmailService;
use App\Services\SubscriberEmailService;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class SubscriberEmailServiceTest extends TestCase
{
    private EmailService $service;
    public function setUp(): void
    {
        parent::setUp();

        $this->service = new SubscriberEmailService();
    }

    #[dataProvider('getEmailDomainHostActiveData')]
    public function test_subscriber_email_host_domain_is_active(string $email, bool $hasActiveEmailHostDomain): void
    {
        $this->assertEquals(
            $this->service->hasActiveEmailHostDomain($email),
            $hasActiveEmailHostDomain
        );
    }

    public static function getEmailDomainHostActiveData(): array
    {
        return [
            ['cornea.v.razvan@gmail.com', true],
            ['cornea.v.razvan@gmail.ro', false],
            ['cornea.v.razvan@gmail.rom', false],
            ['razvan@appjobs.com', true],
            ['razvan@mailerlite.com', true],
        ];
    }
}
