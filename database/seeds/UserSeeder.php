<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Pemilik',
            'email' => 'pemilik@gmail.com',
            'password' => bcrypt('Pemiliksatemaranggi')
        ]);
        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'Kasir',
            'email' => 'kasir@gmail.com',
            'password' => bcrypt('Kasirsatemaranggi')
        ]);
        $user->assignRole('user');
    }
}
