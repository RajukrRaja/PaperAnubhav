<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(ExamConnectContentSeeder::class);

        // An admin is created only when explicit credentials are supplied in .env.
        if (env('SEED_ADMIN_EMAIL') && env('SEED_ADMIN_PASSWORD')) {
            User::firstOrCreate(['email' => env('SEED_ADMIN_EMAIL')], [
                'name' => 'Platform Admin',
                'username' => 'platform-admin',
                'password' => Hash::make(env('SEED_ADMIN_PASSWORD')),
                'role' => 'admin',
                'email_verified_at' => now(),
                'is_active' => true,
            ]);
        }
    }
}
