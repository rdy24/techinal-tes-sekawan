<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name'      => 'Admin',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('admin123'),
            'role'      => 'admin',
        ]);

        User::create([
            'name'     => 'Supervisor',
            'email'    => 'supervisor@gmail.com',
            'password' => bcrypt('supervisor123'),
            'role'     => 'supervisor',
        ]);

        User::create([
            'name'     => 'Manager',
            'email'    => 'manager@gmail.com',
            'password' => bcrypt('manager123'),
            'role'     => 'manager',
        ]);

        $this->call([
            CompanySeeder::class,
            MineSeeder::class,
            DriverSeeder::class,
            VehicleSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
