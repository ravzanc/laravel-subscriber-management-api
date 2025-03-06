<?php

namespace Database\Seeders;

use App\Models\Field;
use App\Models\Subscriber;
use App\Models\FieldValue;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $fieldsCount = 5;
        $subscribersCount = 10;

        Field::factory($fieldsCount)->create();

        Subscriber::factory($subscribersCount)->create();

        foreach (range(1, $fieldsCount) as $fieldId) {
            foreach (range(1, $subscribersCount) as $subscriberId) {
                FieldValue::factory()->create([
                    'subscriber_id' => $subscriberId,
                    'field_id' => $fieldId,
                ]);
            }
        }
    }
}
