<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::created([
            'nama' => 'Admin',
            'email' => 'admin@vigenesia.com',
            'role_id' => 1,
            'password' => Hash::make('admin'),
        ]);

        User::created([
            'nama' => 'User',
            'email' => 'user@vigenesia.com',
            'role_id' => 2,
            'password' => Hash::make('user'),
        ]);
    }
}
