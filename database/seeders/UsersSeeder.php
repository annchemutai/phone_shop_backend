<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'Super Admin',
            'email'=>'super_admin@example.com',
            'phone'=>'0711222333',
            'delivery_address'=>'123 Example Street',
            'password'=>'Qwerty1.',
            'role_id'=>1,
        ]);

        User::create([
            'name'=>'Test User',
            'email'=>'test_user@example.com',
            'phone'=>'0711222333',
            'delivery_address'=>'123 Example Street',
            'password'=>'Qwerty1.',
            'role_id'=>2,
        ]);
    }
}
