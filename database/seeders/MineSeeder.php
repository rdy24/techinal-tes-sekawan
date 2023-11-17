<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 6; $i++) {
            \App\Models\Mine::create([
                'name' => $faker->company,
                'address' => $faker->address,
                'status' => $faker->randomElement(['active', 'inactive']),
            ]);
        }
    }
}
