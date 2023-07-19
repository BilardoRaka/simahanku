<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use App\Models\Employee;
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
            'email' => 'andris@gmail.com',
            'password' => bcrypt('Andr1s.'),
            'role' => 'admin'
        ]);

        User::create([
            'email' => 'prayoga@gmail.com',
            'password' => bcrypt('Andr1s.'),
            'role' => 'pimpinan'
        ]);

        User::create([
            'email' => 'muklis@gmail.com',
            'password' => bcrypt('Mukl1s.'),
            'role' => 'customer'
        ]);

        Employee::create([
            'user_id' => 1,
            'name' => 'Andris Prayoga',
            'phone' => fake()->e164PhoneNumber(),
            'address' => fake()->address(),
            'job_position' => 'Manager Produksi'
        ]);

        Employee::create([
            'user_id' => 2,
            'name' => 'Andrea Pratiwi',
            'phone' => fake()->e164PhoneNumber(),
            'address' => fake()->address(),
            'job_position' => 'Chief Executive Officer'
        ]);

        Customer::create([
            'user_id' => 3,
            'company_name' => fake()->company(),
            'pic' => 'Muklis Cahyadi',
            'address' => fake()->address(),
            'phone' => fake()->e164PhoneNumber(),
        ]);

        Material::create([
            'name' => 'M125',
            'unit' => 'Lembar',
            'stock' => 5000
        ]);

        Material::create([
            'name' => 'K150',
            'unit' => 'Lembar',
            'stock' => 5000
        ]);

        // User::factory(20)->create();
        // Customer::factory(20)->create();
        Supplier::factory(20)->create();

        $SC = ProductType::create([
            'product_type' => 'Single Craft'
        ]);

        $SC->material()->attach(1, [
            'amount' => 0.003
        ]);

        $DC = ProductType::create([
            'product_type' => 'Double Craft'
        ]);

        $DC->material()->attach(1, [
            'amount' => 0.003
        ]);

        $DC->material()->attach(2, [
            'amount' => 0.002
        ]);

        $MC = ProductType::create([
            'product_type' => 'Medium Craft'
        ]);

        $MC->material()->attach(1, [
            'amount' => 0.004
        ]);

        $MC->material()->attach(2, [
            'amount' => 0.001
        ]);
    }
}
