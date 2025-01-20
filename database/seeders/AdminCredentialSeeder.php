<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminCredentialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->truncate();
        DB::table('admins')->insert([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('123456'),
        ]);
    }
}
