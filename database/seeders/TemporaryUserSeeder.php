<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class TemporaryUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'ibnuyoga1820@gmail.com'],
            [
                'name' => 'Ibnuyoga',
                'email' => 'ibnuyoga1820@gmail.com',
                'password' => Hash::make('29thd03'),
                'email_verified_at' => now(),
            ]
        );
    }
}
