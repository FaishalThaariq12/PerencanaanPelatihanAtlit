<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'AdminPPA',
            'username' => 'AdminPPA',
            'email' => 'AdminPPPA@gmail.com',
            'password' => bcrypt('PpAtlit2023')
        ]);
    }
}
