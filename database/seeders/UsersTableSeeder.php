<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'gender' => 'laki-laki',
            'password' => Hash::make('12345'),
            'image' => 'default.jpg',
            'status' => 'proses',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
