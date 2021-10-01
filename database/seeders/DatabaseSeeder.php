<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin1 = User::create([
            'name' => 'superadmin1',
            'email' => 'superadmin1@email.com',
            'password' => Hash::make('CBA2021admin1')
        ]);

        $admin2 = User::create([
            'name' => 'superadmin2',
            'email' => 'superadmin2@email.com',
            'password' => Hash::make('CBA2021admin2')
        ]);

        $admin3 = User::create([
            'name' => 'superadmin3',
            'email' => 'superadmin3@email.com',
            'password' => Hash::make('CBA2021admin3')
        ]);
    }
}
