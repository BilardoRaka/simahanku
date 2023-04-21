<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use App\Models\Material;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Bilardo Raka',
            'email' => 'bilardo@gmail.com',
            'password' => bcrypt('P4mungk2s.'),
            'role' => 'administrator'
        ]);

        Material::create([
            'name' => 'Kayu Jati',
            'unit' => 'Kilogram'
        ]);

        Material::create([
            'name' => 'Kertas Asturo',
            'unit' => 'Lembar'
        ]);

        Material::create([
            'name' => 'Kertas HVS',
            'unit' => 'Lembar'
        ]);

        Customer::factory(20)->create();

        Supplier::factory(20)->create();
    }
}
