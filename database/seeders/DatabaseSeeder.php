<?php

namespace Database\Seeders;

use App\Models\Subtask;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

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

        Todo::factory(10)->create()->each(function (Todo $todo) {
            Subtask::factory(5)->create(['todo_id' => $todo->id]);
        });
    }
}
