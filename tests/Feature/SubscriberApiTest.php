<?php

namespace Tests\Feature;

use App\Enums\SubscriberState;
use App\Models\Subscriber;
use Tests\TestCase;

class SubscriberApiTest extends TestCase
{
    protected string $resource = 'subscribers';

    public function test_get_all_subscribers(): void
    {
        $response = $this->getJsonApi('/');

        $response->assertStatus(200);
        $response->assertJsonStructure(['data']);
    }

    public function test_get_subscriber(): void
    {
        $response = $this->getJsonApi('/1');

        $response->assertStatus(200);
        $response->assertJsonStructure(['data']);
    }

    public function test_create_subscriber_with_email_host_domain_not_active(): void
    {
        $response = $this->postJsonApi([
            'email' => 'test-subscriber@email.rom',
            'name' => 'test-Subscriber Name',
            'state' => SubscriberState::ACTIVE->value,
        ]);

        $response->assertStatus(422);
    }

    public function test_create_subscriber(): void
    {
        $response = $this->postJsonApi([
            'email' => 'test-subscriber@email.com',
            'name' => 'test-Subscriber Name',
            'state' => SubscriberState::ACTIVE->value,
        ]);

        $response->assertStatus(201);
    }

    public function test_create_duplicate_subscriber(): void
    {
        $response = $this->postJsonApi([
            'email' => 'test-subscriber@email.com',
            'name' => 'test-Subscriber Name',
            'state' => SubscriberState::ACTIVE->value,
        ]);

        $response->assertStatus(422);
    }

    public function test_update_subscriber(): void
    {
        $createdSubscriberId = Subscriber::query()->where(['email' => 'test-subscriber@email.com'])
            ->first('id')->id;

        $response = $this->patchJsonMerge(
            $createdSubscriberId,
            [
                'email' => 'test-subscriber-updated@email.com',
                'name' => 'test-Subscriber Updated Name',
                'state' => SubscriberState::UNSUBSCRIBED->value,
            ]
        );

        $response->assertStatus(200);
    }

    public function test_delete_subscriber(): void
    {
        $updatedSubscriberId = Subscriber::query()->where(['email' => 'test-subscriber-updated@email.com'])
            ->first('id')->id;

        $response = $this->deleteJsonApi($updatedSubscriberId);

        $response->assertStatus(204);
    }
}
