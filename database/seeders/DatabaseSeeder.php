<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Eliza',
            'email' => (env('ADMIN_EMAIL')),
            'password' => Hash::make(env('ADMIN_PASSWORD')),
            'is_admin' => 1,
        ]);

        $this->call([
            TagSeeder::class,
        ]);
    }
}
