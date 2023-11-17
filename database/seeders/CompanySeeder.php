<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 2; $i++) {
            \App\Models\Company::create([
                'name' => $faker->company,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->email,
            ]);
        }
    }
}
