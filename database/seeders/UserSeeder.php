<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'andre1',
            'cpf' => '04467095306',
            'email' => 'andre2@example.com',
            'password' => Hash::make('04467095306'),
        ]);
    }
}
