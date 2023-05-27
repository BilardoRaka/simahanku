<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use App\Models\Material;
use App\Models\ProductType;
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
            'name' => 'Andris Prayoga',
            'email' => 'andris@gmail.com',
            'password' => bcrypt('Andr1s.'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Prayoga',
            'email' => 'prayoga@gmail.com',
            'password' => bcrypt('Andr1s.'),
            'role' => 'pimpinan'
        ]);

        Material::create([
            'name' => 'Kayu Jati',
            'unit' => 'Kilogram',
            'stock' => 10
        ]);

        Material::create([
            'name' => 'Kertas Asturo',
            'unit' => 'Lembar',
            'stock' => 5000
        ]);

        Material::create([
            'name' => 'Kertas HVS',
            'unit' => 'Lembar',
            'stock' => 5000
        ]);

        User::factory(20)->create();
        Customer::factory(20)->create();
        Supplier::factory(20)->create();

        $box = ProductType::create([
            'product_type' => 'Box'
        ]);

        $box->material()->attach(2, [
            'amount' => 100
        ]);

        $box->material()->attach(3, [
            'amount' => 90
        ]);
    }
}
