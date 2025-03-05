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
        $this->getJsonApi('/');
    }

    public function test_get_field(): void
    {
        $this->getJsonApi('/1');
    }

    public function test_create_field(): void
    {
        $this->postJsonApi([
            'title' => 'test-country',
            'type' => FieldType::STRING->value,
        ]);
    }

    public function test_update_field(): void
    {
        $createdFieldId = Field::query()->where(['title' => 'test-country'])
            ->first('id')->id;

        $this->patchJsonMerge(
            $createdFieldId,
            [
                'title' => 'test-birthday',
                'type' => FieldType::DATE->value,
            ]
        );
    }

    public function test_delete_field(): void
    {
        $updatedFieldId = Field::query()->where(['title' => 'test-birthday'])
            ->first('id')->id;

        $this->deleteJsonApi($updatedFieldId);
    }
}
