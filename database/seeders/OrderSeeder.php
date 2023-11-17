<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 3; $i++) {
            \App\Models\Order::create([
                'mine_id' => $faker->randomElement([1, 2, 3, 4, 5, 6]),
                'driver_id' => $faker->randomElement([1, 2, 3]),
                'vehicle_id' => $faker->randomElement([1, 2, 3]),
                'start_date' => $faker->date(),
                'return_date' => $faker->date(),
                'approver_1' => $faker->randomElement([2, 3]),
                'approver_2' => $faker->randomElement([2, 3]),
                'created_by' => $faker->randomElement([1, 2, 3]),
            ]);
        }	
    }
}
