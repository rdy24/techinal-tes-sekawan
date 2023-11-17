<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 6; $i++) {
            \App\Models\Driver::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'status' => $faker->randomElement(['available', 'unavailable']),
            ]);
        }
    }
}
