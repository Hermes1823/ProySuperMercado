<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Rols;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void

    {
        $this->call(RolsSeeder::class);
        \App\Models\User::factory(1)->create();
        
        $this->call(UserSeeder::class);
        $this->call(CategoriasSeeder::class);
        $this->call(MarcasSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(ColaboradorSeeder::class);
        $this->call(RequisitionOrdersSeeder::class);
        $this->call(RequisitionOrdersDetailSeeder::class);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

    }
}
