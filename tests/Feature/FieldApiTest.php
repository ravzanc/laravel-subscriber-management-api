<?php

namespace Tests\Feature;

use App\Enums\FieldType;
use App\Models\Field;
use Tests\TestCase;

class FieldApiTest extends TestCase
{
    protected string $resource = 'fields';

    public function test_get_all_fields(): void
    {
        $response  = $this->getJsonApi('/');

        $response->assertStatus(200);
        $response->assertJsonStructure(['data']);
    }

    public function test_get_field(): void
    {
        $response = $this->getJsonApi('/1');

        $response->assertStatus(200);
        $response->assertJsonStructure(['data']);
    }

    public function test_create_field(): void
    {
        $response = $this->postJsonApi([
            'title' => 'test-country',
            'type' => FieldType::STRING->value,
        ]);

        $response->assertStatus(201);
    }

    public function test_create_duplicated_field(): void
    {
        $response = $this->postJsonApi([
            'title' => 'test-country',
            'type' => FieldType::STRING->value,
        ]);

        $response->assertStatus(422);
    }

    public function test_update_field(): void
    {
        $createdFieldId = Field::query()->where(['title' => 'test-country'])
            ->first('id')->id;

        $response = $this->patchJsonMerge(
            $createdFieldId,
            [
                'title' => 'test-birthday',
                'type' => FieldType::DATE->value,
            ]
        );

        $response->assertStatus(200);
    }

    public function test_delete_field(): void
    {
        $updatedFieldId = Field::query()->where(['title' => 'test-birthday'])
            ->first('id')->id;

        $response = $this->deleteJsonApi($updatedFieldId);

        $response->assertStatus(204);
    }
}
