<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->name = 'Admin User';
        $admin->email = 'admin@email.com';
        $admin->password = Hash::make('password'); // Change this to a secure password
        $admin->is_admin = true;
        $admin->save();
    }
}