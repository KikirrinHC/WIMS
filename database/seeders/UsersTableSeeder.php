<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'superadmin',
                'email'          => 'super@admin.com',
                'password'       => bcrypt('super'),
                'remember_token' => null,
            ],
            [
                'id'             => 2,
                'name'           => 'admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('admin'),
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
