<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 3; $i++) {
            \App\Models\Vehicle::create([
                'name' => $faker->randomElement(['Avanza', 'Xenia', 'Innova']),
                'company_id' => $faker->randomElement([1, 2]),
                'license_plate' => $faker->randomElement(['B 1234 ABC', 'B 1234 ABD', 'B 1234 ABE']),
                'status' => $faker->randomElement(['available', 'unavailable']),
                'ownership' => $faker->randomElement(['rent', 'own']),
                'load_type' => $faker->randomElement(['person', 'item']),
                'fuel_capacity' => $faker->randomElement([100, 200, 300]),
                'service_schedule' => $faker->date(),
            ]);
        }
    }
}
