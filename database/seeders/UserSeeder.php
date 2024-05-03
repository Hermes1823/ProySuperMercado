<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => "Estrella Cruz Ulloa",
            'email' => "cuae@gmail.com",
            'idRol' => 2,
            'password' => Hash::make('123456789'),
            
        ]);

        User::create([
            'name' => "Castillo Sarmiento Jose Maria Hermes",
            'email' => "hermescallao47@gmail.com",
            'idRol' => 2,
            'password' => Hash::make('HERMES12345'),
           
        ]);
    }
}
