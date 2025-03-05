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

        $fieldsCount = 3;
        $subscribersCount = 2;
        $fieldValuesCount = 1;

        Field::factory($fieldsCount)->create();

        Subscriber::factory($subscribersCount)->create();

        FieldValue::factory($fieldValuesCount)->create();
    }
}
