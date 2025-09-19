<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class ChirpSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure we have at least 3 users
        if (User::count() < 3) {
            $users = collect([
                User::firstOrCreate(
                    ['email' => 'asmeyb@gmail.com'],
                    ['name' => 'Asmamaw Yismaw', 'password' => bcrypt('password')]
                ),
                User::firstOrCreate(
                    ['email' => 'abebeyb@gmail.com'],
                    ['name' => 'Abebe Yismaw', 'password' => bcrypt('password')]
                ),
                User::firstOrCreate(
                    ['email' => 'adaneyb@gmail.com'],
                    ['name' => 'Adane Yismaw', 'password' => bcrypt('password')]
                ),
            ]);
        } else {
            $users = User::take(3)->get();
        }

        $chirps = [
            'Just setting up my Chirper.',
            'Hello world! This is my first chirp.',
            'Enjoying the sunny weather today!',
            'Learning Laravel is so much fun!',
            'Can\'t wait for the weekend!',
            'Just had the best coffee ever!',
            'Reading a great book on programming.',
            'Exploring new hiking trails this weekend.',
            'Cooking up a storm in the kitchen!',
            'Watching a classic movie tonight.',
        ];

        foreach ($chirps as $message) {
            $users->random()->chirps()->create([
                'message' => $message,
                'created_at' => now()->subMinutes(rand(5, 1440)),
            ]);
        }
    }
}
