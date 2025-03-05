<?php

namespace Tests\Feature;

use App\Enums\SubscriberState;
use App\Models\Subscriber;
use Tests\TestCase;

class SubscriberApiTest extends TestCase
{
    protected string $resource = 'subscribers';

    public function test_get_all_fields(): void
    {
        $this->getJsonApi('/');
    }

    public function test_get_field(): void
    {
        $this->getJsonApi('/1');
    }

    public function test_create_field(): void
    {
        $this->postJsonApi([
            'email' => 'test-subscriber@email.com',
            'name' => 'test-Subscriber Name',
            'state' => SubscriberState::ACTIVE->value,
        ]);
    }

    public function test_update_field(): void
    {
        $createdFieldId = Subscriber::query()->where(['email' => 'test-subscriber@email.com'])
            ->first('id')->id;

        $this->patchJsonMerge(
            $createdFieldId,
            [
                'email' => 'test-subscriber-updated@email.com',
                'name' => 'test-Subscriber Updated Name',
                'state' => SubscriberState::UNSUBSCRIBED->value,
            ]
        );
    }

    public function test_delete_field(): void
    {
        $updatedFieldId = Subscriber::query()->where(['email' => 'test-subscriber-updated@email.com'])
            ->first('id')->id;

        $this->deleteJsonApi($updatedFieldId);
    }
}
